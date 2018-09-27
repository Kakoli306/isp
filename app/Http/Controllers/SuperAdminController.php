<?php

namespace App\Http\Controllers;

use App\Billing;
use App\Customer;
use App\Expense;
use App\Income;
use App\Product;
use App\User;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use ConsoleTVs\Charts;
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

        return view('superadmin.home.homeContent',compact('zones','users','customers','incomes','expenses','heads','cust'));
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
                return $merged->months;
            });
        return view ('superadmin.report.yearly',compact('year','merged'));

    }

    public function new($month)
    {
        // return $month;

        $ab = Billing::select(
            DB::raw('sum(payment_amount) as sums'),
            DB::raw("DATE_FORMAT(month,'%Y-%m') as months")
        )
            ->groupBy('months')
            ->get();
        dd($ab);

    }

  /*  public function pdfview($id){

        $customers = Customer::find($id);
        //$users = DB::table("users")->get();
        view()->share('customers',$customers);

            $pdf = PDF::loadView('superadmin.pdfview');
            return $pdf->download('pdfview.pdf');

    }*/

    public function downloadPDF($id)
    {
        $customers = Customer::find($id);

        $pdf = PDF::loadView('superadmin.pdf', compact('customers'));
        return $pdf->download('invoice.pdf');
    }

    public function abc()
    {
        return view('index');
    }

    public function chart()
    {
        $result = DB::table('expenses')
            ->select(
                DB::raw("month(created_at) as month"),
                DB::raw("(price) as total_click"))
              ->orderBy('month', 'ASC')
            ->get();
        return response()->json($result);
    }

   /* public function chart()
    {
        $result = DB::table('stocks')
            ->select(
                DB::raw("month(created_at) as month"))
            ->orderBy('stockYear', 'ASC')
                    ->where('stockName','=','Infosys')

                    ->get();
        return response()->json($result);
    }*/

  /*  public function chart()

    {
          $result = \DB::table('stocks')
                    ->where('stockName','=','Infosys')
                    ->orderBy('stockYear', 'ASC')
                    ->get();

        $income = DB::table('incomes')
            ->select(
                DB::raw("month(created_at) as month"),
                DB::raw("SUM(amount) as total_click"))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get();

        $result[] = ['Month','Amount'];
        foreach ($income as $key => $value) {
            $result[++$key] = [$value->month, (int)$value->total_click];
        }

        return response()->json($result);

    }*/

}
