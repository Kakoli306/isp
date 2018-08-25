<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use DB;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('superadmin.expense.expview')->with('expenses', $expenses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        print($request);
        $expense = Expense::create($request->input());

        return response()->json($expense);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($expense_id)
    {
        $expense = Expense::find($expense_id);
        return response()->json($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $expense_id)
    {
        $expense = Expense::find($expense_id);
        $expense->name = $request->name;
        $expense->price = $request->price;
        $expense->save();
        return response()->json($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($expense_id)
    {
        $expense = Expense::destroy($expense_id);
        return response()->json($expense);
    }

    public function report()
    {
        $total = DB::table('expenses')->sum('price');
        $currentMonth = date('m');
        $expenses = DB::table('expenses')
            ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
            ->get();

        return view ('superadmin.expense.new',['expenses' =>$expenses,'total'=> $total]);

    }
}
