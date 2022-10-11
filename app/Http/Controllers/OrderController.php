<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Order_item;
use App\Notifications\SendEmailNotification;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Notification;

use Illuminate\Http\Request;

class ordercontroller extends Controller
{
    //
    public function all_order()
    {
        $user=Auth::user();
        $order = Order::all();
        return view('admin.allorder', compact('order','user'));
    }

    public function view_order($id)
    {
        $user=Auth::user();
        $order = order::find($id);
        $orderitem = order_item::where('order_id', '=', $order->id)->get();
        $orderproduct = Order_item::join('products', 'products.id', '=', 'order_items.product_id')
            ->where('order_id', '=', $order->id)
            ->get();
        // dd($orderproduct);
        return view('admin.order', compact('order', 'orderitem', 'orderproduct','user'));
    }

    public function delivered($id)
    {
        $order = order::find($id);
        $order->deliverystatus = "delivered";
        $order->save();
        return redirect()->back();
    }

    public function print_pdf($id)
    {
        $order = order::find($id);
        $orderitem = order_item::where('order_id', '=', $order->id)->get();
        $orderproduct = Order_item::join('products', 'products.id', '=', 'order_items.product_id','user')
            ->where('order_id', '=', $order->id)
            ->get();
        
        // $options =$dompdf->getOptions();

        $pdf = PDF::loadView('admin.pdf', compact('order', 'orderitem', 'orderproduct'))->set_option('isRemoteEnable', True);
        return $pdf->download('order_details.pdf');
    }

    public function pdf($id)
    {
        # code...
        $user=Auth::user();
        $order = order::find($id);
        $orderitem = order_item::where('order_id', '=', $order->id)->get();
        $orderproduct = Order_item::join('products', 'products.id', '=', 'order_items.product_id')
            ->where('order_id', '=', $order->id)
            ->get();
        return view('admin.pdf', compact('order', 'orderitem', 'orderproduct','user'));
    }

    public function send_email($id)
    {
        $user=Auth::user();
        $order = order::find($id);
        return view('admin.email_info', compact('order','user'));
    }

    public function send_user_email(Request $request, $id)
    {
        $order = Order::find($id);

        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline,
        ];

        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back();
    }

}
