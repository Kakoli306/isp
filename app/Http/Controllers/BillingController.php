<?php

namespace App\Http\Controllers;

use App\Billing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function add()
    {

        $zones = DB::table('zones')->get();
        $customers = DB::table('customers')
            ->join('zones', 'customers.zone_id', '=', 'zones.id')
            ->select('customers.*', 'zones.zone_name')
            ->orderBy('customers.id', 'DESC')
            ->paginate(8);

        return view('superadmin.billing.add',['customers'=> $customers,'zones'=>$zones])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function editBilling($id){

        $BillingById = Customer::where('id',$id)->first();

        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId',Auth::user()->userId)
            ->first();

        $bills = Billing::where('customer_id',$id)->get();

// For dues
        $dues = DB::table('customers')
              ->join('billings','billings.customer_id', '=', 'customers.id')
              ->select('billings.*','customers.*')
            ->where('billings.customer_id','=',$id)
            ->count('bill_amount');

        $new = 0;

        if($dues > 0) {

            $bill_amount=0;

            $due = DB::table('customers')
                ->join('billings','billings.customer_id', '=', 'customers.id')
                ->select('billings.*','customers.*')
                ->where('billings.customer_id','=',$id)
                ->first();

            $connection_charge = $due->connection_charge;
            $month_amount = $due->month_amount;
            $new = ($bill_amount + $connection_charge - $month_amount);
        }

        else
        {
            $due = DB::table('customers')
                ->where('id',$id)
                ->first();
        }

        return view('superadmin.billing.edit',compact('BillingById','bills','users','BillingById1'));
    }

    public function adding(Request $request)
    {

        $billings = new Billing();
        $billings->customer_id = $request->id;
        $billings->userId = Auth::user()->userId;
        $billings->payment_amount = $request->payment_amount;
        $billings->discount = $request->discount;
        $billings->payment_description = $request->payment_description;
        $billings->month = Carbon::now();
        $billings->dmon = Carbon::now()->format('M -Y');
        $billings->save();

       // return view('superadmin.billing.edit')->with('message','Billing info saved ');

        return redirect()->back()->with('message', 'Billing info saved ');
    }

    public function editAmount($id){
        $bills = Billing::where('id',$id)->first();
        return view('superadmin.billing.amountedit',compact('bills'));
    }
    public function updateBilling(Request $request )
    {
        $billings = Billing::find($request->billing_id);
        $billings->payment_amount = $request->payment_amount;
        $billings->save();

        return redirect()->back()->with('message', 'Billing info updated successfully ');
    }


    public function deleteBilling( Request $request)
    {
        $billings = Billing::find($request->billing_id);
        $billings->delete();

        return redirect()->back()->with('message',' deleted successfully');
    }

    public function discount(){

        $customers = DB::table('billings')
            ->join('customers', 'billings.customer_id', '=', 'customers.id')
            ->select('billings.*', 'customers.customer_name')
            ->orderBy('id', 'DESC')->paginate(8);

        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId',Auth::user()->userId)
            ->first();

        return view ('superadmin.billing.discount',compact( 'customers','users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    public function lifetime_paid($BillingById) {

        DB::table('payments')->where('customer_id',$BillingById->id)->sum('pay_amount');
        return redirect('/customer/manage')->with('message', 'this guy is  unactive now');
    }


    public function paid(Request $request){

       // return $request;
        $billings = new Billing();
        $billings->customer_id = $request->customer_id;
        $billings->userId = Auth::user()->userId;
        $billings->payment_amount = $request->amount;
        $billings->month = Carbon::now();
        $billings->dmon = Carbon::now()->format('M -Y');
        $billings->save();
        return redirect()->back();
    }

    public function unpaid(Request $request){

        $customers = Customer::where('id',$request->id)->first();
        $customers->bill_status = 1;
        $customers->save();
        return redirect()->back();
    }

    public function showBilling($id)
    {

        $BillingById = Customer::where('id', $id)->first();
        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId', Auth::user()->userId)
            ->first();
        $bills = Billing::where('customer_id',$id)->get();

        return view('superadmin.billing.show', compact('BillingById', 'users','bills'));

    }
    function billsearch(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '')
            {
                $data = DB::table('customers')
                    ->join('zones', 'customers.zone_id', '=', 'zones.id')
                    ->select('customers.*', 'zones.zone_name')

                    ->where('customer_name', 'like', '%' . $query . '%')
                    ->orWhere('mobile_no', 'like', '%' . $query . '%')
                    ->orWhere('address', 'like', '%' . $query . '%')
                    ->orWhere('speed', 'like', '%' . $query . '%')
                    ->orWhere('bill_amount', 'like', '%' . $query . '%')
                    ->orWhere('zone_name', 'like', '%' . $query . '%')
                    ->orWhere('ip_address', 'like', '%' . $query . '%')
                    ->orderBy('id', 'asc')
                    ->get();

            }
            else
            {
                $data = DB::table('customers')
                    ->join('zones', 'customers.zone_id', '=', 'zones.id')
                    ->select('customers.*', 'zones.zone_name')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $i = 1;
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)


                    if($row->status === 0){
                        $output .= '
        <tr>
         <td>'.$i++.'</td>
         <td>'.$row->customer_name.'</td>
         <td>'.$row->id.'</td>
         <td>'.$row->address.'</td>
         <td>'.$row->mobile_no.'</td>
         <td>'.$row->speed.'</td>
         <td>'.$row->bill_amount.'</td>
         <td>'.$row->connection_date.'</td>
         <td>'.$row->zone_name.'</td>
         <td>'.$row->ip_address.'</td>
                              
         <td class="center">
       
          <a class = "btn btn-danger btn-sm"  href=' . route('inactive-customer',['id'=>$row->id]) . '>Inactive</a>
                           
                            </td>
                  
         <td><a class="btn-info"   href=' . route('edit',['id'=>$row->id]) . '>Edit</a>
         <a class="btn-outline-danger"   <form  href = ' . route('delete',['id'=>$row->id]). '>Delete
         
        
          </tr>
        ';
                    }

                    else

                    {
                        $output .= '
        <tr>
         <td>'.$i++.'</td>
         <td>'.$row->customer_name.'</td>
         <td>'.$row->id.'</td>
         <td>'.$row->address.'</td>
         <td>'.$row->mobile_no.'</td>
         <td>'.$row->speed.'</td>
         <td>'.$row->bill_amount.'</td>
         <td>'.$row->connection_date.'</td>
         <td>'.$row->zone_name.'</td>
         <td>'.$row->ip_address.'</td>
              
         <td class="center">
        
                                   <a class = "btn btn-success btn-sm"  href=' . route('active-customer',['id'=>$row->id]) . '>Active</a>
                            </td>
                  
         <td><a class="btn-info"   href=' . route('edit',['id'=>$row->id]) . '>Edit</a>
         <a class="btn-outline-danger"   <form  href = ' . route('delete',['id'=>$row->id]). '>Delete
         
        
          </tr>
        ';
                    }
            }
            else
            {
                $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }


}
