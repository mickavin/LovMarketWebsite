<?php

namespace App\Http\Controllers;

use App\Product;
use App\Product_category;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',Product::class);
        $products = Product::searchname($request->name)->where('shopId',Auth::user()->shopId)->paginate(40);
        return view('product.list', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Product::class);
        $categories = Product_category::where('shopId',Auth::user()->shopId)->get();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create',Product::class);

        Product::insert([
            'name' => $request['nom'],
            'description' => $request['description'],
            'price' => $request['prix'],
            'new_price' => $request['nouveau_prix'],
            'category_id' => $request['categorie'],
            'image' => $request['img'],
            'units' => 1,
            'shopId' => Auth::user()->shopId,
            'activated' => 1
        ]);

        $isDrop = Product::where('shopId', Auth::user()->shopId)->where('new_price','!=',null)->first();
        $shop = Shop::where('id', Auth::user()->shopId);

        if($isDrop !== null && $shop->where('drop',0)->first() !== null){
            $shop->update([
                'drop' => 1
            ]);
        }
        if($isDrop === null && $shop->where('drop',1)->first() !== null){
            $shop->update([
                'drop' => 0
            ]);
        }

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Product_category::where('shopId',Auth::user()->shopId)->get();
        $product = Product::where('id',$id)->firstOrFail();
        $this->authorize('update',$product);
        return view('product.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::where('id',$id)->firstOrFail();
        $this->authorize('update',$product);
        if($request->delete){
            $product->delete();
            return redirect()->route('product.index');
        }
        if($request->active){
            $product->update([
                'activated' => 1
            ]);
            return redirect()->route('product.index');
        }
        if($request->desactive){
            $product->update([
                'activated' => 0
            ]);
            return redirect()->route('product.index');
        }

        Product::where('id', $product->id)->update([
            'name' => $request['nom'],
            'description' => $request['description'],
            'price' => $request['prix'],
            'new_price' => $request['nouveau_prix'],
            'category_id' => $request['categorie'],
            'image' => $request['img'],
        ]);

        $isDrop = Product::where('shopId',Auth::user()->shopId)->where('new_price','!=',null)->first();
        $shop = Shop::where('id',Auth::user()->shopId);

        if($isDrop !== null && $shop->where('drop',0)->first() !== null){
            $shop->update([
                'drop' => 1
            ]);
        }
        if($isDrop === null && $shop->where('drop',1)->first() !== null){
            $shop->update([
                'drop' => 0
            ]);
        }

        return redirect()->route('product.index');
    }

    public function active(Request $request)
    {
        if(isset($request->active)){
            $product = Product::where('id',intval($request->active))->firstOrFail();

            $product->update([
                'activated' => 1
            ]);
            return redirect()->route('product.index');
        }

        if(isset($request->desactive)){
            $product = Product::where('id',intval($request->desactive))->firstOrFail();
            $product->update([
                'activated' => 0
            ]);
            return redirect()->route('product.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
