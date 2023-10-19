<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Category;
use App\Models\ShipUpazila;
use App\Models\SubCategory;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function AdminProfile()
    {
        $id = Auth::guard('admin')->id();  
        $adminData = Admin::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }


    public function AdminProfileEdit()
    {
        $id = Auth::guard('admin')->id();
        $editData = Admin::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }


    // public function AdminProfileStore(Request $request)
    // {
    //     $id = Auth::guard('admin')->id();
    //     $data = Admin::find($id);

    //     $data->name = $request->input('name');
    //     $data->email = $request->input('email');

    //     if($request->file('profile_photo_path')){
    //         $file = $request->file('profile_photo_path');
    //         @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
    //         $filename = date('YmdHi').$file->getClientOriginalName();
    //         $file->move(public_path('upload/admin_images'), $filename);
    //         $data['profile_photo_path'] = $filename;
    //     }
    //     $data->save();

    //     $notification = array(
    //         'message' => 'Admin Profile Updated Successfully',
    //         'alert-type' => 'info'
    //     );

    //     return redirect()->route('admin.profile')->with($notification);

    // }

    



    public function AdminProfileUpdate(Request $request, $id) 
    {

        $request->validate([
            'profile_photo_path' => 'image|mimes:jpeg,png,gif,webp|max:500',
        ]);

        // $id = Auth::guard('admin')->id();
        $data = Admin::find($id);


        $data->profile_photo_path;
        // $filename = null;
        if (isset($request->profile_photo_path)) {
            $image = $request->file('profile_photo_path');
            // time().'.'.
            $filename = $request->file('profile_photo_path')->getClientOriginalName();
            // .'.'.$request->file('profile_photo_path')->getClientOriginalExtension();
            Storage::putFileAs('public/admin_images', $request->file('profile_photo_path'), $filename);
            // echo 
            $destinationPath =  storage_path('app/public/admin_images');
            // exit;
            $img = Image::make($image->path());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$filename);

            //remove old image
            if($data->profile_photo_path){
                $old_filename = public_path("storage\admin_images\\" . $data->profile_photo_path);
                if (file_exists($old_filename) != false) {
                    unlink($old_filename);
                }
            }

            $data->profile_photo_path = $filename;
        }

        $data->name = $request->input('name');
        $data->email = $request->input('email');

        $data->update();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('admin.profile')->with($notification);
    }



    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }


    public function AdminUpdateChangePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword'   => 'required',
            'password'      => 'required|confirmed',
        ]);


        $hashedPassword = Admin::find(1)->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else {
            return redirect()->back();
        }
    }




    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('backend.user.all_user', compact('users'));
    }



    public function AllUsersEdit($id)
    {
        $users = User::findOrFail($id);
        return view('backend.user.all_user_edit', compact('users'));
    }



    // public function AllUsersUpdate(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'max:100',
    //         'email' => 'max:50',
    //         'phone' => 'numeric|digits:11',
    //     ]);

    //     if ($request->validate == true) {
    //         $users = User::findOrFail($id);

    //         $users->name = $request->input('name');
    //         $users->email = $request->input('email');
    //         $users->phone = $request->input('phone');
    //         // $users->update();
    //         if ($users->update()) {
    //             $notification = array(
    //                 'message' => 'User Info Updated Successfully',
    //                 'alert-type' => 'info'
    //             );
    //             return redirect()->route('all-users')->with($notification);
    //         } else {
    //             return redirect()->back()->with('fail', 'User Info Updated Failed');
    //         }
    //     }
    //     else {
    //         // return redirect()->back();
    //         $notification = array(
    //             'message' => 'User email & phone must be unique',
    //             'alert-type' => 'warning'
    //         );
    //         return redirect()->back()->with($notification);
    //     }

    // }


    public function AllUsersShow($id)
    {
        $users = User::with('order')->findOrFail($id);
        if ($users->order != null) {
            $ship_division = ShipDivision::where('id', $users->order->division_id)->value('division_name');
            $ship_district = ShipDistrict::where('id', $users->order->district_id)->value('district_name');
            $ship_upazila = ShipUpazila::where('id', $users->order->upazila_id)->value('upazila_name');
            return view('backend.user.all_user_show', compact('users', 'ship_division', 'ship_district', 'ship_upazila'));
        }else {
            return view('backend.user.all_user_show', compact('users'));
        }
    }


}
