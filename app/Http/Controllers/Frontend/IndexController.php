<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\CategorySlider;
use App\Models\MultiImg;
use App\Models\TopSidebarMenuSlider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{

    public function Developer()
    {
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.developer_info.developer_info')->with($data);
    }

    public function index()
    {
        $data['carts'] = Cart::content();
        $data['hot_deal'] = Product::orderBy('id', 'desc')->where('hot_deals', 1)->where('status', 1)->take(20)->get();
        $data['featured'] = Product::orderBy('id', 'desc')->where('featured', 1)->where('status', 1)->take(20)->get();
        $data['special_offer'] = Product::orderBy('id', 'desc')->where('special_offer', 1)->where('status', 1)->take(22)->get();
        $data['special_deals'] = Product::orderBy('id', 'desc')->where('special_deals', 1)->where('status', 1)->take(20)->get();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        $category = Category::where('status', 1)->orderBy('serial', 'asc')->select('id')->get();

        if (isset($category)) {
            foreach ($category as $key => $value) {
                $category_wise_product[$key] = Product::orderBy('id', 'desc')->with('category')->where('category_id', $value->id)->where('status', 1)->take(20)->get();
            }
        }

        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }

        $data['category_wise_product'] =  isset($category_wise_product) ? $category_wise_product : " ";

        return view('frontend.index')->with($data);
        // return view('Frontend.text');
    }

    public function Bangla(){
        session()->get('language');
        session()->forget('language');
        Session::put('language','bangla');
        return redirect()->back();
    }
    public function English(){
        session()->get('language');
        session()->forget('language');
        Session::put('language','english');
        return redirect()->back();
    }
    public function ProductDetail($id){
        $product = Product::findOrFail($id);
        return view('frontend.product.product_details',compact('product'));
    }
    /// Product View With Ajax
	public function ProductViewAjax($id){
        $carts = Cart::content();
        $multiImg= MultiImg::where('product_id', $id )->get();
        $product = Product::with('category','brand')->findOrFail($id);
		$color = $product->product_color_en;
		$product_color = explode(',', $color);
		$size = $product->product_size_en;
		$product_size = explode(',', $size);
        $language =  session()->get('language');
        $singleCart='';
        foreach($carts as $cart){
            if($cart->id == $id){
                $singleCart=$cart;
            }
        }
        $author = Author::where('id',$product->author_id)->first();

		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,
			'carts' => $singleCart,
			'multiImg' => $multiImg,
			'language' => $language,
            'author'=>$author,
		));
	} // end method 

    public function ProductDirectAdd($id){
        $product = Product::with('category','brand')->findOrFail($id);
		$color = $product->product_color_en;
		$product_color = explode(',', $color);
		$size = $product->product_size_en;
		$product_size = explode(',', $size);
        
		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,
		));
	}

    public function ShowSlider(){
        $slider= Slider::orderBy('id', 'desc')->where('category', '!=' , null)->where('status',1)->get();
        return response()->json(array(
            'sliders' => $slider,
        ));
    }
    public function ShowCategorySlider($main_category){
        $slider= Slider::orderBy('id', 'desc')->where('category_id',$main_category)->where('status',1)->get();
        return response()->json(array(
            'sliders' => $slider,
        ));
    }
    public function ShowSubCategorySlider($main_category){
        $slider= Slider::orderBy('id', 'desc')->where('subcategory_id',$main_category)->get();
        return response()->json(array(
            'sliders' => $slider,
        ));
    }
    public function ShowSubSubCategorySlider($main_category){
        $slider= Slider::orderBy('id', 'desc')->where('subsubcategory_id',$main_category)->get();
        return response()->json(array(
            'sliders' => $slider,
        ));
    }
    public function ShowTop_sidebar_menu_sliderSlider($main_category){
        $slider= Slider::orderBy('id', 'desc')->where('top_sidebar_id',$main_category)->where('status',1)->get();
        return response()->json(array(
            'sliders' => $slider,
        ));
    }
    public function SecurityPolicy()
    {
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.termscondition.security_policy')->with($data);;
    }
    public function ShippingReplacement()
    {
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.termscondition.shipping_replacement')->with($data);;
    }
    public function PrivacyPolicy()
    {
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.termscondition.privacy_policy')->with($data);;
    }
    public function TermsUse()
    {
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.termscondition.terms_use')->with($data);;
    }
    public function AboutUs()
    {
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.termscondition.aboutus')->with($data);;
    }
    public function ContactUs()
    {
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.termscondition.contactus')->with($data);;
    }
    public function HowToBuy()
    {
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.termscondition.how_to_buy')->with($data);;
    }
    public function  SidebarAjax(){
        $main_category  = Category::orderBy('id', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        $sub_sub_category  = SubSubCategory::orderBy('id', 'asc')->get();

        return response()->json(
            array(
                'success' => 'Successfully Added on Your Cart',
                'main_category' => $main_category,
                'sub_category' => $sub_category,
                'sub_sub_category' => $sub_sub_category,
            )
        );
    }
}
