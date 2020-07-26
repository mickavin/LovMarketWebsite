<?php

namespace App\Http\Controllers;

use App\Shop_category;
use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Shop_category::searchcategory($request->category)
        ->paginate(40);
        return view('admin.shop_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shop_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|max:25|string',
        ]);

        Shop_category::insert([
            'category' => $request['category'],
        ]);

        return redirect()->route('category.shop.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop_category  $shop_category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop_category  $shop_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $category = Shop_category::where('id',$id)->firstOrFail();
        return view('admin.shop_category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop_category  $shop_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category' => 'required|max:25|string',
        ]);

        Shop_category::where('id',$id)->update([
            'category' => $request['category'],
        ]);

        return redirect()->route('category.shop.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop_category  $shop_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
