<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\TopSidebar;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use PhpParser\Node\Expr\Cast\Array_;

class ProductPageController extends Controller
{
    
    public function ShowProductCategoryPage($mainCategory_id, $mainCategory_name)
    {
        $data['carts'] = Cart::content();
        $data['main_category_one']  = Category::where('id',$mainCategory_id)->first();
        $data['main_category'] = Category::orderByRaw("id = $mainCategory_id DESC")->where('status', 1)->orderBy('serial', 'asc')->get();
        $data['sub_category_one']  = SubCategory::where('category_id',$mainCategory_id)->orderBy('id', 'asc')->get();
        $data['author_all']  = Author::orderBy('id', 'asc')->where('category_id' , $mainCategory_id )->where('status',1)->select('id','author_name_en','author_name_bn')->get();
        
        $data['product']  = Product::where('category_id',$mainCategory_id)->where('status',1)->orderBy('id', 'desc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.ProductPage.category_page')->with($data);
    }
    public function ShowProductAuthorPage($author_id, $author_name)
    {
        $data['carts'] = Cart::content();
       
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        
        // $data['sub_category_one']  = SubCategory::where('category_id',$mainCategory_id)->orderBy('id', 'asc')->get();
        $data['author_all']  = Author::orderBy('id', 'asc')->select('id','author_name_en','author_name_bn')->get();
        $data['author_one']  = Author::where('id',$author_id)->first();
        $data['main_category_one']  = Category::where('id',$data['author_one']->category_id)->first();
        $data['product']  = Product::where('author_id',$author_id)->where('status',1)->orderBy('id', 'desc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.ProductPage.author_product_page')->with($data);
    }
    public function ShowProductSideBarTopMenuPage( $mainCategory_id, $mainCategory_name){
        $data['carts'] = Cart::content();
        $data['main_category_one']  = TopSidebar::where('id',$mainCategory_id)->first();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        $data['product']  = Product::where('sid_sps_section', $mainCategory_name)->where('status',1)->orderBy('id', 'desc')->get();
        $catID= array();
        foreach($data['product'] as $item ){
            array_push($catID , $item->category_id);
        }
        $new_array=array_unique($catID); 
        $data['main_category']  = Category::whereIn('id', $new_array )->where('status', 1)->orderBy('serial', 'asc')->get();
        return view('frontend.ProductPage.sidebar_top_menu_product')->with($data);
    }
    public function GroceryProduct()
    {
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        $data['carts'] = Cart::content();
        // $data['main_category']  = Category::where('id',$mainCategory_id)->first();
        $data['product']  = Product::where('brand_id', 1)->where('status',1)->orderBy('id', 'desc')->get();
        return view('frontend.ProductPage.groceryproduct')->with($data);
    }

   
    public function ShowProductSubCategoryPage($mainCategory_id, $mainCategory_name){
        $data['carts'] = Cart::content();
        $data['sub_category_one']  = SubCategory::where('id',$mainCategory_id)->with('category')->first();
        // $data['main_category']  = Category::orderBy('id', 'asc')->get();
        $data['main_category'] = Category::orderByRaw("id = {$data['sub_category_one']->category_id} DESC")->where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        $data['sub_sub_category_one']  = SubSubCategory::where('subcategory_id',$mainCategory_id)->orderBy('id', 'asc')->get();
        $data['product']  = Product::where('subcategory_id',$mainCategory_id)->where('status',1)->orderBy('id', 'desc')->get();
        return view('frontend.ProductPage.sub_category')->with($data);
    }

    public function ShowProductSubSubCategoryPage($mainCategory_id, $mainCategory_name){
        $data['carts'] = Cart::content();
        $data['sub_sub_category_one']  = SubSubCategory::where('id',$mainCategory_id)->with('category','subcategory')->first();
        // $data['main_category']  = Category::orderBy('id', 'asc')->get();
        $data['main_category'] = Category::orderByRaw("id = {$data['sub_sub_category_one']->category_id} DESC")->where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
     

        $data['product']  = Product::where('subsubcategory_id',$mainCategory_id)->where('status',1)->orderBy('id', 'desc')->get();
        return view('frontend.ProductPage.sub_sub_category')->with($data);
    }

    public function ShowSpecial($product_id){
        $data['carts'] = Cart::content();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        // $data['product']  = Product::orderBy('id', 'desc')->where('special_offer', 1)->where('status',1)->where('product_qty','>','0')->get();
        $data['product'] = Product::orderByRaw("id = ".$product_id." DESC")->orderBy('id', 'desc')
        ->where('special_offer', 1)
        ->where('status', 1)
        ->get();
        return view('frontend.ProductPage.special_category')->with($data);
    }

