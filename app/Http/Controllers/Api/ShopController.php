<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $type = $request->type;
        $category = $request->category;
        $activated = $request->activated;
        $drop = $request->drop;

        $shops = Shop::searchshopname($name)
        ->searchcategory($category)
        ->searchtype($type)
        ->isactivated($activated)
        ->isdrop($drop)
        ->get();

        return $shops;
    }

   public function getShopsSubDays()
   {
        $shops = Shop::whereDate('created_at', '>', Carbon::now()->subDays(60))
        ->get();

        return $shops;
   }
}
