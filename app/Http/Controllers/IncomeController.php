<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Income;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shows = DB::table('incomes')
            ->join('products', 'incomes.product_id', '=', 'products.id')
            ->select('incomes.*', 'products.name')
            ->orderBy('id', 'DESC')->paginate(5);

        $total = DB::table('incomes')->sum('amount');
       // $incomes = Income::latest()->paginate(5);
        return view('income.index',compact('total','shows'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();
        return view('income.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'product_id' => 'required',
            'amount' => 'required',

        ]);
      $income = new Income();
        $income->userId = Auth::user()->userId ;
        $income->product_id = $request->product_id;
        $income->amount = $request->amount;
        $income->account_details = $request->account_details;
        $income->incda = Carbon::now();
        $income->save();

        return redirect()->route('income.index')
            ->with('success',' created successfully.',compact('income'));
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        return view('income.index',compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        $product = Product::all();
        return view('income.edit',compact('income','product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        request()->validate([
            'product_id' => 'required',
            'amount' => 'required',

        ]);
        $income->update($request->all());


        return redirect()->route('income.index')
            ->with('success','Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('income.index')
            ->with('success',' deleted successfully');

    }
    public function filter(Request $request)
    {
        $startDt = date('Y-m-d', strtotime($request->startDate));
        $endDt = date('Y-m-d', strtotime($request->endDate));

        $data = DB::table('incomes')
            ->whereBetween('incda', [$startDt, $endDt])
            ->paginate(7);

        return view('superadmin.search.isearch', compact( 'data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function idfiter(Request $request)
    {
        $startDt = date('Y-m-d', strtotime($request->startDate));
        $endDt = date('Y-m-d', strtotime($request->endDate));

        $data = DB::table('billings')
            ->whereBetween('month', [$startDt, $endDt])
            ->get();

        $data1 = DB::table('incomes')
            ->whereBetween('incda', [$startDt, $endDt])
            ->get();

        $data2 = DB::table('customers')
            ->whereBetween('connection_date', [$startDt, $endDt])
            ->get();
      //  dd($data2,$data,$data1);
        $users = collect($data)->merge($data1)->merge($data2);
//dd($users);

        return view('superadmin.search.irsearch', compact( 'users','data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    }