    public function ShowSpecialDeal($product_id){
        $data['carts'] = Cart::content();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        // $data['product']  = Product::orderBy('id', 'desc')->where('special_deals', 1)->where('status',1)->where('product_qty','>','0')->get();
        $data['product'] = Product::orderByRaw("id = ".$product_id." DESC")->orderBy('id', 'desc')
        ->where('special_deals', 1)
        ->where('status', 1)
        ->get();
        return view('frontend.ProductPage.special_deal')->with($data);
    }

    public function ShowFeatured($product_id){
        $data['carts'] = Cart::content();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        // $data['product']  = Product::orderBy('id', 'desc')->where('featured', 1)->where('status',1)->where('product_qty','>','0')->get();

        $data['product'] = Product::orderByRaw("id = ".$product_id." DESC")->orderBy('id', 'desc')
        ->where('featured', 1)
        ->where('status', 1)
        ->get();

        return view('frontend.ProductPage.featured')->with($data);
    }

    public function ShowHotDeal($product_id){
        $data['carts'] = Cart::content();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        
        // $data['product']  = Product::orderBy('id', 'desc')->where('hot_deals', 1)->where('status',1)->where('product_qty','>','0')->get();

        $data['product'] = Product::orderByRaw("id = ".$product_id." DESC")->orderBy('id', 'desc')
        ->where('hot_deals', 1)
        ->where('status', 1)
        ->get();
        return view('frontend.ProductPage.hot_deal')->with($data);
    }

    public function ShowSpecialPage(){
        $data['carts'] = Cart::content();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        $data['product']  = Product::orderBy('id', 'desc')->where('special_offer', 1)->where('status',1)->orderBy('id', 'desc')->get();

        return view('frontend.ProductPage.special_category')->with($data);
    }

    public function ShowSpecialDealPage(){
        $data['carts'] = Cart::content();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        $data['product']  = Product::orderBy('id', 'desc')->where('special_deals', 1)->where('status',1)->orderBy('id', 'desc')->get();

        return view('frontend.ProductPage.special_deal')->with($data);
    }

    public function ShowFeaturedPage(){
        $data['carts'] = Cart::content();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        $data['product']  = Product::orderBy('id', 'desc')->where('featured', 1)->where('status',1)->orderBy('id', 'desc')->get();

        return view('frontend.ProductPage.featured')->with($data);
    }

    public function ShowHotDealPage(){
        $data['carts'] = Cart::content();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        $data['product']  = Product::orderBy('id', 'desc')->where('hot_deals', 1)->where('status',1)->orderBy('id', 'desc')->get();
        return view('frontend.ProductPage.hot_deal')->with($data);
    }

    public function ShowAllBrandPage(){
        $data['brands'] = Brand::orderBy('id', 'desc')->get();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.ProductPage.brand_page')->with($data);
    }

    public function ShowSingleBrandPage($brand_id){
        $data['carts'] = Cart::content();
        $data['product'] = Product::where('brand_id', $brand_id)->where('status', 1)->orderBy('id', 'desc')->get();
        $data['brand'] = Brand::where('id', $brand_id)->first();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.ProductPage.brand_product')->with($data);
    }
    public function get_product_name()
    {
        $products = Product::latest()->select('product_name_en','product_name_bn')->where('status',1)->orderBy('id', 'desc')->get();
        $array = array();
        if (session()->get('language')=='bangla'){
            foreach($products as $product){
                array_push($array, $product->product_name_bn);
            }
        }else{
            foreach($products as $product){
                array_push($array, $product->product_name_en);
            }
        }
        return $array;		
    }
    public function SearchProduct($product_name){

        $data['carts'] = Cart::content();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        $data['products'] = Product::with(['category','subcategory','subsubcategory','brand'])
        ->orderBy('id', 'desc')
        ->where('product_name_en','LIKE', '%'.$product_name.'%')
        ->orWhere('product_name_bn','LIKE', '%'.$product_name.'%')
        ->where('status',1)
        ->get();
        return view('frontend.ProductPage.search_page')->with($data);
    }
    public function SearchProductData(Request $request){

        $data['carts'] = Cart::content();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        $data['products'] = Product::with(['category','subcategory','subsubcategory','brand'])
        ->orderBy('id', 'desc')
        ->where('product_name_en','LIKE', '%'.$request->searchData.'%')
        ->orWhere('product_name_bn','LIKE', '%'.$request->searchData.'%')
        ->where('status',1)
        ->get();
        return view('frontend.ProductPage.search_page')->with($data);
    }
    //ooo
}
