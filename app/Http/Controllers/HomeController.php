<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\order_item;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function index()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $product = Product::all();
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');
            return view('home.userpage', compact('product', 'cartcount'));
        } else {
            $product = Product::all();
            return view('home.userpage', compact('product'));
        }
    }

    public function products()
    {
        $product = Product::all();
        $category = Category::all();
        $category_name = "";
        $sort = "";

        if (Request::get('sort') == 'price_asc') {
            $product = Product::orderBy('product_price', 'asc')->get();
            $sort = "Price - Low to High";
        } elseif (Request::get('sort') == 'price_desc') {
            $product = Product::orderBy('product_price', 'desc')->get();
            $sort = "Price - High to Low";
        } elseif (Request::get('sort') == 'newest') {
            $product = Product::orderBy('created_at', 'desc')->get();
            $sort = "Newest";
        } elseif (Request::get('sort') == 'name_desc') {
            $product = Product::orderBy('name', 'desc')->get();
            $sort = "Name - Z to A";
        } elseif (Request::get('sort') == 'name_asc') {
            $product = Product::orderBy('name', 'asc')->get();
            $sort = "Name - A to Z";
        }

        if (Auth::id()) {
            $user = Auth::user();
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');
        } else {
            $user = 0;
            $cartcount = 0;
        }

        return view('home.allproduct', compact('user', 'product', 'cartcount', 'category', 'sort', 'category_name'));
    }

    public function category($category_name)
    {
        $category = Category::all();
        $product = Product::where('category', '=', $category_name)->get();
        $sort = "";
        $category_name = ": " . $category_name;
        if (Request::get('sort') == 'price_asc') {
            $product = Product::where('category', '=', $category_name)
                ->orderBy('product_price', 'asc')->get();
            $sort = "Price - Low to High";
        } elseif (Request::get('sort') == 'price_desc') {
            $product = Product::where('category', '=', $category_name)
                ->orderBy('product_price', 'desc')->get();
            $sort = "Price - High to Low";
        } elseif (Request::get('sort') == 'newest') {
            $product = Product::orderBy('created_at', 'desc')->get();
            $sort = "Newest";
        } elseif (Request::get('sort') == 'name_desc') {
            $product = Product::where('category', '=', $category_name)
                ->orderBy('name', 'desc')->get();
            $sort = "Name - Z to A";
        } elseif (Request::get('sort') == 'name_asc') {
            $product = Product::where('category', '=', $category_name)
                ->orderBy('name', 'asc')->get();
            $sort = "Name - A to Z";
        }

        if (Auth::id()) {
            $user = Auth::user();
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');
        } else {
            $user = 0;
            $cartcount = 0;
        }

        return view('home.allproduct', compact('user', 'product', 'cartcount', 'category', 'sort', 'category_name'));
    }

    public function product_details($id)
    {
        $product = Product::find($id);
        if (Auth::id()) {
            $user = Auth::user();
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');
        } else {
            $cartcount = 0;
        }

        return view('home.product_detail', compact('product', 'cartcount'));
    }

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

            return redirect('order');
        } else {
            return redirect('login');
        }
    }

    public function order()
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $order = order::where('user_id', '=', $userid)->get();
            $cartcount = cart::where('user_id', '=', $userid)->get()->sum('quantity');

            return view('home.order', compact('user', 'order', 'cartcount'));
        } else {
            return redirect('login');
        }
    }

    public function order_detail($id)
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');

            $order = order::find($id);
            // $orderitem = order_item::where('order_id', '=', $order->id)->get();
            $orderitem = order_item::join('products', 'products.id', '=', 'order_items.product_id')
                // ->select('order_id', 'products.id')
                ->where('order_id', '=', $order->id)
                ->get();

            // dd($orderitem);


            return view('home.order_detail', compact('user', 'order', 'orderitem', 'cartcount'));
        } else {
            return redirect('login');
        }
    }

    public function profile()
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');

            return view('home.profile', compact('user', 'cartcount'));
        } else {
            return redirect('login');
        }
    }

    public function update_profile()
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');

            return view('home.update_profile', compact('user', 'cartcount'));
        } else {
            return redirect('login');
        }
    }

    public function update_profile_confirm(Request $request)
    {
        if (Auth::id()) {

            $user = Auth::user();
            $userid = $user->id;
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');

            $user = user::find($userid);
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->email = $request->email;

            $user->save();

            return redirect('profile');
            // view('home.update_profile', compact('user','cartcount'));
        } else {
            return redirect('login');
        }
    }

    public function searchproduct(Request $request)
    {
        if (Request::get('query')) {
            $query = Request::get('query');
            $data = DB::table('products')->where('name', 'like', '%' . $query . '%')->get();
            $output = '<ul class="dropdown-menu" style="display:block;position:relative;padding-right: 8rem">';
            foreach ($data as $row) {
                $output .= '<li style="margin-left:1rem"><a href="products/' . $row->id . '">' . $row->name . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
