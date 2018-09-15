<?php

namespace App\Http\Controllers;

use App\Expense;
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
            ->select('billings.*', 'customers.*')
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
            ->orderBy('id', 'DESC')->paginate(8);

        return view ('superadmin.customer.paid',['customers' =>$customers])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function unpaid(){
        $customers = DB::table('customers')
            ->where('bill_status', 0)
            ->orderBy('id', 'DESC')->paginate(8);
        return view ('superadmin.customer.unpaid',['customers' =>$customers])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function monthly(){


        $bills = Billing::select(
            DB::raw('sum(payment_amount) as sums'),
            DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
        )
            ->whereMonth('created_at',Carbon::now()->month)
            ->groupBy('dates')
            ->orderBy('id', 'DESC')
            ->get();

        $con = Customer::select(
            DB::raw('sum(connection_charge) as charge'),
            DB::raw("DATE_FORMAT(connection_date,'%D %M %Y') as dates")
        )
            ->groupBy('dates')
            ->whereMonth('connection_date',Carbon::now()->month)
            ->get();



        $income = Income::select(
            DB::raw('sum(amount) as incomes'),
            DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
        )
            ->groupBy('dates')
            ->get();

        $expenses = Expense::select(
            DB::raw('sum(price) as prices'),
            DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
        )
            ->groupBy('dates')
            ->get();


        $billings = DB::table('billings')
            ->join('customers', 'billings.customer_id', '=', 'customers.id')
            ->select('billings.*', 'customers.*')
            ->select(DB::raw('sum(connection_charge) as charge'),
                DB::raw("DATE_FORMAT(connection_date,'%D %M %Y') as date")


            )

            ->whereMonth('month', Carbon::now()->month)
            ->whereMonth('connection_date', Carbon::now()->month)
            ->groupBy('date')
            ->get();
//dd($billings);

       /* $results = Customer::sortBy('created_at');
        dd($results);*/
        return view('superadmin.report.monthly',compact('billings','con','income','expenses','bills'));
    }

    public function showBilling($id){
        $custId = Customer::where('id',$id)->first();
        $bills = Billing::where('customer_id',$id)->get();

        $users = DB::table('billings')
            ->join('users', 'billings.userId', '=', 'users.userId')
            ->select('billings.*', 'users.username')
            ->where('billings.userId',Auth::user()->userId)
            ->first();

        return view('superadmin.report.showBilling',compact('custId','bills','users'));
    }
public function daily($date)
{
   // return $date;
    $billings = DB::table('billings')
        ->join('customers', 'billings.customer_id', '=', 'customers.id')
        ->select('billings.*', 'customers.customer_name','customers.ip_address')
       // ->where('month', '=', $date.' 00:00:00')->get();
    //->whereRaw('date(month) = ?', [date('Y-m-d')])->get();
            //Billing::where( DB::raw('date(month)'), '=', date('n') )->get();

    ->where('month', '=', $date().' 00:00:00')->get();

    dd($billings);

    $users = DB::table('billings')
        ->join('users', 'billings.userId', '=', 'users.userId')
        ->select('billings.*', 'users.username')
        ->where('billings.userId',Auth::user()->userId)
        ->first();

    return view('superadmin.report.today',compact('billings','users','todays'));
}

public function report(){

   $billings = Billing::select(
       DB::raw('sum(payment_amount) as sums'),
       DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
   )
       ->groupBy('dates')
       ->get();

    $con = Customer::select(
        DB::raw('sum(connection_charge) as charge'),
        DB::raw("DATE_FORMAT(connection_date,'%D %M %Y') as dates")
    )
        ->groupBy('dates')
        ->get();

    $income = Income::select(
        DB::raw('sum(amount) as incomes'),
        DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
    )
        ->groupBy('dates')
        ->get();


   // dd($billings,$con,$income,$expenses);

    return view ('superadmin.report.inc_report',compact('billings','con','income'));
}

}
