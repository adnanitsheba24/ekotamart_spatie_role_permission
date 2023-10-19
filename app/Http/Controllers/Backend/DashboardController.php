<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function AdminDashboard()
    {
        $data['brands'] = Brand::get();
        $data['category'] = Category::get();
        $data['sub_category'] = SubCategory::get();
        $data['sub_sub_category'] = SubSubCategory::get();
        $data['product'] = Product::get();
        $data['slider'] = Slider::get();
        $data['coupon'] = Coupon::get();
        $data['return_order'] = Order::where('return_order', 1)->get();
        $data['pending_order'] = Order::where('status', 'pending')->get();
        $data['confirmed_order'] = Order::where('status', 'confirm')->get();
        $data['processing_order'] = Order::where('status', 'processing')->get();
        $data['picked_order'] = Order::where('status', 'picked')->get();
        $data['shipped_order'] = Order::where('status', 'shipped')->get();
        $data['delivered_order'] = Order::where('status', 'delivered')->get();
        $data['cancel_order'] = Order::where('status', 'cancel')->get();
        $data['user'] = User::get();

        $date = Carbon::now()->format('d F Y');
        $today = Order::where('order_date', $date)->sum('amount');

        $month = date('F');
        $month = Order::where('order_month', $month)->sum('amount');
        
        $year = date('Y');
        $year = Order::where('order_year', $year)->sum('amount');

        return view('admin.index', compact('today', 'month', 'year'))->with($data);
    }




    // Dashboard Orders Pending Search Start Method
    public function PendingSearch(Request $request)
    {
       if ($request->ajax()) {

            $output = '';

            $orders = Order::where('name', 'LIKE', '%'.$request->search.'%')
                ->orWhere('order_date', 'LIKE', '%'.$request->search.'%')
                ->orWhere('invoice_no', 'LIKE', '%'.$request->search.'%')
                ->orWhere('amount', 'LIKE', '%'.$request->search.'%')
                ->orWhere('payment_method', 'LIKE', '%'.$request->search.'%')
                ->get();

             
            if ($orders) {
                foreach ($orders as $item) {
                    $output .= 
                        '<tr>
                            <td>'.$item->name.'</td>
                            <td>'.$item->order_date.'</td>
                            <td>'.$item->invoice_no.'</td>
                            <td>'.$item->amount.' Taka</td>
                            <td>'.$item->payment_method.'</td>
                            <td>'.$item->status.'</td>
                            <td width="20%">
                                <a href="'.route('pending.order.details',$item->id).'" class="btn btn-info btn-sm" title="View Data"><i class="fa fa-eye"></i></a> 
                            </td>
                        </tr>';
                }
                return response()->json($output);
            }
            return view('backend.orders.search_pending_orders');
        }   
    }

   public function PendingSearch_Value($search_value)
   {
        $orders = Order::where('name', 'LIKE', '%'.$search_value.'%')
                ->orWhere('order_date', 'LIKE', '%'.$search_value.'%')
                ->orWhere('invoice_no', 'LIKE', '%'.$search_value.'%')
                ->orWhere('amount', 'LIKE', '%'.$search_value.'%')
                ->orWhere('payment_method', 'LIKE', '%'.$search_value.'%')
                ->get();

        return view('backend.orders.search_pending_orders', compact('orders'));
   }
    // Dashboard Orders Pending Search End Method


}














// <div class="box">
// <div class="box-header with-border">
//     <h3 class="box-title">Search Pending Orders</h3>
// </div>
// <!-- /.box-header -->
// <div class="box-body head-text">
//     <div class="table-responsive">
//         <table id="example1" class="table table-bordered table-striped">
//             <thead class="head-text">
//                 <tr>
//                     <th>Date</th>
//                     <th>Invoice</th>
//                     <th>Amount</th>
//                     <th>Payment</th>
//                     <th>Status</th>
//                     <th>Action</th>
//                 </tr>
//             </thead>
//             <tbody class="head-text">
//                 @foreach ($search_order as $item)
//                     <tr>
//                         <td>{{ $item->order_date }}</td>
//                         <td>{{ $item->invoice_no }}</td>
//                         <td>${{ $item->amount }}</td>

//                         <td>{{ $item->payment_method }}</td>
//                         <td> <span class="badge badge-pill badge-primary">{{ $item->status }}</span>
//                         </td>

//                         <td width="20%">
//                             <a href="#" class="btn btn-info btn-sm" title="View Data"><i
//                                     class="fa fa-eye"></i></a>
//                             {{-- <a href="{{ route('pending.order.details',$item->id) }}" class="btn btn-info btn-sm" title="View Data"><i class="fa fa-eye"></i></a> --}}
//                             {{-- <a href="{{ route('coupon.delete',$item->id) }}" class="btn btn-danger btn-sm delete_data" title="Delete Data"><i class="fa fa-trash"></i></a> --}}
//                         </td>
//                     </tr>
//                 @endforeach
//             </tbody>
//         </table>
//     </div>
// </div>
// <!-- /.box-body -->
// </div>