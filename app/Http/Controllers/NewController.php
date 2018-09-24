<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Income;
use App\Billing;
use Carbon\Carbon;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class NewController extends Controller
{
    public function statement(){

        $users = DB::table('incomes')
            ->join('users', 'incomes.userId', '=', 'users.userId')
            ->select('incomes.*', 'users.username')
            ->where('incomes.userId',Auth::user()->userId)
            ->first();

        $billings = Billing::select(
            DB::raw('(payment_amount) as sums'),
            DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
        )
            ->whereMonth('created_at',Carbon::now()->month)
            ->orderBy('dates')
            ->get();

        $expense = Expense::select(
            DB::raw('(price) as expenses'),
            DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
        )
            ->whereMonth('created_at',Carbon::now()->month)
            ->orderBy('dates')
            ->get();

        $news = collect($expense)->merge($billings);
        $merged = $news->sortBy('dates');

        $res = $news->sortBy(function ($merged) {
                return $merged->dates;
            });

        // dd($res);

        return view ('superadmin.report.statement',compact('res','users'))
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

        $billings = Billing::select(
            DB::raw('sum(payment_amount) as sums'),
            DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
        )
            ->whereMonth('created_at',Carbon::now()->month)
            ->groupBy('dates')
            ->get();

        $con = Customer::select(
            DB::raw('sum(connection_charge) as charge'),
            DB::raw("DATE_FORMAT(connection_date,'%D %M %Y') as dates")
        )
            ->whereMonth('connection_date',Carbon::now()->month)
            ->groupBy('dates')
            ->get();

        $income = Income::select(
            DB::raw('sum(amount) as incomes'),
            DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
        )
            ->whereMonth('created_at',Carbon::now()->month)
            ->groupBy('dates')
            ->get();

        $expense = Expense::select(
            DB::raw('sum(price) as expenses'),
            DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
        )
            ->whereMonth('created_at',Carbon::now()->month)
            ->groupBy('dates')
            ->get();

        $users = collect($billings)->merge($con)->merge($income)->merge($expense);
        $merged = $users->sortBy('dates');

        $res = $merged
            ->groupBy(function ($merged) {
                 return $merged->dates;
            });

        return view('superadmin.report.monthly',compact('merged','res'));
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
   //return $date;
    $billings = DB::table('customers')
        ->join('billings','billings.customer_id', '=', 'customers.id')
        ->select('billings.*','customers.*')
        ->where('month', '=', $date)
        ->get();

    $users = DB::table('billings')
        ->join('users', 'billings.userId', '=', 'users.userId')
        ->select('billings.*', 'users.username')
        ->where('billings.userId',Auth::user()->userId)
        ->first();

    return view('superadmin.report.today',compact('billings','users'));
}

public function report(){

   $billings = Billing::select(
       DB::raw('sum(payment_amount) as sums'),
       DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
   )
       ->whereMonth('created_at',Carbon::now()->month)
       ->groupBy('dates')
       ->get();

    $con = Customer::select(
        DB::raw('sum(connection_charge) as charge'),
        DB::raw("DATE_FORMAT(connection_date,'%D %M %Y') as dates")
    )
        ->whereMonth('connection_date',Carbon::now()->month)
        ->groupBy('dates')
        ->get();

    $income = Income::select(
        DB::raw('sum(amount) as incomes'),
        DB::raw("DATE_FORMAT(created_at,'%D %M %Y') as dates")
    )
        ->whereMonth('created_at',Carbon::now()->month)
        ->groupBy('dates')
        ->get();

    $users = collect($billings)->merge($con)->merge($income);
    $merged = $users->sortBy('dates');

    $res = $merged
        ->groupBy(function ($merged) {
            return $merged->dates;
        });

    return view ('superadmin.report.inc_report',compact('merged','res'));
}

public function con($date){
    $billings = DB::table('customers')
        ->join('billings','billings.customer_id', '=', 'customers.id')
        ->select('billings.*','customers.*')
        ->where('connection_date', '=', $date)
        ->get();

    $users = DB::table('billings')
        ->join('users', 'billings.userId', '=', 'users.userId')
        ->select('billings.*', 'users.username')
        ->where('billings.userId',Auth::user()->userId)
        ->first();

    return view('superadmin.report.showallcon',compact('billings','users'));
}

    public function inc($date){
        $billings = DB::table('incomes')
            ->join('users', 'incomes.userId', '=', 'users.userId')
            ->select('incomes.*', 'users.username')
            ->where('incda', '=', $date)
            ->get();

        $users = DB::table('incomes')
            ->join('users', 'incomes.userId', '=', 'users.userId')
            ->select('incomes.*', 'users.username')
            ->where('incomes.userId',Auth::user()->userId)
            ->first();

        return view('superadmin.report.showallinc',compact('billings','users'));
    }

    public function exp($date){

        $billings = DB::table('expenses')
            ->join('products', 'expenses.product_id', '=', 'products.id')
            ->select('expenses.*', 'products.name')
            ->where('date', '=', $date)
            ->get();
        return view('superadmin.report.showallexp',compact('billings','users'));
    }
}
