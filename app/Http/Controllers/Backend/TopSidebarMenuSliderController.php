<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\TopSidebar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TopSidebarMenuSlider;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class TopSidebarMenuSliderController extends Controller
{

    public function TopSidebarMenuSliderView()
    {
        $data['top_sibebar_menu_slider'] = TopSidebarMenuSlider::with('top_sidebar')->latest()->get();
        $data['top_sidebars'] = TopSidebar::latest()->get();
        return view('backend.slider.top_sidebar_menu_slider.top_sidebar_menu_slider_view')->with($data);
    }



    public function TopSidebarMenuSliderStore(Request $request)
    {

        // dd($request);

        $request->validate([
            'top_sidebar_menu_slider_img' => 'required',
            'top_sidebar_id' => 'required',
        ],[
            'top_sidebar_menu_slider_img.required' => 'Plz Select Top-Sidebar Slider Image',
        ]);

        $filename = null;
        if (isset($request->top_sidebar_menu_slider_img)) {
            $top_sidebar_menu_slider_img = $request->file('top_sidebar_menu_slider_img');
            $filename = time().'.'.$request->file('top_sidebar_menu_slider_img')->getClientOriginalExtension();
            // .'.'.$request->file('top_sidebar_menu_slider_img')->getClientOriginalExtension();
            Storage::putFileAs('public/top_sidebar_menu_wise_slider', $request->file('top_sidebar_menu_slider_img'), $filename);
            // $destinationPath = public_path('top_sidebar_menu_slider_img_vision');
            $destinationPath =  storage_path('app/public/top_sidebar_menu_wise_slider');
            // exit;
            $img = Image::make($top_sidebar_menu_slider_img->path());
            $img->resize(1666, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
        }

        TopSidebarMenuSlider::insert([
            'top_sidebar_id' =>  strtolower($request->top_sidebar_id),
            'top_sidebar_menu_slider_img' => $filename,
            'title' => $request->title,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Top-Sidebar Slider Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }




    public function TopSidebarMenuSliderEdit($id)
    {
        $data['top_sibebar_menu_slider'] = TopSidebarMenuSlider::findOrFail($id);
        $data['top_sidebars'] = TopSidebar::latest()->get();
        return view('backend.slider.top_sidebar_menu_slider.top_sidebar_menu_slider_edit', with($data));
    }




    public function TopSidebarMenuSliderUpdate(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'top_sidebar_id' => 'required',
        ]);

        $top_sibebar_menu_slider = TopSidebarMenuSlider::find($id);

        $top_sibebar_menu_slider->top_sidebar_menu_slider_img;
        // $filename = null;
        if (isset($request->top_sidebar_menu_slider_img)) {
            $image = $request->file('top_sidebar_menu_slider_img');
            $filename = time().'.'.$request->file('top_sidebar_menu_slider_img')->getClientOriginalName();
            // .'.'.$request->file('top_sidebar_menu_slider_img')->getClientOriginalExtension();
            Storage::putFileAs('public/top_sidebar_menu_wise_slider', $request->file('top_sidebar_menu_slider_img'), $filename);
            // echo 
            $destinationPath =  storage_path('app/public/top_sidebar_menu_wise_slider');
            // exit;
            $img = Image::make($image->path());
            $img->resize(1666, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

            //remove old image
            if($top_sibebar_menu_slider->top_sidebar_menu_slider_img){
                $old_filename = public_path("storage\\top_sidebar_menu_wise_slider\\" . $top_sibebar_menu_slider->top_sidebar_menu_slider_img);
                if (file_exists($old_filename) != false) {
                    unlink($old_filename);
                }
            }
            $top_sibebar_menu_slider->top_sidebar_menu_slider_img = $filename;

            $top_sibebar_menu_slider->top_sidebar_id = strtolower($request->input('top_sidebar_id'));
            $top_sibebar_menu_slider->title = $request->input('title');
            $top_sibebar_menu_slider->description = $request->input('description');
            $top_sibebar_menu_slider->updated_at = Carbon::now();
            // dd($top_sibebar_menu_slider);
            $top_sibebar_menu_slider->update();

            $notification = array(
                'message' => 'Top-Sidebar Slider Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('manage.top-sidebar-menu-slider')->with($notification);

        }else{
            $top_sibebar_menu_slider->top_sidebar_id = strtolower($request->input('top_sidebar_id'));
            $top_sibebar_menu_slider->title = $request->input('title');
            $top_sibebar_menu_slider->description = $request->input('description');
            $top_sibebar_menu_slider->updated_at = Carbon::now();
            // dd($top_sibebar_menu_slider);
            $top_sibebar_menu_slider->update();

            $notification = array(
                'message' => 'Top-Sidebar Slider Updated Without Image Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('manage.top-sidebar-menu-slider')->with($notification);
        }

    }



    public function TopSidebarMenuSliderDelete($id)
    {
        $top_sibebar_menu_slider = TopSidebarMenuSlider::findOrFail($id);
        $path = public_path("storage\\top_sidebar_menu_wise_slider\\" . $top_sibebar_menu_slider->category_slider_img );
        if (File::exists($path)) {
            File::delete($path);
        }
        $top_sibebar_menu_slider->delete();
        if ($top_sibebar_menu_slider) {
            $notification = array(
                'message' => 'Top-Sidebar Slider Deleted Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Top-Sidebar Slider Deleted Failed');
        }
    }



    public function TopSidebarMenuSliderInactive($id)
    {
        TopSidebarMenuSlider::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Top-Sidebar Slider Inactive Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }



    public function TopSidebarMenuSliderActive($id)
    {
        TopSidebarMenuSlider::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Top-Sidebar Slider Active Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
