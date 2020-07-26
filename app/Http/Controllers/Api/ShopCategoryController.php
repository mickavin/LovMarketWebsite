<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Shop_category;
use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shop_category::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop_category  $shop_category
     * @return \Illuminate\Http\Response
     */
    public function show(Shop_category $shop_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop_category  $shop_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop_category $shop_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop_category  $shop_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop_category $shop_category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop_category  $shop_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop_category $shop_category)
    {
        //
    }
}
