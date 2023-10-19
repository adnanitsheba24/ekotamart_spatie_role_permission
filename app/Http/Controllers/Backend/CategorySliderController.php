<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategorySlider;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CategorySliderController extends Controller
{

    public function CategorySliderView()
    {
        $data['category_sliders'] = CategorySlider::with('category')->latest()->get();
        $data['categories'] = Category::latest()->get();
        return view('backend.slider.category_slider.category_slider_view')->with($data);
    }



    public function CategorySliderStore(Request $request)
    {
        $request->validate([
            'category_slider_img' => 'required',
            'category_id' => 'required',
        ],[
            'category_slider_img.required' => 'Plz Select Category Slider Image',
        ]);

        $filename = null;
        if (isset($request->category_slider_img)) {
            $category_slider_img = $request->file('category_slider_img');
            $filename = time().'.'.$request->file('category_slider_img')->getClientOriginalExtension();
            // .'.'.$request->file('category_slider_img')->getClientOriginalExtension();
            Storage::putFileAs('public/category_wise_slider', $request->file('category_slider_img'), $filename);
            // $destinationPath = public_path('category_slider_img_vision');
            $destinationPath =  storage_path('app/public/category_wise_slider');
            // exit;
            $img = Image::make($category_slider_img->path());
            $img->resize(1666, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
        }

        CategorySlider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'category_slider_img' => $filename,
            'category_id' =>  $request->category_id,
            'subcategory_id' =>  $request->subcategory_id,
            'subsubcategory_id' =>  $request->subsubcategory_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Category Slider Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }




    public function CategorySliderEdit($id)
    {
        $data['category_sliders'] = CategorySlider::findOrFail($id);
        $data['categories'] = Category::latest()->get();
        return view('backend.slider.category_slider.category_slider_edit', with($data));
    }




    public function CategorySliderUpdate(Request $request, $id)
    {

        $request->validate([
            'category_id' => 'required',
        ]);

        $category_sliders = CategorySlider::find($id);

        $category_sliders->category_slider_img;
        // $filename = null;
        if (isset($request->category_slider_img)) {
            $image = $request->file('category_slider_img');
            $filename = time().'.'.$request->file('category_slider_img')->getClientOriginalName();
            // .'.'.$request->file('category_slider_img')->getClientOriginalExtension();
            Storage::putFileAs('public/category_wise_slider', $request->file('category_slider_img'), $filename);
            // echo 
            $destinationPath =  storage_path('app/public/category_wise_slider');
            // exit;
            $img = Image::make($image->path());
            $img->resize(1666, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

            //remove old image
            if($category_sliders->category_slider_img){
                $old_filename = public_path("storage\\category_wise_slider\\" . $category_sliders->category_slider_img);
                if (file_exists($old_filename) != false) {
                    unlink($old_filename);
                }
            }
            $category_sliders->category_slider_img = $filename;

            $category_sliders->title = $request->input('title');
            $category_sliders->description = $request->input('description');
            $category_sliders->category_id = $request->input('category_id');
            $category_sliders->subcategory_id = $request->input('subcategory_id');
            $category_sliders->subsubcategory_id = $request->input('subsubcategory_id');
            $category_sliders->updated_at = Carbon::now();
            // dd($category_sliders);
            $category_sliders->update();

            $notification = array(
                'message' => 'Categoy Slider Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('manage.category-slider')->with($notification);

        }else{
            $category_sliders->title = $request->input('title');
            $category_sliders->description = $request->input('description');
            $category_sliders->category_id = $request->input('category_id');
            $category_sliders->subcategory_id = $request->input('subcategory_id');
            $category_sliders->subsubcategory_id = $request->input('subsubcategory_id');
            $category_sliders->updated_at = Carbon::now();
            // dd($category_sliders);
            $category_sliders->update();

            $notification = array(
                'message' => 'Category Slider Updated Without Image Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('manage.category-slider')->with($notification);
        }

    }



    public function CategorySliderDelete($id)
    {
        $category_sliders = CategorySlider::findOrFail($id);
        $path = public_path("storage\\category_wise_slider\\" . $category_sliders->category_slider_img );
        if (File::exists($path)) {
            File::delete($path);
        }
        $category_sliders->delete();
        if ($category_sliders) {
            $notification = array(
                'message' => 'Category Slider Deleted Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Category Slider Deleted Failed');
        }
    }



    public function CategorySliderInactive($id)
    {
        CategorySlider::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Category Slider Inactive Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }



    public function CategorySliderActive($id)
    {
        CategorySlider::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Category Slider Active Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
    
}
