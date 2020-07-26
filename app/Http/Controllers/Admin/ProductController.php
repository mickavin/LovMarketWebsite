<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Product_category;
use App\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $shop = Shop::where('id',$id)->first();
        $products = Product::searchname($request->name)->where('shopId',$id)->paginate(40);
        return view('admin.product.index', compact('products','shop'));
    }


    public function intro($id)
    {
        $products = Product::where('shopId',$id)->take(5)->get();
        $categories = Product_category::where('shopId',$id)->take(5)->get();
        $shop = Shop::where('id',$id)->first();
        return view('admin.shop.intro', compact('products','categories','id','shop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $categories = Product_category::where('shopId',$id)->get();
        return view('admin.product.create', compact('categories','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request,$id)
    {

        Product::insert([
            'name' => $request['nom'],
            'description' => $request['description'],
            'price' => $request['prix'],
            'new_price' => $request['nouveau_prix'],
            'category_id' => $request['categorie'],
            'image' => $request['img'],
            'units' => 1,
            'shopId' => $id,
            'activated' => 1
        ]);

        $isDrop = Product::where('shopId',$id)->where('new_price','!=',null)->first();
        $shop = Shop::where('id',$id);

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

        return redirect()->route('admin.product.index',['commerce' => $id]);
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
    public function edit($shop_id,$product_id)
    {
        $categories = Product_category::where('shopId',$shop_id)->get();
        $product = Product::where('id',$product_id)->firstOrFail();
        $shop = Shop::where('id',$shop_id)->first();
        return view('admin.product.edit', compact('product','categories','shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $shop_id,$product_id)
    {
        $product = Product::where('id',$product_id)->firstOrFail();
        if($request->delete){
            $product->delete();
            return redirect()->route('admin.product.index',['commerce' => $shop_id]);
        }
        if($request->active){
            $product->update([
                'activated' => 1
            ]);
            return redirect()->route('admin.product.index',['commerce' => $shop_id]);
        }
        if($request->desactive){
            $product->update([
                'activated' => 0
            ]);
            return redirect()->route('admin.product.index',['commerce' => $shop_id]);
        }

        Product::where('id', $product->id)->update([
            'name' => $request['nom'],
            'description' => $request['description'],
            'price' => $request['prix'],
            'new_price' => $request['nouveau_prix'],
            'category_id' => $request['categorie'],
            'image' => $request['img'],
        ]);

        $isDrop = Product::where('shopId',$shop_id)->where('new_price','!=',null)->first();
        $shop = Shop::where('id',$shop_id);

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

        return redirect()->route('admin.product.index',['commerce' => $shop_id]);
    }

    public function active(Request $request)
    {
        if(isset($request->active)){
            $product = Product::where('id',intval($request->active))->firstOrFail();

            $product->update([
                'activated' => 1
            ]);
            return redirect()->back();
        }

        if(isset($request->desactive)){
            $product = Product::where('id',intval($request->desactive))->firstOrFail();
            $product->update([
                'activated' => 0
            ]);
            return redirect()->back();
        }
    }
}
