<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = DB::table('expenses')
            ->join('products', 'expenses.product_id', '=', 'products.id')
            ->select('expenses.*', 'products.name')
            ->latest()->paginate(3);

      /*  $exp = DB::table('expenses')
            ->select('price', DB::raw('count(*) as count'))
            ->groupBy('product_id')
        ->get();
       // dd($exp);*/

        return view('expenses.index',compact('expenses'))
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
        return view('expenses.create',compact('product'));
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
            'price' => 'required',

        ]);
        $expense = new Expense();
        $expense->product_id = $request->product_id;
        $expense->userId = Auth::user()->userId;
        $expense->description = $request->description;
        $expense->price = $request->price;
        $expense->date = Carbon::now();
        $expense->month = Carbon::now()->format('M -Y');
        $expense->save();
        return redirect()->route('expenses.index',compact('expense'))
            ->with('success','Expenses created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expenses = Expense::find($id);
        return view('expenses.show',compact('expenses'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::all();
        $expenses = Expense::find($id);
        return view('expenses.edit',compact('expenses','product'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'product_id' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        Expense::find($id)->update($request->all());

        return redirect()->route('expenses.index')
            ->with('success','Expense updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::find($id)->delete();

        return redirect()->route('expenses.index')
            ->with('success','Expenses deleted successfully');
    }

    public function report()
    {
        $total = DB::table('expenses')->sum('price');

        /* $exp = DB::table('expenses')
            ->join('products', 'expenses.product_id', '=', 'products.id')
            ->select('expenses.price','expenses.product_id', 'products.*', DB::raw('sum(price) as sums'))
          ->groupBy('product_id')
            ->get();

        dd($exp);*/


        $expenses = Expense::select(
            DB::raw('sum(price) as sums'),
            DB::raw('(product_id) as heads')
        )
            ->groupBy('heads')
            ->get();

        return view ('superadmin.expense.new',['expenses' =>$expenses,'total' => $total])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    public function exp($date){

        $billings = DB::table('expenses')
            ->join('products', 'expenses.product_id', '=', 'products.id')
            ->select('expenses.*', 'products.name')
            ->where('date', '=', $date)
            ->get();
        return view('superadmin.report.showallexp',compact('billings'));
    }

}
