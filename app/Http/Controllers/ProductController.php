<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Order_item;
use App\Notifications\SendEmailNotification;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Notification;
// use DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// use Datatables;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    //
    public function all_product()
    {
        $user = Auth::user();
        $product = product::all();
        return view('admin.allproduct', compact('product', 'user'));
    }

    public function add_product()
    {
        $user = Auth::user();
        $category = category::all();
        $supplier = supplier::all();
        return view('admin.addproduct', compact('category', 'supplier', 'user'));
    }

    public function upload_product(Request $request)
    {
        $product = new product;
        $product->name = $request->name;
        $product->product_price = $request->price;
        $product->buy_price = $request->buy_price;
        $product->description = $request->description;
        $product->product_quantity = $request->quantity;
        $product->supplier = $request->supplier;
        $product->discount_price = $request->discount_price;
        $product->supplier = $request->supplier;

        $input = $request->all();
        $category = $input['category'];
        $product->category = implode(', ', $category);

        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename;

        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function view_product($id)
    {
        $user = Auth::user();
        $product = product::find($id);
        return view('admin.product', compact('product', 'user'));
    }

    public function update_product($id)
    {
        $user = Auth::user();
        $category = category::all();
        $supplier = supplier::all();
        $product = product::find($id);
        $product_category = (explode(",", $product->category));
        // dd($product_category);
        return view('admin.update_product', compact('product', 'category', 'supplier', 'product_category', 'user'));
    }

    public function update_product_confirm(Request $request, $id)
    {
        $category = category::all();
        $product = product::find($id);

        $product->name = $request->name;
        $product->product_price = $request->price;
        $product->buy_price = $request->buy_price;
        $product->description = $request->description;
        $product->product_quantity = $request->quantity;
        $product->supplier = $request->supplier;
        $product->discount_price = $request->discount_price;
        // $product->category = $request->category;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }

        $input = $request->all();
        $category = $input['category'];
        $product->category = implode(', ', $category);

        $product->save();

        return redirect()->back()->with('message', 'Product Update Successfully');
    }

    function search(Request $request)
    {
        // $user = Auth::user();
        if ($request->ajax()) {
            $output = '';
            $result = $request->get('query');
            if ($result != '') {
                $data = DB::table('products')
                    ->where('name', 'like', '%' . $result . '%')->get();
                    // ->orwhere('category', 'like', '%' . $result . '%')
                    // ->orWhere('supplier', 'like', '%' . $result . '%')
            } else {
                $data = DB::table('products')->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '<tr>
                       <td>' . $row->id . '</td>
                       <td>' . $row->name . '</td>
                       <td>' . $row->supplier . '</td>
                       <td>' . $row->category . '</td>
                       <td>' . $row->buy_price . '</td>
                       <td>' . $row->product_price . '</td>
                       <td>' . $row->product_quantity . '</td>
                       <td><img src="/product/' . $row->image. '"></td>
                       <td><a class="btn btn-primary me-2" style="padding: 0.5rem"
                       href="all_product/'.$row->id.'"> view </a></td>
                        </tr>';
                }
            } else {
                $output = "<tr><td align='center' colspan='7'>Not Found</td></tr>";
            }
            $data = array('table_data' => $output, 'total_data' => $total_row);
            echo json_encode($data);
        }
    }

    public function all_product_table()
    {
        # code...
        return Datatables::of(Product::query())->make(true);
    }
}
