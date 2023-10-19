<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Mail\OrderMail;
// use Barryvdh\DomPDF\PDF;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Pending Orders
    public function PendingOrders()
    {
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('backend.orders.pending_orders', compact('orders'));
    }



    public function PendingOrdersEdit($order_id)
    {
        $order_items = OrderItem::where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('backend.orders.pending_orders_edit', compact('order_items'));
    }


    

    //////////////     Pending orders page a (model(OrderItem)QTY Edit Update , model(Order)Discount Amount Update)   //////////////////
    
    public function PendingOrdersUpdate(Request $request, $order_id)
    {
        $order_items = OrderItem::findOrFail($order_id);
        $order_items->qty = $request->qty;
        $order_items->update();

        
        $order = Order::where('id', $order_items->order_id)->first();
        $discount = $order->coupon_discount != null ? $order->coupon_discount : 0;
        $order_items_all =  OrderItem::where('order_id', $order_items->order_id)->get();
        $amount = 0;
        foreach($order_items_all as $item){        
            $amount =  $amount + $item->qty * $item->price;
        }   
       $damount = round($amount - $amount * $discount / 100);
       $order->amount = $damount;
       $order->update();
   
        if ($order_items) {
            $notification = array(
                'message' => 'Quantity And Order Amount Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Quantity Updated Failed');
        }
    }




    public function PendingOrdersStatusUpdate(Request $request, $order_id)
    {
       $order_status = Order::findOrFail($order_id);

       $order_status->status = $request->input('status');
       $order_status->update();

        $notification = array(
            'message' => 'Order Status Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }




    // Pending Orders Details
    public function PendingOrdersDetails($order_id)
    {
        $order = Order::with('division', 'district', 'upazila', 'user')->where('id', $order_id)
        // ->where('user_id', Auth::id())
        ->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // dd(Auth::id());
        return view('backend.orders.pending_orders_details', compact('order', 'orderItem'));
    }



    // Confirmed Orders
    public function ConfirmedOrders()
    {
        $orders = Order::where('status', 'confirm')->orderBy('id', 'asc')->get();
       
        return view('backend.orders.confirmed_orders', compact('orders'));
    }



    // Processing Orders
    public function ProcessingOrders()
    {
        $orders = Order::where('status', 'processing')->orderBy('id', 'asc')->get();
        return view('backend.orders.processing_orders', compact('orders'));
    }



    // Picked Orders
    public function PickedOrders()
    {
        $orders = Order::where('status', 'picked')->orderBy('id', 'asc')->get();
        return view('backend.orders.picked_orders', compact('orders'));
    }



    // Shipped Orders
    public function ShippedOrders()
    {
        $orders = Order::where('status', 'shipped')->orderBy('id', 'asc')->get();
        return view('backend.orders.shipped_orders', compact('orders'));
    }



    // Delivered Orders
    public function DeliveredOrders()
    {
        $orders = Order::where('status', 'delivered')->orderBy('id', 'asc')->get();
        return view('backend.orders.delivered_orders', compact('orders'));
    }



    // Cancel Orders
    public function CancelOrders()
    {
        $orders = Order::where('status', 'cancel')->orderBy('id', 'asc')->get();
        return view('backend.orders.cancel_orders', compact('orders'));
    }




//////////////////       //////////////////




    public function PendingToConfirm($order_id)
    {

        $product = OrderItem::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)->update(['product_qty' => DB::raw('product_qty-' . $item->qty)]);
        }

        Order::findOrFail($order_id)->update(['status' => 'confirm']);

        $notification = array(
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('confirmed-orders')->with($notification);
    }



    public function ConfirmToProcessing($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'processing']);

        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('processing-orders')->with($notification);
    }



    public function ProcessingToPicked($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'picked']);

        $notification = array(
            'message' => 'Order Picked Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('picked-orders')->with($notification);
    }



    public function PickedToShipped($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'shipped']);

        $notification = array(
            'message' => 'Order Shipped Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('shipped-orders')->with($notification);
    }


    public function ShippedToDelivered($order_id)
    {

        // $product = OrderItem::where('order_id', $order_id)->get();
        // foreach ($product as $item) {
        //     Product::where('id', $item->product_id)->update(['product_qty' => DB::raw('product_qty-' . $item->qty)]);
        // }


        Order::findOrFail($order_id)->update(['status' => 'delivered']);

        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('delivered-orders')->with($notification);
    }



    public function OrdersCancelAdmin($order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'cancel',
        ]);

        $notification = array(
            'message' => 'Order Cancel Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }





    public function AdminInvoiceDownload($order_id)
    {
        $order = Order::with('division', 'district', 'upazila', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $site_setting = SiteSetting::first();
        
        $pdf = PDF::loadView('backend.orders.order_invoice', compact('order', 'orderItem', 'site_setting'));
        // return $pdf->stream('invoice.pdf');
        return $pdf->download('invoice.pdf');
    }

}