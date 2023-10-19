<?php

namespace App\Http\Controllers\User;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    public function MyCart(){
        $data['main_category']  = Category::orderBy('id', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
    	return view('frontend.wishlist.view_mycart')->with($data);

    }


    public function GetCartProduct(){
       
        $carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => round($cartTotal),
            
    	));

    } //end method 



    public function RemoveCartProduct($rowId){
        Cart::remove($rowId);

        if (Session::has('coupon')) {
           Session::forget('coupon');
        }

        return response()->json(['success' => 'Successfully Remove From Cart']);
    }


 // Cart Increment 
    public function CartIncrement($rowId){
        $row = Cart::get($rowId);

        $product = Product::findOrFail($row->id);

        if($row->qty < $product->product_qty){

        Cart::update($rowId, $row->qty + 1);

        }
        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round( Cart::total() * $coupon->coupon_discount / 100 ), 
                'total_amount' => round( Cart::total() - Cart::total() * $coupon->coupon_discount / 100 )  
            ]);
        }
 
        return response()->json(array(
    		'carts' => $row, 
    	));


    } // end mehtod 


   // Cart Decrement  
    public function CartDecrement($rowId){
       
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if (Session::has('coupon')) {

            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round( Cart::total() * $coupon->coupon_discount / 100 ), 
                'total_amount' => round( Cart::total() - Cart::total() * $coupon->coupon_discount / 100 )  
            ]);
        }

        return response()->json(array(
    		'carts' => $row, 
    	));


    }// end mehtod 
}
