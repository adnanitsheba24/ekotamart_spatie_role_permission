<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\ShipUpazila;
use App\Models\SubCategory;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\StockRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

// use Gloudemans\Shoppingcart\Cart;


class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);

        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);
        } else {

            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }
    } // end mehtod

    public function ProductRequestStock(Request $request){
        $user_id = null;
        if (Auth::check()) {
            $user_id = Auth::guard()->user()->id;
        }
        
        StockRequest::insert([            
            'product_id' => $request->id,
            'user_id' => $user_id,
            'user_ip' =>$request->userIP,
            'date' => now(),
        ]);
        return response()->json(
            array(
                'success' => 'Successfully Added Your request',
            )
        );
    }
    public function ProductDirectAdd(Request $request)
    {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $product = Product::findOrFail($request->id);
        if ($product->product_qty > 0) {
            if ($product->discount_price == NULL) {
                Cart::add([
                    'id' => $request->id,
                    'name' => $product->product_name_en,
                    'qty' => 1,
                    'price' => $product->selling_price,
                    'weight' => 1,
                    'options' => [
                        'image' => $product->product_thambnail,
                        'color' => "red",
                        'size' => "small",
                    ],
                ]);

                return response()->json(
                    array(
                        'success' => 'Successfully Added on Your Cart',
                        'carts' => $carts,
                        'cartQty' => $cartQty,
                        'cartTotal' => round($cartTotal),
                    )
                );
            } else {

                Cart::add([
                    'id' => $request->id,
                    'name' => $product->product_name_en,
                    'qty' => 1,
                    'price' => $product->discount_price,
                    'weight' => 1,
                    'options' => [
                        'image' => $product->product_thambnail,
                        'color' => "red",
                        'size' => "small",
                    ],
                ]);
                return response()->json(array(
                    'success' => 'Successfully Added on Your Cart',
                    'carts' => $carts,
                    'cartQty' => $cartQty,
                    'cartTotal' => round($cartTotal),
                ));
            }
        } else {
            return response()->json(array(
                'success' => 'Failed to Add this Cart',
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => round($cartTotal),
            ));
        }
    }



    // Mini Cart Section
    public function AddMiniCart()
    {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        if (Session::has('coupon')) {
            return response()->json(array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => session()->get('coupon')['total_amount'],

            ));
        } else {
            return response()->json(array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => round($cartTotal),
            ));
        }
    } // end method 




    /// remove mini cart 
    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove from Cart']);
    } // end mehtod 


    // add to wishlist mehtod 

    public function AddToWishlist(Request $request, $product_id)
    {

        if (Auth::check()) {

            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json([
                    'success' => 'Successfully Added On Your Wishlist',
                ]);
            } else {

                return response()->json(['error' => 'This Product has Already on Your Wishlist']);
            }
        } else {

            return response()->json(['error' => 'At First Login Your Account']);
        }
    } // end method 

    public function CouponApply(Request $request)
    {

        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    } // end method 



    public function CouponCalculation()
    {

        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    } // end method 



    // Remove Coupon 
    public function CouponRemove()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }




    // Checkout Method 
    public function CheckoutCreate()
    {

        if (Auth::check()) {
            if (Cart::total() > 0) {

                $data['carts'] = Cart::content();
                $data['cartQty'] = Cart::count();
                $data['cartTotal'] = Cart::total();
                $data['divisions'] = ShipDivision::orderBy('division_name', 'ASC')->get();
                $data['districts'] = ShipDistrict::orderBy('district_name', 'ASC')->get();
                $data['upazilas'] = ShipUpazila::orderBy('upazila_name', 'ASC')->get();
                $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
                $sub_category  = SubCategory::orderBy('id', 'asc')->get();
                foreach ($data['main_category'] as $item) {
                    $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
                }
                foreach ($sub_category as $item) {
                    $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id', $item->id)->get();
                }

                $id = Auth::guard()->user()->id;
                $data['user_data'] = DB::table('orders')->where('user_id', $id)->latest()->first();

                // dd($data);
                return view('frontend.checkout.checkout_view')->with($data);
            } else {

                $notification = array(
                    'message' => 'Shopping At list One Product',
                    'alert-type' => 'error'
                );
                return redirect()->to('/')->with($notification);
                // dd('message ok');

            }
        } else {

            $notification = array(
                'message' => 'You Need to Login First',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }
    } // end method 
}
