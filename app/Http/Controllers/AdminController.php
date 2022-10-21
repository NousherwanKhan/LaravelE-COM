<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::query()->orderby(Product::raw('case when status= "Pending" then 1 when status= "Rejected" then 2 when status= "Approved" then 3 end'))
        ->Active()
        ->latest()
        ->paginate(5);
        return view('adminaccess.userproducts', compact('products'));
    }

    public function allusers()
    {
        return view('adminaccess.alluser');
    }

    public function accept($id)
    {
        $post = Product::find($id);
        $post->status = $post->status = Product::APPROVED;
        $post->save();


        $user = $post->user->email;
        $data = [
            'body' => 'your post was approved and you can see it in feeds'
        ];

        Mail::send('adminaccess.productinfo', ['data' => 'Your Post Was Approved'], function ($message) use ($user) {
            $message->to($user);
            $message->subject('Post Approved Mail');
        });
        return redirect('post')->with('success', 'Status Approved Succesfully');
    }

    public function reject($id)
    {
        $post = Product::find($id);
        $post->status = $post->status = Product::REJECTED;
        $post->save();

        $user = $post->user->email;

        Mail::send('adminaccess.productinfo', ['data' => Product::REJECTED], function ($message) use ($user) {
            $message->to($user);
            $message->subject('Email Verification Mail');
        });

        return redirect('post')->with('success', 'Status Rejected Succesfully');
    }

    public function users()
    {

        $users = User::get();

        return view('adminaccess.alluser', compact('users'));
    }

    public function unbanned($id)
    {
        $user = User::find($id);
        $user->active = $user->active = User::ACTIVE;
        $user->save();

        return redirect('users')->with('success', 'User is unbanned Successfully');
    }
    public function banned($id)
    {
        $user = User::find($id);

        if ($user->role_id == User::ROLE_ADMIN) {
            return back()->with('error', 'You Can not Ban Admin');
        } else
            $user->active = $user->active = User::BANNED;
        $user->save();
        return redirect('users')->with('success', 'User Banned Succesfully');
    }
    public function orders()
    {
        $orderitems = OrderItem::get();
        return view('adminaccess.orders', compact('orderitems'));
    }

    public function deliver($id){
        $status = Order::find($id);
        $status->status = Order::DELIVERED;
        $status->save();

        return redirect()->route('userorders')->with('success', 'Status Changed to Delivered Succesfully');

    }
}
