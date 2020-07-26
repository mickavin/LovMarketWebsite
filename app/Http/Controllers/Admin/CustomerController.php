<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::searchid($request->name)
        ->searchname($request->name)
        ->searchphone($request->name)
        ->searchemail($request->name)
        ->paginate(40);
        return view('admin.customer.index', compact('customers'));
    }
}
