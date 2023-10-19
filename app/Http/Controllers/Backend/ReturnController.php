<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function ReturnRequest()
    {
        $orders = Order::where('return_order', 1)->orderBy('id', 'DESC')->get();
        return view('backend.return_order.return_request', compact('orders'));
    }



    public function ReturnRequestApprove($order_id)
    {
        Order::where('id', $order_id)->update(['return_order' => 2]);

        $notification = array(
            'message' => 'Return Order Approve Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }



    public function ReturnAllRequestApprove()
    {
        $orders = Order::where('return_order', 2)->orderBy('id', 'DESC')->get();
        return view('backend.return_order.all_return_request_approve', compact('orders'));
    }


    //////////      /////////////


    public function ReturnRequestCancel($order_id)
    {
        Order::where('id', $order_id)->update(['return_order' => 3]);

        $notification = array(
            'message' => 'Return Order Cancel Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }



    public function ReturnAllRequestCancel()
    {
        $orders = Order::where('return_order', 3)->orderBy('id', 'DESC')->get();
        return view('backend.return_order.all_return_request_cancel', compact('orders'));
    }



}
