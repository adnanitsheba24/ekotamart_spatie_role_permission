<?php

namespace App\Http\Controllers\Backend;

use App\Models\TopSidebar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SidebarController extends Controller
{

    public function TopSidebarView()
    {
        $top_sidebar = TopSidebar::orderBy('id', 'desc')->get();
        return view('backend.sidebar.top_sidebar_menu_list', compact('top_sidebar'));
    }



    public function TopSidebarAdd()
    {
        return view('backend.sidebar.top_sidebar_menu_add');
    }



    public function TopSidebarStore(Request $request)
    {
        
        $request->validate([
            'icon' => 'required|image|mimes:jpeg,png,gif,webp|max:500',
            'name_en' => 'required|max:100',
            'name_bn' => 'required|max:100',
            'priority' => 'numeric|min:1',
        ]);

        $top_sidebar = new TopSidebar();

        $filename = null;
        if (isset($request->icon)) {
            $image = $request->file('icon');
            $filename = time().'.'.$request->file('icon')->getClientOriginalExtension();
            // .'.'.$request->file('icon')->getClientOriginalExtension();
            // getClientOriginalName()
            Storage::putFileAs('public/top_sidebar_icon', $request->file('icon'), $filename);
            // $destinationPath = public_path('icon_vision');
            $destinationPath =  storage_path('app/public/top_sidebar_icon');
            // exit;
            // $manager = new Image(['driver' => 'imagick']);
            $img = Image::make($image->path());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);
            
        }

        $top_sidebar->icon = $filename;

        // $top_sidebar->name_en = strtolower($request->input('name_en'));
        $top_sidebar->name_en = $request->input('name_en');
        $top_sidebar->name_bn = $request->input('name_bn');
        $top_sidebar->priority = $request->input('priority');
        $top_sidebar->status = $request->input('status') == "" ? 0 : $request->input('status');

        $top_sidebar->save();

        if ($top_sidebar) {
            $notification = array(
                'message' => 'Top Sidebar Inserted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('top_sidebar.view')->with($notification);
        } else {
            return redirect()->back()->with('error', 'Top Sidebar Inserted Failed');
        }

    }



    public function TopSidebarEdit($id)
    {
        $top_sidebar = TopSidebar::findOrFail($id);
        return view('backend.sidebar.top_sidebar_menu_edit', compact('top_sidebar'));
    }



    public function TopSidebarUpdate(Request $request, $id)
    {

        $request->validate([
            'icon' => 'image|mimes:jpeg,png,gif,webp|max:500',
            'name_en' => 'required|max:100',
            'name_bn' => 'required|max:100',
            'priority' => 'numeric|min:1',
        ]);

        $top_sidebar = TopSidebar::findOrFail($id);

        $top_sidebar->icon;
        // $filename = null;
        if (isset($request->icon)) {
            $image = $request->file('icon');
            $filename = time().'.'.$request->file('icon')->getClientOriginalName();
            // .'.'.$request->file('icon')->getClientOriginalExtension();
            Storage::putFileAs('public/top_sidebar_icon', $request->file('icon'), $filename);
            // echo 
            $destinationPath =  storage_path('app/public/top_sidebar_icon');
            // exit;
            $img = Image::make($image->path());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

            //remove old image
            if($top_sidebar->icon){
                $old_filename = public_path("storage\\top_sidebar_icon\\" . $top_sidebar->icon);
                if (file_exists($old_filename) != false) {
                    unlink($old_filename);
                }
            }

            $top_sidebar->icon = $filename;
        }

        // $top_sidebar->name_en = strtolower($request->input('name_en'));
        $top_sidebar->name_en = $request->input('name_en');
        $top_sidebar->name_bn = $request->input('name_bn');
        $top_sidebar->priority = $request->input('priority');
        $top_sidebar->status = $request->input('status') == "" ? 0 : $request->input('status');

        // dd($top_sidebar);
        $top_sidebar->update();

        if ($top_sidebar) {
            $notification = array(
                'message' => 'Top Sidebar Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('top_sidebar.view')->with($notification);
        } else {
            return redirect()->back()->with('error', 'Top Sidebar Updated Failed');
        }

    }

}
