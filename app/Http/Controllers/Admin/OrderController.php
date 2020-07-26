<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('order_id',$id)->first();
        return view('admin.order.show',compact('id','order'));
    }

    public function validateOrder(Request $request, $id)
    {
        if($request->validate == $id){
            Order::insert([
                'order_id' => $id,
                'is_delivered' => 0
            ]);
            return redirect()->route('order.index');
        } else {
            return redirect()->back();
        }
    }

    public function stateOrder()
    {
        $states = Order::all();
        return $states;
    }
}
