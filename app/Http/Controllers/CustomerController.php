<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Customer;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function create()
    {

        $zone = Zone::all();
        return view('superadmin.customer.createCustomer', compact('zone'));
    }

    public function save(Request $request)
    {
        $customers = new Customer();
        $customers->customer_name = $request->customer_name;
        $customers->mobile_no = $request->mobile_no;
        $customers->email = $request->email;
        $customers->blood_group = $request->blood_group;
        $customers->national_id = $request->national_id;
        $customers->occupation = $request->occupation;
        $customers->address = $request->address;
        $customers->zone_id = $request->zone_id;
        $customers->month_amount = $request->month_amount;
        $customers->bill_amount = $request->bill_amount;
        $customers->connection_charge = $request->connection_charge;
        $customers->ip_address = $request->ip_address;
        $customers->connection_date = $request->connection_date;
        $customers->speed = $request->speed;
        $customers->status = $request->status;
        $customers->bill_status = 0;
        $customers->save();
        return redirect()->back()->with('message', 'Customer info saved ');
    }

    public function manageCustomer(Request $request)
    {

        $customers = DB::table('customers')
            ->join('zones', 'customers.zone_id', '=', 'zones.id')
            ->select('customers.*', 'zones.zone_name')
            ->orderBy('customers.id', 'DESC')
            ->paginate(8);

        $sun = Customer::sum('bill_amount');
        $zones = DB::table('zones')->get();


        return view('superadmin.customer.manageCustomer', ['customers' => $customers, 'zones' => $zones, 'sun' => $sun])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function inactiveCustomer($id)
    {
        $abc = Customer::where('id',$id)->first();
       $abc->status = 1;
       $abc->save();

        return redirect()->back()->with('message', 'This guy is  unactive now');
    }

    public function activeCustomer($id)
    {

       // DB::table('customers')->where('id', $id)->update(['status' => 1]);

        $def = Customer::where('id',$id)->first();
        $def->status = 0;
        $def->save();

        return redirect('/customer/manage')->with('message', 'this guy is  active now successfully');
    }

    public function editCustomer($id)
    {
        $zone = Zone::all();
        $customerById = Customer::where('id', $id)->first();
        return view('superadmin.customer.editCustomer', compact('customerById', 'zone'));
    }

    public function updateCustomer(Request $request)
    {
        $customer = Customer::find($request->customer_id);

        $customer->customer_name = $request->customer_name;
        $customer->mobile_no = $request->mobile_no;
        $customer->email = $request->email;
        $customer->blood_group = $request->blood_group;
        $customer->national_id = $request->national_id;
        $customer->occupation = $request->occupation;
        $customer->address = $request->address;
        $customer->zone_id = $request->zone_id;
        $customer->month_amount = $request->month_amount;
        $customer->bill_amount = $request->bill_amount;
        $customer->connection_charge = $request->connection_charge;
        $customer->ip_address = $request->ip_address;
        $customer->connection_date = $request->connection_date;
        $customer->speed = $request->speed;
        $customer->status = $request->status;
        $customer->save();
        return redirect('customer/manage')->with('message', 'this info updated successfully');
    }

    public function deleteCustomer($customer_id)
    {
        //return $request->all();
        $customer = Customer::find($customer_id);
        $customer->delete();

        return redirect('customer/manage')->with('success', ' deleted successfully');
    }




    public function current()
    {
        $currentMonth = date('m');
        $customers = DB::table('customers')
            ->whereRaw('MONTH(connection_date) = ?', [$currentMonth])
            ->orderBy('id', 'DESC')->paginate(7);

        $count = DB::table('customers')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('connection_date', Carbon::now()->month)
            ->count();


        $count1 = DB::table('customers')
            ->whereIn('status', [1])
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('connection_date', Carbon::now()->month)
            ->count();

        $count2 = DB::table('customers')
            ->whereIn('status', [0])
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('connection_date', Carbon::now()->month)
            ->count();


        return view('superadmin.customer.current', ['customers' => $customers, 'count' => $count, 'count1' => $count1, 'count2' => $count2])
            ->with('i');


    }

    public function charge()
    {
        $currentMonth = date('m');
        $customers = DB::table('customers')
            ->whereRaw('MONTH(connection_date) = ?', [$currentMonth])
            ->paginate(8);

        return view('superadmin.billing.connection', ['customers' => $customers])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    function action(Request $request)
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
                    ->orWhere('ip_address', 'like', '%' . $query . '%')
                    ->orWhere('connection_date', 'like', '%' . $query . '%')
                    ->orWhere('zone_name', 'like', '%' . $query . '%')
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