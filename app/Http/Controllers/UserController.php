<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProductRequest;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');
        // dd($request);
        if (Auth::attempt($credentials)) {
            // if (Auth::user()) {

            if (Auth::user()->role_id ==  User::ROLE_USER) {

                return redirect()->route('upload');
            } else if (Auth::user()->role_id == User::ROLE_ADMIN) {

                return redirect()->route('post');
            }
            // } else {
            //     return redirect()->back()->with('message', 'User is banned');
            // }
        } else {
            return redirect()->back()->with('message', 'Incorrect Email or Password');
        }
    }


    public function show()
    {
        $products = Product::where('buyer_id', Auth::id())->get();
        return view('useraccess.uploads', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myorder()
    {
        $orderitems = OrderItem::where('buyer_id', Auth::id())->get();
        return view('useraccess.myorders', compact('orderitems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $Product = new Product;

        $Product->name = $request->input('name');
        $Product->description = $request->input('description');
        $Product->buyer_id = Auth::user()->id;
        $Product->price = $request->input('price');
        $Product->quantity = $request->input('quantity');


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/images/Product/', $filename);
            $Product->image = $filename;
        }
        $Product->save();

        return redirect()->route('upload')->with('success', 'Product Listed Successfully, It will become live sortly after examination');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('buyer_id', Auth::user()->id)->find($id);

        if (!$product || $product->status == Product::REJECTED || $product->status == null) {
            return back();
        } else {
            return view('useraccess.edit', compact('product'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::where('buyer_id', Auth::user()->id)->find($id);
        $path = 'public/images/Product/' . $product->image;


        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if ($request->hasFile('image')) {
            $path = 'public/images/Product/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/images/Product/', $filename);
            $product->image = $filename;
        } 
        
        $product->save();

        return redirect()->route('upload')->with('success', 'Product Listed Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('buyer_id', Auth::user()->id)->find($id);
        if ($product) {
            $path = 'public/images/Product/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $product->delete();
            return redirect()->back()
                ->with('success', 'Product List Deleted successfully.');
        }
    }
}
