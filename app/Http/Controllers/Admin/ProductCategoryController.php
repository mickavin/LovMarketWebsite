<?php

namespace App\Http\Controllers\Admin;

use App\Product_category;
use App\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $categories = Product_category::searchcategory($request->category)
        ->where('shopId',$id)->paginate(40);
        $shop = Shop::where('id',$id)->first();
        return view('admin.product_category.index', compact('categories','shop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.product_category.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $validatedData = $request->validate([
            'categorie' => 'required|max:25|string',
        ]);

        Product_category::insert([
            'category' => $request['categorie'],
            'shopId' => $id
        ]);
        return redirect()->route('admin.category.index',['commerce' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product_category  $product_category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product_category  $product_category
     * @return \Illuminate\Http\Response
     */
    public function edit($shop_id,$category_id)
    {
        $category = Product_category::where('id',$category_id)->firstOrFail();
        $shop = Shop::where('id',$shop_id)->firstOrFail();

        return view('admin.product_category.edit', compact('category','shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_category  $product_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$shop_id,$category_id)
    {
        $validatedData = $request->validate([
            'categorie' => 'required|max:25|string',
        ]);

        Product_category::where('id', $category_id)->update([
            'category' => $request['categorie'],
        ]);
        return redirect()->route('admin.category.index',['commerce' => $shop_id]);
    }
}
