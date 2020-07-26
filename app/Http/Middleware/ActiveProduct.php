<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Product;

class ActiveProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if(isset($request->active)){
            $product = Product::where('id',intval($request->active))->first();
            if($product->shopId != $user->shopId){
                return redirect()->route('product.index');
            }
        }
        if(isset($request->desactive)){
            $product = Product::where('id',intval($request->desactive))->first();
            if($product->shopId != $user->shopId){
                return redirect()->route('product.index');
            }
        }
        return $next($request);
    }
}
