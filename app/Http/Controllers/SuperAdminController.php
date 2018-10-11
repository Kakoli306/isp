<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Customer;
use App\Expense;
use App\Income;
use App\Product;
use App\User;
use App\Zone;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Input;
use Nexmo\Laravel\Facade\Nexmo;
class SuperAdminController extends Controller
{
    public function index(){

        $zones = Zone::count();
        $users = User::count();
        $customers = Customer::count();
        $incomes = Income::sum('amount');
        $expenses = Expense::sum('price');
        $heads = Product::count();
        $cust = Customer::orderBy('id', 'desc')->take(3)->get();
        $user = User::orderBy('userId', 'desc')->take(3)->get();

        $exp = DB::table('expenses')->sum('price');
        $bill = DB::table('billings')->sum('payment_amount');

        return view('superadmin.home.homeContent',compact('zones','users','customers','incomes','expenses','heads','cust','user','exp','bill'));
    }

    public function headshow($id){
        $heads = Product::where('product_id',$id)->get();

        return view('superadmin.report.showallHead',compact('heads'));
    }

    public function yearly(){
       //$ab = Billing::whereYear('created_at', '=', Carbon::parse($date)->format('Y'))->get();
        //dd($ab);

        $ab = Billing::select(
            DB::raw('sum(payment_amount) as sums'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
        )
            ->whereYear('created_at',Carbon::now()->year)
            ->groupBy('months')
            ->get();

        $inc = Income::select(
            DB::raw('sum(amount) as incomes'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
        )
            ->whereYear('created_at',Carbon::now()->year)
            ->groupBy('months')
            ->get();

        $conn = Customer::select(
            DB::raw('sum(connection_charge) as charge'),
            DB::raw("DATE_FORMAT(connection_date,'%M %Y') as months")
        )
            ->whereYear('connection_date',Carbon::now()->year)
            ->groupBy('months')
            ->get();

        $exp = Expense::select(
            DB::raw('sum(price) as expenses'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
        )
            ->whereYear('created_at',Carbon::now()->year)
            ->groupBy('months')
            ->get();

        $all = collect($ab)->merge($inc)->merge($conn)->merge($exp);
        $merged = $all->sortBy('months');


        $year = $merged
            ->groupBy(function ($merged) {
                return ($merged->months);
            });

        return view ('superadmin.report.yearly',compact('year','merged'));

    }

    public function new($month)
    {
        // return $month;
       $d =  Billing::where('month')
            ->orWhere('month', 'like', '%' . Input::get('month') . '%')->get();
//dd($d);

        $ab = Billing::select(
            DB::raw('sum(payment_amount) as sums'),
            DB::raw("(month) as month")
        )
            ->groupBy('month')
            ->orWhere(DB::raw("month"),$month, 'like', '%' )
            ->get();
       // dd($ab);


        $ab = Billing::select(
            DB::raw('sum(payment_amount) as sums'),
            DB::raw("DATE_FORMAT(month,'%Y-%m') as month")
        )
                ->groupBy('month')
                ->orWhere(DB::raw("(DATE_FORMAT(month,'%Y-%m'))"),$month, 'like', '%' )
           // ->orWhere('month', 'like', '%' . Input::get($month) . '%')
            ->get();


        $income = Income::select(
            DB::raw('sum(amount) as incomes'),
            DB::raw("DATE_FORMAT(created_at,'%Y-%m') as month")
        )
            ->groupBy('month')
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"),$month)
            ->get();

        $con = Customer::select(
            DB::raw('sum(connection_charge) as charge'),
            DB::raw("DATE_FORMAT(connection_date,'%Y-%m') as month")
        )
            ->groupBy('month')
            ->where(DB::raw("(DATE_FORMAT(connection_date,'%Y-%m'))"),$month)
            ->get();

        $expense = Expense::select(
            DB::raw('sum(price) as expenses'),
            DB::raw("DATE_FORMAT(created_at,'%Y-%m') as dates")
        )
            ->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"),$month)
            ->groupBy('dates')
            ->get();


        $news = collect($ab)->merge($income)->merge($con)->merge($expense);
         // dd($news);

        $merged = $news->sortBy('month');

        $res = $merged
            ->groupBy(function ($merged) {
                return $merged->month;

            });

        return view ('superadmin.report.probmonth',compact('res','merged'));


    }

    public function downloadPDF($id)
    {
        $customer = DB::table('customers')
            ->join('zones', 'customers.zone_id', '=', 'zones.id')
            ->select('customers.*', 'zones.zone_name')
            ->where('customers.id',$id)->first();
           return view('superadmin.pdf',compact('customer'));
    }

    public function download($id)
    {
        $customer = DB::table('customers')
            ->join('zones', 'customers.zone_id', '=', 'zones.id')
            ->select('customers.*', 'zones.zone_name')
            ->where('customers.id',$id)->first();


            //Customer::find($id);

        $pdf = PDF::loadView('superadmin.pdf', compact('customer'));
        return $pdf->download('Billing.pdf');

    }

public function chart()
    {
        $exp = DB::table('expenses')->sum('price');
        $bill = DB::table('billings')->sum('payment_amount');

        /*DB::table('expenses')
            ->select(
                DB::raw("month as month"),
                DB::raw("SUM(price) as price"))
            ->orderBy('month', 'ASC')
            ->groupBy(DB::raw("month"))
            ->get();*/

        //dd($result);
        return response()->json($exp,$bill);

    }

    public function newchart()
    {
        $result1 = DB::table('billings')
            ->select(
                DB::raw("dmon as dmon"),
                DB::raw("SUM(payment_amount) as amount"))
            ->orderBy('dmon', 'ASC')
            ->groupBy(DB::raw("dmon"))
            ->get();

        return response()->json($result1);
    }




 public function send(){
        Nexmo::message()->send([
            'to'   => '01521517435',
            'from' => '01683731580',
            'text' => 'Using the facade to send a message.'
        ]);
    }




}
