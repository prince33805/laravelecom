<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\order_item;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function add_cart(Request $request, $id)
    {

        $user = Auth::user();
        $product = product::find($id);

        $cart = new cart;

        if (Auth::id()) {
            $cart->user_id = $user->id;
            $cart->name = $user->name;
            $cart->phone = $user->phone;
            $cart->address = $user->address;

            $cart->product_id = $product->id;
            $cart->product_name = $product->name;
            $cart->image = $product->image;
            $cart->priceperpiece = $product->product_price;
            $cart->quantity = $request->quantity;
            $cart->price = ($request->quantity) * ($product->product_price);

            $cart->save();
            alert::success('Product Added Successfully', 'We have added product to the cart ');
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = cart::where('user_id', '=', $id)->get();
            $cartcount = cart::where('user_id', '=', $id)->get()->sum('quantity');

            return view('home.cart', compact('cart', 'cartcount'));
        } else {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        if (Auth::id()) {
            $cart = cart::find($id);
            // alert::success('SuccessAlert','Lorem ipsum dolor sit amet.')->showConfirmButton('Confirm', '#3085d6')->showCancelButton('Cancel', '#aaa');
            $cart->delete();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function confirm_cart()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');
            $cart = cart::where('user_id', '=', $user->id)->get();

            return view('home.confirm_cart', compact('user', 'cartcount', 'cart'));
        } else {
            return redirect('login');
        }
    }

    public function checkout(Request $request)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $data = cart::where('user_id', '=', $userid)->get();

            $totalquantity = $request->get('totalquantity');
            $totalprice = $request->get('totalprice');

            $order = new order;
            $order->user_id = $userid;
            $order->name = $user->name;
            $order->email = $user->email;
            $order->address = $user->address;
            $order->phone = $user->phone;
            $order->totalquantity = $totalquantity;
            $order->totalprice = $totalprice;
            $order->paymenytype = 'cash on delivery';
            $order->paymenystatus = 'processing';
            $order->deliverystatus = 'pending';
            $order->save();

            foreach ($data as $data) {
                $orderitem = new order_item;
                $orderitem->order_id = $order->id;
                $orderitem->user_id = $userid;
                $orderitem->product_id = $data->product_id;
                $orderitem->product_name = $data->product_name;
                $orderitem->quantity = $data->quantity;
                $orderitem->priceperpiece = $data->priceperpiece;
                $orderitem->price = $data->price;
                $orderitem->save();

                $product = product::where('id', '=', $data->product_id)
                    ->decrement('product_quantity', $orderitem->quantity);

                $data->delete();
            }

            alert::success('Order Submitted Successfully', 'We have placed your order.');
            return redirect('orders');
        } else {
            return redirect('login');
        }
    }

}
