<?php

namespace App\Http\Controllers;

use App\Product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',Product_category::class);
        $categories = Product_category::searchcategory($request->category)
        ->where('shopId',Auth::user()->shopId)->paginate(40);
        return view('product_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Product_category::class);
        return view('product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Product_category::class);
        $validatedData = $request->validate([
            'categorie' => 'required|max:25|string',
        ]);

        Product_category::insert([
            'category' => $request['categorie'],
            'shopId' => Auth::user()->shopId
        ]);
        return redirect()->route('category.product.index');
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
    public function edit($id)
    {
        $category = Product_category::where('id',$id)->firstOrFail();
        $this->authorize('update',$category);
        return view('product_category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_category  $product_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Product_category::where('id',$id)->firstOrFail();
        $this->authorize('update',$category);
        $validatedData = $request->validate([
            'categorie' => 'required|max:25|string',
        ]);

        Product_category::where('id', $category->id)->update([
            'category' => $request['categorie'],
        ]);
        return redirect()->route('category.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_category  $product_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
