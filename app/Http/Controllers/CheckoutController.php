<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;
use App\Models\Product;
use Session;
use Stripe;

class CheckoutController extends Controller
{
    public function index()
    {

        // $oldcart = Cart::where('buyer_id', Auth::id())->get();

        // foreach ($oldcart as $items) {
        //     if(Product::where('id', $items->product_id)->where('quantity', '>=', $items->t_qty)->exists())
        //     {
        //         $removeitems = Cart::where('buyer_id', Auth::id())->where('product_id', $items->product_id)->first();
        //         $removeitems->delete();
        //     } 
        // }
        $cart = Cart::where('buyer_id', Auth::id())->get();
        $total = 0;
            foreach ($cart as $item) {
                $total += $item->products->price * $item->t_qty;
            }
        return view("productview.checkout", compact('total','cart'));
    }

    public function placeorder(CheckoutRequest $request)
    {

        // if ($request) {
            $order = new Order;
            $order->buyer_id = Auth::id();
            $order->fname = $request->input('fname');
            $order->lname = $request->input('lname');
            $order->email = $request->input('email');
            $order->phone_number = $request->input('phone_number');
            $order->address = $request->input('address');
            $order->city = $request->input('city');
            $order->province = $request->input('province');
            $order->pin_code = $request->input('pin_code');
            $order->payment_mode = $request->input('payment_mode');
            $order->tracking_no = $request->input('fname') . rand(1111, 9999);
            $order->save();

            $cart = Cart::where('buyer_id', Auth::id())->get();

            foreach ($cart as $item) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'buyer_id' => Auth::id(),
                    'product_id' => $item->product_id,
                    'payment_status' => $request->input('payment_status'),
                    'price' => $item->products->price * $item->t_qty,
                    'quantity' => $item->t_qty
                ]);
            }

            $product = Product::where('id', $item->product_id)->first();
            $product->quantity = $product->quantity - $item->t_qty;
            $product->update();

            $cart = Cart::where('buyer_id', Auth::id())->get();
            Cart::destroy($cart);

            return redirect()->route('index')->with('success', 'Order Placed Successfully');
        // } else {
        //     return back();
        // }
    }


    public function payment(Request $request)
    {
        $order = new Order;
        $order->buyer_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone_number = $request->input('phone_number');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->province = $request->input('province');
        $order->pin_code = $request->input('pin_code');
        $order->payment_mode = $request->input('payment_mode');
        $order->tracking_no = $request->input('fname') . rand(1111, 9999);
        $order->save();

        return response()->json([
            'id' => $order->id,
            'firstname' => $order->fname,
            'lastname' => $order->lname,
            'email' => $order->email,
            'phoneNumber' => $order->phone_number,
            'address' => $order->address,
            'city' => $order->city,
            'province' => $order->province,
            'pincode' => $order->pin_code,
            'payment_mode' => $order->payment_mode,
            'tracking_no' => $order->tracking_no
        ]);
    }

    public function stripe($id)
    {
        // dd($id);
        $carts = Cart::where('buyer_id', Auth::id())->get();
        $total = 0;
        foreach ($carts as $item) {
            $total += $item->products->price * $item->t_qty;
        }
        if ($total == null) {
            return redirect('/');
        } else {
            return view('productview.payment', compact('total', 'id'));
        }
    }


    public function stripePost(Request $request, $id)

    {
        $cart = Cart::where('buyer_id', Auth::id())->get();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->products->price * $item->t_qty;
        }
        
        $product = Product::where('id', $item->product_id)->first();
            $product->quantity = $product->quantity - $item->t_qty;
            $product->update();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $total * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        $cart = Cart::where('buyer_id', Auth::id())->get();
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $id,
                'buyer_id' => Auth::id(),
                'product_id' => $item->product_id,
                'payment_status' => 'paid',
                'price' => $item->products->price * $item->t_qty,
                'quantity' => $item->t_qty
            ]);
        }


        $order = Order::where('payment_mode', 'card')->where('id', '!=', $id)->get();
        Order::destroy($order);

        $cart = Cart::where('buyer_id', Auth::id())->get();
        Cart::destroy($cart);

        return redirect('/')->with('success', 'Payment successful!');
    }

    public function paypal($id)
    {
    //     // dd($id);
        // $carts = Cart::where('buyer_id', Auth::id())->get();
        // $total = 0;
        // foreach ($carts as $item) {
        //     $total += $item->products->price * $item->t_qty;
        // }
        // if ($total == null) {
        //     return redirect('/');
        // } else {
        //     return view('productview.paypal', compact('total', 'id'));
        // }
    }
}

