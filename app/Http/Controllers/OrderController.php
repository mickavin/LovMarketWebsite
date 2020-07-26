<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $id = Auth::user()->shopId;
        return view('order.index',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Order::insert([
            'order_id' => $request->id,
            'shop_id' => $request->shopId,
            'is_prepared' => 0,
            'is_delivered' => 0
        ]);

        return response()->json(['response' => 'La commande a bien été enregistré.'],200);
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
        $this->authorize('view',$order);
        $userId = Auth::user()->id;
        return view('order.show',compact('id','order','userId'));
    }

    public function validateOrder(Request $request, $id)
    {
        $order = Order::where('order_id',$id)->first();
        $this->authorize('validate',$order);
        if($request->validate == $id){
            Order::where('order_id',$id)->update([
                'order_id' => $id,
                'is_prepared' => 1
            ]);
            return redirect()->route('order.index');
        } else {
            return redirect()->back();
        }
    }

    public function stateOrder()
    {
        $shop_id = Auth::user()->shopId;
        $states = Order::where('shop_id', $shop_id)->get();
        return $states;
    }
}
