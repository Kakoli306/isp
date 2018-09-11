<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function create(){

        $zone = Zone::all();
        return view('superadmin.customer.createCustomer',compact('zone'));
        }

    public function save( Request $request){


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
        return redirect("customer/create")->with('message', 'Customer info saved ');
    }

    public function manageCustomer(){

        $customers = DB::table('customers')
                ->join('zones', 'customers.zone_id', '=', 'zones.id')
                ->select('customers.*', 'zones.zone_name')
                 ->orderBy('id', 'DESC')->paginate(5);

        return view('superadmin.customer.manageCustomer',['customers'=> $customers])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function inactiveCustomer($id) {

        DB::table('customers')->where('id',$id)->update(['status' => 0]);
        return redirect('/customer/manage')->with('message', 'this guy is  unactive now');
    }
    public function activeCustomer($id) {

        DB::table('customers')->where('id',$id)->update(['status' => 1]);
        return redirect('/customer/manage')->with('message', 'this guy is  active now successfully');
    }

    public function editCustomer($id){
        $zone = Zone::all();
        $customerById = Customer::where('id',$id)->first();
        return view('superadmin.customer.editCustomer',compact('customerById','zone'));
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
        return redirect('customer/manage')->with('message','this info updated successfully');
    }

    public function deleteCustomer(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        $customer->delete();

        return redirect('customer/manage')->with('success',' deleted successfully');
    }

    public function actives(){
        $customers = DB::table('customers')
            ->where('status', 1)
            ->paginate(10);
        return view ('superadmin.customer.actives',['customers' =>$customers])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function inactive(){
        $customers = DB::table('customers')
            ->where('status', 0)
            ->paginate(10);
        return view ('superadmin.customer.inactives',['customers' =>$customers])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function current(){
        $currentMonth = date('m');
       $customers = DB::table('customers')
           ->whereRaw('MONTH(connection_date) = ?',[$currentMonth])
              ->get();
        //print_r($customers);
        return view ('superadmin.customer.current',['customers' =>$customers]);

    }

    public function charge(){
        $currentMonth = date('m');
        $customers = DB::table('customers')
            ->whereRaw('MONTH(connection_date) = ?',[$currentMonth])
            ->paginate(8);

        return view ('superadmin.billing.connection',['customers' =>$customers])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }


}
