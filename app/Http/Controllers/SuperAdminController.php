<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Expense;
use App\Income;
use App\Product;
use App\User;
use App\Zone;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index(){

        $zones = Zone::count();
        $users = User::count();
        $customers = Customer::count();
        $incomes = Income::count();
        $expenses = Expense::count();
        $heads = Product::count();

        return view('superadmin.home.homeContent',compact('zones','users','customers','incomes','expenses','heads'));
    }

    public function headshow($id){
        $heads = Product::where('product_id',$id)->get();

        return view('superadmin.report.showallHead',compact('heads'));
    }
}
