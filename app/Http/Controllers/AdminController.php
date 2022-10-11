<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Order_item;
use App\Notifications\SendEmailNotification;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Notification;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function redirect()
    {
        $user = Auth::user();
        $product = Product::all();
        $usertype = Auth::user()->usertype;

        $total_product = product::all()->count();
        $total_order = order::all()->count();
        $total_user = product::all()->count();
        $order = order::all();
        $total_revenue = 0;
        foreach ($order as $order) {
            $total_revenue = $total_revenue + $order->totalprice;
        }
        $total_delivered = order::where('deliverystatus', '=', 'delivered')->get()->count();
        $total_pending = order::where('deliverystatus', '=', 'pending')->get()->count();

        $lowest5product = DB::table('products')
            ->select('*')
            ->orderByRaw('CHAR_LENGTH(product_quantity)')
            ->take(5)
            ->orderBy('product_quantity')
            ->get();

        $bestsellerquantity = DB::table('order_items')
            ->select(DB::raw('sum(quantity) as sum, product_name,priceperpiece'))
            ->groupBy('product_name', 'priceperpiece')
            ->take(5)
            ->orderByDesc('sum')
            ->get();

        $bestsellerrevenue = DB::table('order_items')
            ->select(DB::raw('sum(price) as price, product_name,sum(quantity) as quantity,order_items.priceperpiece'))
            ->groupBy('product_name', 'order_items.priceperpiece')
            ->take(5)
            ->orderByDesc('price')
            ->get();

        // $price_diff = DB::table('products')
        //     ->select(DB::raw('(product_price - buy_price) as price, name'))
        //     ->groupBy('price','name')
        //     ->take(5)
        //     ->orderByDesc('price')
        //     ->get();

        // dd($price_diff);

        // order_items.quantity * (products.product_price - products.buy_price)    
        $bestsellerprofit = Order_item::join('products', 'products.id', '=', 'order_items.product_id')
            ->select(DB::raw('(order_items.quantity * (products.product_price - products.buy_price)) as profit, 
            product_name,quantity,(products.product_price - products.buy_price) as diff_price,order_items.product_id'))
            ->groupBy('order_items.product_name', 'products.product_price', 'products.buy_price', 'order_items.quantity', 'order_items.product_id')
            ->take(5)
            ->orderByDesc('profit')
            ->get();


        // CONVERT(DECIMAL(5,2),((products.product_price - products.buy_price)/products.product_price))  
        $bestsellerprofitmargin = Order_item::join('products', 'products.id', '=', 'order_items.product_id')
            ->select(DB::raw(
                '((products.product_price - products.buy_price)/products.product_price)as margin, 
            order_items.product_name,products.buy_price,products.product_price'
            ))
            ->groupBy('order_items.product_name', 'products.product_price', 'products.buy_price', 'order_items.quantity', 'order_items.product_id')
            ->take(5)
            ->orderByDesc('margin')
            ->get();

        // dd($bestsellerprofit);

        // chart1 bestsellerquantity
        $data = DB::table('order_items')->select(
            DB::raw('product_name as name'),
            DB::raw('sum(quantity) as quantity')
        )->groupBy('name')->get();
        $array[] = ['name', 'quantity'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->name, $value->quantity];
        }
        $chart1 = json_encode($array);

        // chart2 totalquantity
        $data2 = DB::table('products')->select(
            DB::raw('name as name'),
            DB::raw('product_quantity as quantity')
        )->groupBy('name','quantity')->get();
        $array2[] = ['name', 'quantity'];
        foreach ($data2 as $key => $value) {
            $array2[++$key] = [$value->name, $value->quantity];
        }
        $chart2 = json_encode($array2);

        // $chart2 = 0;

        return view('admin.home', compact(
            'total_product',
            'total_order',
            'total_user',
            'total_revenue',
            'total_delivered',
            'total_pending',
            'user',
            'lowest5product',
            'bestsellerquantity',
            'bestsellerrevenue',
            'bestsellerprofit',
            'bestsellerprofitmargin',
            'chart1',
            'chart2'
        ));
    }


    public function view_category()
    {
        $user = Auth::user();
        $data = category::all();
        return view('admin.allcategory', compact('data', 'user'));
    }

    public function add_category(Request $request)
    {
        $data = new category;
        $data->category_name = $request->category_name;
        $data->save();

        return redirect()->back()->with('addmessage', 'Category Added Successfully');
    }

    public function delete_category($id)
    {
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('deletemessage', 'Category Deleted Successfully');
    }

    public function category($id)
    {
        $user = Auth::user();
        $category = category::find($id);
        $product = product::where('category', 'LIKE', "%$category->category_name%")->get();
        return view('admin.category', compact('product', 'category', 'user'));
    }


    public function view_supplier()
    {
        $user = Auth::user();
        $data = supplier::all();
        return view('admin.allsupplier', compact('data', 'user'));
    }

    public function supplier($id)
    {
        $user = Auth::user();
        $data = supplier::find($id);
        // $product = product::find($id);
        $product = product::where('supplier', '=', $data->name)->get();
        return view('admin.supplier', compact('data', 'product', 'user'));
    }

    public function add_supplier(Request $request)
    {
        $data = new supplier;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->save();

        return redirect()->back()->with('addmessage', 'Supplier Added Successfully');
    }

    public function delete_supplier($id)
    {
        $data = supplier::find($id);
        $data->delete();
        return redirect()->back()->with('deletemessage', 'Supplier Deleted Successfully');
    }

    public function allcustomer()
    {
        $user = Auth::user();
        $customer = user::where('usertype','=','0')->get();
        return view('admin.allcustomer', compact('customer','user'));
    }

    public function customer($id)
    {
        $user = Auth::user();
        $customer = user::find($id);
        $order=Order::where('user_id','=',$customer->id)->get();
        return view('admin.customer', compact('customer','user','order'));
    }
}
