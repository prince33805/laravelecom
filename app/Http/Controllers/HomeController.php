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
        $categoryname = "";
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

        return view('home.allproduct', compact('user', 'product', 'cartcount', 'category', 'sort', 'categoryname'));
    }

    public function category($category_name)
    {
        $category = Category::all();
        $product = Product::where('category', '=', $category_name)->get();
        $sort = "";
        $categoryname = ": " . $category_name;
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

        // dd($product);

        if (Auth::id()) {
            $user = Auth::user();
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');
        } else {
            $user = 0;
            $cartcount = 0;
        }

        return view('home.allproduct', compact('user', 'product', 'cartcount', 'category', 'sort', 'categoryname'));
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
            $user->name = Request::get('name');
            $user->phone = Request::get('phone');
            $user->address = Request::get('addess');
            $user->email = Request::get('email');

            $user->save();

            return redirect('profile');
            // view('home.update_profile', compact('user','cartcount'));
        } else {
            return redirect('login');
        }
    }

    // style="border:1px solid red;width: 1000px;"

    public function searchproduct(Request $request)
    {
        if (Request::get('query')) {
            $query = Request::get('query');
            $data = DB::table('products')->where('name', 'like', '%' . $query . '%')->get();
            $output = '<ul class="dropdown-menu" style="display:block;position:relative;min-width:315px;z-index: 1;margin-top:-15px">';
            foreach ($data as $row) {
                $output .= '<li><a class="dropdown-item"  href="products/' . $row->id . '">' . $row->name . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function searching(Request $request)
    {
        $category = Category::all();
        $product = Product::where('name', 'LIKE', '%'.Request::get('search_text').'%')->get();
        $sort = "";
        $categoryname = "";

        // dd($product);

        if (Auth::id()) {
            $user = Auth::user();
            $cartcount = cart::where('user_id', '=', $user->id)->get()->sum('quantity');
        } else {
            $user = 0;
            $cartcount = 0;
        }

        return view('home.allproduct', compact('user', 'product', 'cartcount', 'category', 'sort', 'categoryname'));
    }


}
