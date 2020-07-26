<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Shop_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shops = Shop::searchname($request->name)
        ->searchid($request->name)
        ->searchphone($request->name)
        ->paginate(40);
        return view('admin.shop.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Shop_category::all();
        return view('admin.shop.create', compact('categories'));
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
            'name' => 'required|max:40|unique:shops|string',
            'description' => 'required|max:100|string',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'required|mimes:jpeg,png',
            'img' => 'required',
            'category' => 'required|numeric|exists:shop_categories,id',
            'type' => 'required|numeric',
            'latitude' => ['required','regex:/^(\+|-)?(?:90(?:(?:\.0{1,8})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,8})?))$/'],
            'longitude' => ['required','regex:/^(\+|-)?(?:180(?:(?:\.0{1,8})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,8})?))$/']
        ]);

        $shop = Shop::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'phoneNumber' => $request['phone'],
            'address' => $request['address'],
            'category_id' => $request['category'],
            'image' => $request['img'],
            'type' => $request['type'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'drop' => 0,
            'activated' => 0
        ]);

        return redirect()->route('shop.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $type = [
            1 => 'Commerce',
            2 => 'Restaurant',
            3 => 'Service'
        ];
        $id = Auth::user()->shopId;
        $shop = Shop::where('id',$id)->first();
        $this->authorize('view',$shop);
        return view('shop.show',compact('shop','type'));
    }

    public function updateShop(Request $request)
    {
        $id = Auth::user()->shopId;
        $shop = Shop::where('id',$id)->first();
        $this->authorize('update',$shop);
        if($request->active){
            $shop->update([
                'activated' => 1
            ]);
            return redirect()->route('shop.show');
        }
        if($request->desactive){
            $shop->update([
                'activated' => 0
            ]);
            return redirect()->route('shop.show');
        }
        $validatedData = $request->validate([
            'description' => 'required|max:100',
        ]);
        $shop->update([
            'description' => $request['description']
        ]);
        return redirect()->route('shop.show');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = [
            1 => 'Commerce',
            2 => 'Restaurant',
            3 => 'Service'
        ];
        $categories = Shop_category::all();
        $shop = Shop::where('id',$id)->firstOrFail();
        return view('admin.shop.edit', compact('shop','categories','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shop = Shop::where('id',$id)->firstOrFail();
        if($request->delete){
            $shop->delete();
            return redirect()->route('shop.index');
        }
        if($request->active){
            $shop->update([
                'activated' => 1
            ]);
            return redirect()->route('shop.index');
        }
        if($request->desactive){
            $shop->update([
                'activated' => 0
            ]);
            return redirect()->route('shop.index');
        }
        $validatedData = $request->validate([
            'name' => 'required|max:40',
            'description' => 'required|max:100',
            'phone' => 'required',
            'address' => 'required',
            'img' => 'required',
            'category' => 'required|numeric|exists:shop_categories,id',
            'type' => 'required|numeric',
            'latitude' => ['required','regex:/^(\+|-)?(?:90(?:(?:\.0{1,8})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,8})?))$/'],
            'longitude' => ['required','regex:/^(\+|-)?(?:180(?:(?:\.0{1,8})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,8})?))$/']
        ]);

        Shop::where('id', $shop->id)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'phoneNumber' => $request['phone'],
            'address' => $request['address'],
            'category_id' => $request['category'],
            'image' => $request['img'],
            'type' => $request['type'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'drop' => 0,
            'activated' => 0
        ]);

        return redirect()->route('shop.index');
    }

    public function search()
    {
        return view('admin.shop.search');
    }

    public function searchPost(Request $request)
    {
        if(isset($request->shop)){
            $shop = Shop::where('name',$request->shop)->first();
            if($shop->exists()){
                return redirect()->route('admin.intro.index',['commerce' => $shop->id]);
            }else{
                return redirect()->back()->with('error', "Ce commerce n'a pas été trouvé. Veuillez réessayer.");
            }
        } else {
            return redirect()->back()->with('error', "Une erreur est survenue. Veuillez réessayer.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
