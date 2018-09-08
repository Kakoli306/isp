<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Billing;
use Carbon\Carbon;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewController extends Controller
{
    public function statement(){

        // $currentMonth = Carbon::now()->startOfMonth();

        $billings = DB::table('billings')
            ->join('customers', 'billings.customer_id', '=', 'customers.id')
            ->select('billings.*', 'customers.customer_name','customers.ip_address')
            ->whereMonth('month','9')
            ->get();
//dd($billings);

        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId',Auth::user()->userId)
            ->first();



        return view ('superadmin.report.statement',['billings' =>$billings,'users' => $users])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function monthly(){
        $currentMonth = date('m');
        $customers = DB::table('customers')
            ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
            ->get();

        return view('superadmin.report.monthly',['customers' =>$customers]);
    }

    public function showBilling($id){
        $custId = Customer::where('id',$id)->first();
        $bills = Billing::where('customer_id',$id)->get();


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
        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId',Auth::user()->userId)
            ->first();

        return view('superadmin.report.showBilling',compact('custId','new','users','bills'));
    }
public function daily($date)
{

    //dd($date);
    $todays = Billing::whereDate('created_at',$date)->get();


    $weekdate = new Carbon;

    $weekdate->subWeek();
    //dd($date);
    $date = $weekdate->toDateString() ;
   // dd($date);
   // News::where('created_at', '>', $date->toDateTimeString() )->get();


    $todays = DB::table('billings')
    ->whereRaw('date(created_at) = ?', [date('Y-m-d')]);
    dd($todays);


      //  ->where( 'created_at', '>', Carbon::now()->subDays(3));

    $billings = DB::table('billings')
        ->join('customers', 'billings.customer_id', '=', 'customers.id')
        ->select('billings.*', 'customers.customer_name','customers.ip_address')
        ->get();

    $users = DB::table('billings')
        ->join('users', 'billings.userId', '=', 'users.userId')
        ->select('billings.*', 'users.username')
        ->where('billings.userId',Auth::user()->userId)
        ->first();



    return view('superadmin.report.today',compact('billings','users','todays'));
}

public function report(){

    $customers = DB::table('customers')
        ->join('billings', 'billings.customer_id', '=', 'customers.id')
        ->select('customers.*', 'customers.created_at')
    ->select('billings.*', 'billings.created_at')
        ->get();
    dd($customers);

    return view ('superadmin.report.inc_report');

}

}
