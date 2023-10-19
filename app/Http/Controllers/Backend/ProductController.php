<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book_type;
use App\Models\MultiImg;
use App\Models\ProductUnit;
use App\Models\Publication;
use App\Models\StockRequest;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\TopSidebar;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Symfony\Contracts\Service\Attribute\Required;

class ProductController extends Controller
{

    public function DetailsViewProduct($id)
    {
        $details_view_product = Product::with('category', 'brand', 'subcategory', 'subsubcategory', 'author', 'book_type', 'publication', 'product_units')->find($id);
        // dd($details_view_product);
        $multiImgs = MultiImg::where('product_id', $id)->get();
        return view('backend.product.product_details_view', compact('details_view_product', 'multiImgs'));
    }


    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $top_sidebar = TopSidebar::where('status', 1)->get();
        $authors = Author::where('status', 1)->get();
        $book_types = Book_type::where('status', 1)->get();
        $publications = Publication::where('status', 1)->get();
        $product_units = ProductUnit::where('status', 1)->get();
        return view('backend.product.product_add', compact('categories', 'brands', 'top_sidebar', 'authors', 'book_types', 'publications', 'product_units'));
    }


    public function StoreProduct(Request $request)
    {
        // dd($request);
        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'product_name_en' => 'required',
            'product_name_bn' => 'required',
            'product_qty' => 'required',
            'selling_price' => 'required|max:10',
            'short_descp_en' => 'required|max:255',
            'short_descp_bn' => 'required|max:255',
            'long_descp_en' => 'required',
            'long_descp_bn' => 'required',
            'product_thambnail' => 'image|mimes:jpeg,png,gif,webp|max:1024|required',
            // 'multi_img' => 'image|mimes:jpeg,png,gif,webp|max:1024|required',
        ]);

        $filename = null;
        if (isset($request->product_thambnail)) {
            $product_thambnail = $request->file('product_thambnail');
            $filename = time().'.'.$request->file('product_thambnail')->getClientOriginalExtension();
            // .'.'.$request->file('product_thambnail')->getClientOriginalExtension();
            Storage::putFileAs('public/products/thambnail', $request->file('product_thambnail'), $filename);
            // $destinationPath = public_path('product_thambnail_vision');
            $destinationPath =  storage_path('app/public/products/thambnail');
            // exit;
            // $manager = new Image(['driver' => 'imagick']);
            $img = Image::make($product_thambnail->path());
            $img->resize(917, 1000, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
        }
        // $news->product_thambnail = $filename;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'author_id' => $request->author_id,
            'book_type_id' => $request->book_type_id,
            'publication_id' => $request->publication_id,
            'product_units_id' => $request->product_units_id,
            'product_name_en' => $request->product_name_en,
            'product_name_bn' => $request->product_name_bn,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_bn' => str_replace(' ', '-', $request->product_name_bn),
            // 'product_code' => $request->product_code,
            // 'product_code' => random_int(100000, 999999),
            'product_code' => Carbon::now(),
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_bn' => $request->product_tags_bn,
            'product_size_en' => $request->product_size_en,
            'product_size_bn' => $request->product_size_bn,
            'product_color_en' => $request->product_color_en,
            'product_color_bn' => $request->product_color_bn,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'expired_date' => $request->expired_date,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_bn' => $request->short_descp_bn,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_bn' => $request->long_descp_bn,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'sid_sps_section' => strtolower($request->sid_sps_section),

            'product_thambnail' => $filename,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        if (Product::find($product_id)) {
            $product_code_update = Product::find($product_id);
            $product_code_update->product_code = 'EM'.array_sum([100, $product_id]);
            $product_code_update->update();
        }

        // dd($request);

        ////////////  Multiple Image Upload Start  ////////////
        $images = $request->file('multi_img');
       
        foreach ($images as $img) {
            $filename = time().'.'.$img->getClientOriginalName();
            // .'.'.$request->file('product_thambnail')->getClientOriginalExtension();
            Storage::putFileAs('public/products/multi-image', $img, $filename);
            // $destinationPath = public_path('product_thambnail_vision');
            $destinationPath =  storage_path('app/public/products/multi-image');
            // exit;
            // $manager = new Image(['driver' => 'imagick']);
            $img = Image::make($img->path());
            $img->resize(917, 1000, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);


            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $filename,
                'created_at' => Carbon::now(),
            ]);

        }
        ////////////  Multiple Image Upload End  ////////////

        $notification = array(
            'message' => 'Product Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }



    public function ManageProduct()
    {
        $products = Product::with('product_units')->latest()->orderBy('id', 'DESC')->get();
        return view('backend.product.product_view', compact('products'));
    }



    public function EditProduct($id)
    {

        $products = Product::findOrFail($id);

        $multiImgs = MultiImg::where('product_id', $id)->get();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        $top_sidebar = TopSidebar::where('status', 1)->get();
        $authors = Author::where('status', 1)->get();
        $book_types = Book_type::where('status', 1)->get();
        $publications = Publication::where('status', 1)->get();
        $product_units = ProductUnit::where('status', 1)->get();

        return view('backend.product.product_edit', compact('products', 'categories', 'brands', 'subcategory', 'subsubcategory', 'multiImgs', 
        'top_sidebar', 'authors', 'book_types', 'publications', 'product_units'));

    }


    public function ProductDataUpdate(Request $request, $id)
    {

        $product = Product::find($id);

        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->subsubcategory_id = $request->subsubcategory_id;
        $product->author_id = $request->author_id;
        $product->book_type_id = $request->book_type_id;
        $product->publication_id = $request->publication_id;
        $product->product_units_id = $request->product_units_id;
        $product->product_name_en = $request->product_name_en;
        $product->product_name_bn = $request->product_name_bn;
        $product->product_slug_en = strtolower(str_replace(' ', '-', $request->product_name_en));
        $product->product_slug_bn = str_replace(' ', '-', $request->product_name_bn);
        $product->product_code = $request->product_code;
        $product->product_qty = $request->product_qty;
        $product->product_tags_en = $request->product_tags_en;
        $product->product_tags_bn = $request->product_tags_bn;
        $product->product_size_en = $request->product_size_en;
        $product->product_size_bn = $request->product_size_bn;
        $product->product_color_en = $request->product_color_en;
        $product->product_color_bn = $request->product_color_bn;

        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->expired_date = $request->expired_date;
        $product->short_descp_en = $request->short_descp_en;
        $product->short_descp_bn = $request->short_descp_bn;
        $product->long_descp_en = $request->long_descp_en;
        $product->long_descp_bn = $request->long_descp_bn;

        $product->hot_deals = $request->hot_deals;
        $product->featured = $request->featured;
        $product->special_offer = $request->special_offer;
        $product->special_deals = $request->special_deals;

        $product->sid_sps_section = strtolower($request->sid_sps_section);

        // $product->status = 1;
        $product->created_at = Carbon::now();

        $product->update();
        if ($product) {
            $notification = array(
                'message' => 'Product Updated Without Image Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Product Updated Failed');
        }
    }















    public function MultiImageAdd(Request $request)
    {
        $multi_image_add = new MultiImg();

        $request->validate([
            'multi_img_add' => 'image|mimes:jpeg,png,gif,webp|max:1024|required',
        ]);

        $filename = null;
        if (isset($request->multi_img_add)) {
            $multi_img_add = $request->file('multi_img_add');
            $filename = time().'.'.$request->file('multi_img_add')->getClientOriginalExtension();
            // .'.'.$request->file('multi_img_add')->getClientOriginalExtension();
            Storage::putFileAs('public/products/multi-image', $request->file('multi_img_add'), $filename);
            // $destinationPath = public_path('multi_img_add_vision');
            $destinationPath =  storage_path('app/public/products/multi-image');
            // exit;
            $img = Image::make($multi_img_add->path());
            $img->resize(917, 1000, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
        }


        $multi_image_add->product_id = $request->input('product_id');
        $multi_image_add->photo_name = $filename;
        // dd($multi_image_add);
        $multi_image_add->save();

        if ($multi_image_add) {
            $notification = array(
                'message' => 'Multi-img Add Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Multi-img Add Failed');
        }


    }
















    //////// Product Main Thabnail Update /////////
    public function ThambnailImageUpdate(Request $request, $id)
    {

        $request->validate([
            'product_thambnail' => 'image|mimes:jpeg,png,gif,webp|max:1024|required',
        ]);

        $product_thambnail_img = Product::find($id);
        $product_thambnail_img->product_thambnail;
        if (isset($request->product_thambnail)) {
            $product_thambnail = $request->file('product_thambnail');
            $filename = time().'.'.$request->file('product_thambnail')->getClientOriginalExtension();
            // .'.'.$request->file('product_thambnail')->getClientOriginalExtension();
            Storage::putFileAs('public/products/thambnail', $request->file('product_thambnail'), $filename);
            // $destinationPath = public_path('product_thambnail_vision');
            $destinationPath =  storage_path('app/public/products/thambnail');
            // exit;
            $img = Image::make($product_thambnail->path());
            $img->resize(917, 1000, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

            //remove old image
            if($product_thambnail_img->product_thambnail){
                $old_filename = public_path("storage\products\\thambnail\\" . $product_thambnail_img->product_thambnail);
                if (file_exists($old_filename) != false) {
                    unlink($old_filename);
                }
            }

            $product_thambnail_img->product_thambnail = $filename;
        }
        $product_thambnail_img->update();
        if ($product_thambnail_img) {
            $notification = array(
                'message' => 'Thambnail Image Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Product Thambnail Updated Failed');
        }
        
    }



    //////// Multi Image Update /////////
    public function MultiImageUpdate(Request $request)
    {

        // dd($request);
        $request->validate([
            'multi_img' => 'max:500|required',
        ]);

        $imgs = $request->multi_img;
        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            $filename = time().'.'.$img->getClientOriginalName();
            // .'.'.$request->file('product_thambnail')->getClientOriginalExtension();
            Storage::putFileAs('public/products/multi-image', $img, $filename);
            // $destinationPath = public_path('product_thambnail_vision');
            $destinationPath =  storage_path('app/public/products/multi-image');
            // exit;
            $img = Image::make($img->path());
            $img->resize(917, 1000, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

            //remove old image
            if($img){
                $old_filename = public_path("storage\products\multi-image\\" . $imgDel->photo_name);
                if (file_exists($old_filename) != false) {
                    unlink($old_filename);
                }
            }

            MultiImg::where('id', $id)->update([
                'photo_name' => $filename,
                'updated_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Multi-Image Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);

    }



    ////////// Multi Image Delete ///////////
    public function MultiImageDelete($id)
    {
        $oldimg = MultiImg::findOrFail($id);
        $path = public_path("storage\products\multi-image\\" . $oldimg->photo_name );
        if (File::exists($path)) {
            File::delete($path);
        }
        $oldimg->delete();
        if ($oldimg) {
            $notification = array(
                'message' => 'Multi-Image Deleted Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Product Image Deleted Failed');
        }
    }


    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    public function ProductActive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        $path = public_path("storage\products\\thambnail\\" . $product->product_thambnail );
        if (File::exists($path)) {
            File::delete($path);
        }
        $product->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            $path = public_path("storage\products\\multi-image\\" . $img->photo_name );
            if (File::exists($path)) {
                File::delete($path);
            }
           MultiImg::where('product_id', $id)->delete();
        }
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }



    //  Product Stock
    public function ProductStock()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_stock', compact('products'));
    }

    public function StockRequest()
    {
        $products = StockRequest::with('user','Product')->latest()->get();
        
        return view('backend.product.product_stock_request', compact('products'));
    }
    public function StockRequestDelete($id)
    {
        $products = StockRequest::with('Product')->where('id',$id)->first();
        $willbeDelete= StockRequest::where('product_id', $products->product_id)->delete();
        if ($willbeDelete) {
            $notification = array(
                'message' => 'Deleted Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Category Deleted Failed');
        }
    }
    

    public function ProductStockQtyEdit($id)
    {
        $stock_quantity = Product::find($id);
        return view('backend.product.product_stock_edit_modal', compact('stock_quantity'));
    }



    public function ProductStockQtyUpdate(Request $request)
    {

        $stock_product = Product::find($request->stock_qty_id);

        $stock_product->product_qty = intval($request->stock_quantity);
        $stock_product->update();
        if ($stock_product) {
            $notification = array(
                'message' => 'Stock Quantity Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('product.stock')->with($notification);
            // return response()->json(array(
            //     'success' => 'Successfully Updated',
            // ));
        } else {
            return redirect()->back()->with('fail', 'Stock Quantity Update Failed');
            // return response()->json(array(
            //     'success' => 'Update Failed',
            // ));
        }
        
    }


}
