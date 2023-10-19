<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CashController extends Controller
{
    public function CashOrder(Request $request)
    {

        // Cuppon default null
        $coupon_discount = null;
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
            $coupon_discount = Session::get('coupon')['coupon_discount'];
        } else {
            $total_amount = round(Cart::total());
        }


        // User number email check validate Start
        $user_info = User::where('id', Auth::user()->id)->first();

        if ($user_info->phone == null) {
            $user_number_validate = User::where('phone', $request->phone)->first();
            if ($user_number_validate == null) {
                $user_data = User::find(Auth::user()->id);
                $user_data->name = $request->name;
                $user_data->phone = $request->phone;
                $user_data->date_of_birth = $request->date_of_birth;
                $user_data->update();
            } else {
                $notification = array(
                    'message' => 'Phone Already Exists',
                    'alert-type' => 'warning'
                );
                return redirect()->to('/checkout')->with($notification);
            }
        } else if ($user_info->phone != $request->phone) {
            $user_number_validate = User::where('phone', $request->phone)->first();
            if ($user_number_validate == null) {
                $user_data = User::find(Auth::user()->id);
                $user_data->name = $request->name;
                $user_data->phone = $request->phone;
                $user_data->date_of_birth = $request->date_of_birth;
                $user_data->update();
            } else {
                $notification = array(
                    'message' => 'Phone Already Exists',
                    'alert-type' => 'warning'
                );
                return redirect()->to('/checkout')->with($notification);
            }
        }
        if ($user_info->email == null) {
            $user_email_validate = User::where('email', $request->email)->first();
            if ($user_email_validate == null) {
                $user_data = User::find(Auth::user()->id);
                $user_data->name = $request->name;
                $user_data->email = $request->email;
                $user_data->date_of_birth = $request->date_of_birth;
                $user_data->update();
            } else {
                $notification = array(
                    'message' => 'Email Already Exists',
                    'alert-type' => 'warning'
                );
                return redirect()->to('/checkout')->with($notification);
            }
        } else if ($user_info->email != $request->email) {
            $user_email_validate = User::where('email', $request->email)->first();
            if ($user_email_validate == null) {
                $user_data = User::find(Auth::user()->id);
                $user_data->name = $request->name;
                $user_data->email = $request->email;
                $user_data->date_of_birth = $request->date_of_birth;
                $user_data->update();
            } else {
                $notification = array(
                    'message' => 'Email Already Exists',
                    'alert-type' => 'warning'
                );
                return redirect()->to('/checkout')->with($notification);
            }
        }
        // User number email check validate End

        
        // dd($request);
        $user_number_validate = User::where('phone', $request->phone)->first();
        $auth_user_phone = User::where('id', Auth::user()->id)->where('phone', '!=', $request->phone)->first();

        $user_email_validate = User::where('email', $request->email)->first();
        $auth_user_email = User::where('id', Auth::user()->id)->where('email', '!=', $request->email)->first();


        if ($user_email_validate && $auth_user_email) {
            $notification = array(
                'message' => 'Email Already Exists',
                'alert-type' => 'warning'
            );
            return redirect()->to('/checkout')->with($notification);
        } else {

            if ($user_number_validate && $auth_user_phone) {
                $notification = array(
                    'message' => 'Phone Already Exists',
                    'alert-type' => 'warning'
                );
                return redirect()->to('/checkout')->with($notification);
            } else {

                $order_id = Order::insertGetId([
                    'user_id' => Auth::id(),
                    'division_id' => $request->division_id,
                    'district_id' => $request->district_id,
                    'upazila_id' => $request->upazila_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'address' => $request->address,


                    'payment_type' => 'Cash On Delivery',
                    'payment_method' => 'Cash On Delivery',

                    'currency' => 'Taka',
                    'amount' => $total_amount,
                    'coupon_discount' => $coupon_discount,

                    // 'invoice_no' => 'FMDS'.mt_rand(10000000,99999999),
                    'invoice_no' => 'EM' . Carbon::now(),
                    'order_date' => Carbon::now()->format('d F Y'),
                    'order_month' => Carbon::now()->format('F'),
                    'order_year' => Carbon::now()->format('Y'),
                    'status' => 'pending',
                    'created_at' => Carbon::now(),

                ]);

                if (Auth::user()->id) {
                    $order_invoice_update = Order::find($order_id);
                    $order_invoice_update->invoice_no = 'EM' . array_sum([10000, $order_id]);
                    $order_invoice_update->update();
                }
            }
        }


        // if (Auth::user()->id) {
        //     $user_data = User::find(Auth::id());
        //     $user_data->name = $request->name;
        //     $user_data->email = $request->email;
        //     $user_data->phone = $request->phone;
        //     $user_data->date_of_birth = $request->date_of_birth;
        //     $user_data->update();
        // }


        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $order = Order::with('division', 'district', 'upazila', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $site_setting = SiteSetting::first();
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
            'payment_type' => 'Cash On Delivery',
            'order_id_one'=>$order_id,
        ];

        $pdf = PDF::loadView('mail.order_mail', compact('data','order','orderItem','site_setting'));
        $data['pdf'] = $pdf;


        Mail::to($request->email)->send(new OrderMail($data));
        // Start Send Email


        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );
        return redirect()->to('/')->with($notification);
    }
}
