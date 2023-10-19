<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function ViewWishlist(){
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
		return view('frontend.wishlist.view_wishlist')->with($data);
    
	}

	public function GetWishlistProduct(){
		$wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
		return response()->json($wishlist);
	} // end mehtod 


	public function RemoveWishlistProduct($id){

		Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
		return response()->json(['success' => 'Successfully Product Remove']);
	}

}
