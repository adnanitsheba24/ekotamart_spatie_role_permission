<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\SiteSetting;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AllUserController extends Controller
{
    public function MyOrders()
    {
       $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
       $data['main_category']  = Category::orderBy('id', 'asc')->get();
       $sub_category  = SubCategory::orderBy('id', 'asc')->get();
       foreach($data['main_category'] as $item){
           $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
       }
       foreach($sub_category as $item){
           $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
       }
       return view('frontend.user.order.order_view', compact('orders'))->with($data);
    }


    public function OrderDetails($order_id)
    {
        $order = Order::with('division', 'district', 'upazila', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $data['main_category']  = Category::orderBy('id', 'asc')->get();
       $sub_category  = SubCategory::orderBy('id', 'asc')->get();
       foreach($data['main_category'] as $item){
           $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
       }
       foreach($sub_category as $item){
           $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
       }
        return view('frontend.user.order.order_details', compact('order', 'orderItem'))->with($data);
    }


    public function InvoiceDownload($order_id)
    {
        $order = Order::with('division', 'district', 'upazila', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $site_setting = SiteSetting::first();
        // return view('frontend.user.order.order_invoice', compact('order', 'orderItem'));

        $pdf = Pdf::loadView('frontend.user.order.order_invoice', compact('order', 'orderItem', 'site_setting'));
        // dd('ok');
        return $pdf->download('invoice.pdf');

    }



    public function ReturnOrder(Request $request, $order_id)
    {
        $data['main_category']  = Category::orderBy('id', 'asc')->get();
        $data['sub_category']  = SubCategory::orderBy('id', 'asc')->get();
        $data['sub_sub_category']  = SubSubCategory::orderBy('id', 'asc')->get();
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);
    }



    public function ReturnOrderList()
    {
        $data['main_category']  = Category::orderBy('id', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        $orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', NULL)->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.return_order_view', compact('orders'))->with($data);
    }


    public function CancelOrders()
    {
        $data['main_category']  = Category::orderBy('id', 'asc')->get();
        $data['sub_category']  = SubCategory::orderBy('id', 'asc')->get();
        $data['sub_sub_category']  = SubSubCategory::orderBy('id', 'asc')->get();
        $orders = Order::where('user_id', Auth::id())->where('status', 'cancel')->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.cancel_order_view', compact('orders'))->with($data);
    }



    public function OrdersCancel($order_id)
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

}
