<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;
use App\Billing;
use Carbon\Carbon;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class NewController extends Controller
{
    public function statement(){

        $billings = DB::table('billings')
            ->join('customers', 'billings.customer_id', '=', 'customers.id')
            ->select('billings.*', 'customers.customer_name','customers.ip_address')
            ->whereMonth('month',Carbon::now()->month)
            ->get();

        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId',Auth::user()->userId)
            ->first();



        return view ('superadmin.report.statement',['billings' =>$billings,'users' => $users])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function paid(){
        $customers = DB::table('customers')
            ->where('bill_status', 1)
            ->paginate(10);
        return view ('superadmin.customer.paid',['customers' =>$customers])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function unpaid(){
        $customers = DB::table('customers')
            ->where('bill_status', 0)
            ->paginate(10);
        return view ('superadmin.customer.unpaid',['customers' =>$customers])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function monthly(){


        $billings = DB::table('billings')
            ->join('customers', 'billings.customer_id', '=', 'customers.id')
            ->select('billings.*', 'customers.*')
            ->whereMonth('month', Carbon::now()->month)
            ->whereMonth('connection_date', Carbon::now()->month)
            ->get();

       /* $results = Customer::sortBy('created_at');
        dd($results);*/
        return view('superadmin.report.monthly',['billings' =>$billings]);
    }

    public function showBilling($id){
        $custId = Customer::where('id',$id)->first();
        $bills = Billing::where('customer_id',$id)->get();

        return view('superadmin.report.showBilling',compact('custId','new','users','bills'));
    }
public function daily($date)
{
    $billings = DB::table('billings')
        ->join('customers', 'billings.customer_id', '=', 'customers.id')
        ->select('billings.*', 'customers.customer_name','customers.ip_address')
        ->where('month', '=', $date.' 00:00:00')->get();

    $users = DB::table('billings')
        ->join('users', 'billings.userId', '=', 'users.userId')
        ->select('billings.*', 'users.username')
        ->where('billings.userId',Auth::user()->userId)
        ->first();

    return view('superadmin.report.today',compact('billings','users','todays'));
}

public function report(){


    $income = DB::table('incomes')
        ->select('incomes.amount')
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('amount');

    $date = DB::table('customers')
        ->join('billings', 'billings.customer_id', '=', 'customers.id')
        ->select('customers.connection_date','customers.connection_charge','billings.payment_amount','billings.created_at')
        ->whereMonth('connection_date', Carbon::now()->month)
        ->get();

    return view ('superadmin.report.inc_report',compact('date','customers','income'));
}

}
