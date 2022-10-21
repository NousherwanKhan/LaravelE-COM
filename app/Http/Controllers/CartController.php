<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        // $buyer_id = $request->input('buyer_id');
        $product_id = $request->input('product_id');
        $t_qty = $request->input('t_qty');

        if (Auth::user()) {
            $product_check = Product::where('id', $product_id)->first();
            if ($product_check) {
                if (Cart::where('product_id', $product_id)->where('buyer_id', Auth::id())->exists()) {
                    return response()->json([
                        'status' => '200',
                        'message' => $product_check->name . ' Already added in Cart'
                    ]);
                } else {
                    $cart = new Cart;
                    $cart->buyer_id = Auth::id();
                    $cart->product_id = $product_id;
                    $cart->t_qty = $t_qty;
                    $cart->save();

                    return response()->json([
                        'status' => '201',
                        'message' => $product_check->name . ' Added to Cart'
                    ]);
                }
            }
        } else {
            return response()->json([
                'status' => '400',
                'message' => "You must login First"
            ]);
        }
    }

    public function cartview()
    {
        if (Auth::user()) {
            $carts = Cart::where('buyer_id', Auth::id())->get();
            
            return view('productview.cartview', compact('carts'));
        } else {
            return redirect('/');
        }
    }

    public function updatecart(Request $request)
    {
        $product_id = $request->input('product_id');
        $t_qty = $request->input('t_qty');

        if (Auth::user()) {
            if (Cart::where('product_id', $product_id)->where('buyer_id', Auth::id())->exists()) {
                $cart = Cart::where('product_id', $product_id)->where('buyer_id', Auth::id())->first();
                $cart->t_qty = $t_qty;
                $cart->update();

                return response()->json([
                    'status' => '201',
                    'message' => 'Cart Updated'
                ]);
            } else {
                return response()->json([
                    'status' => '400',
                    'message' => 'You Must Login First to Perform this Action'
                ]);
            }
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::user()) {
            $product_id = $request->input('product_id');
            if (Cart::where('product_id', $product_id)->where('buyer_id', Auth::id())->exists()) {
                $cartitem = Cart::where('product_id', $product_id)->where('buyer_id', Auth::id())->first();
                $cartitem->delete();
                return response()->json([
                    'status' => '201',
                    'message' => 'Product Deleted From Cart'
                ]);
            } else {
                return response()->json([
                    'status' => '400',
                    'message' => "You must login First"
                ]);
            }
        }
    }

    public function cartcount()
    {
        $cartcount = Cart::where('buyer_id', Auth::id())->count();
        return response()->json([
            'count' => $cartcount
        ]);
    }
}
