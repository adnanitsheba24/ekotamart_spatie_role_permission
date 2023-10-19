<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Laravel\Fortify\Contracts\LogoutResponse;

class UserController extends Controller
{

    public function login()
    {
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.user.login.login_page')->with($data);
    }



    public function ShowProfilePage()
    {
        $id = Auth::guard('web')->id();
        $user_img = User::where('id', $id)->first();
        $data['user_data'] = Auth::user();
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        
        return view('frontend.user.profile.userprofile', compact('user_img'))->with($data);
        
    }



    public function UpdateProfile(Request $request, $user_id)
    {
        $user_data = User::find($user_id);
        $user_data->name = $request->name;
        $user_data->email = $request->email;
        $user_data->phone = $request->phone;
        $user_data->date_of_birth = $request->birthdate;

        // $user_data->profile_photo_path;

        if (isset($request->profile_image)) {

            //remove old image
            if ($user_data->profile_photo_path) {
                $old_filename = public_path("storage\\face_photo\\" . $user_data->profile_photo_path);
                if (file_exists($old_filename) != false) {
                    unlink($old_filename);
                }
            }

            $image = $request->file('profile_image');

            $filename = time().'.'.$request->file('profile_image')->getClientOriginalExtension();
            Storage::putFileAs('public/face_photo', $request->file('profile_image'), $filename);
            // echo 
            $destinationPath =  storage_path('app/public/face_photo');
            // exit;
            $img = Image::make($image->path());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);

            // //remove old image
            // if ($user_data->profile_photo_path) {
            //     $old_filename = public_path("storage\\face_photo\\" . $user_data->profile_image);
            //     if (file_exists($old_filename) != false) {
            //         unlink($old_filename);
            //     }
            // }

            $user_data->profile_photo_path = $filename;

            $user_data->update();
        }
        return redirect()->back();
    }



    public function ShowChangePass()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $data['main_category']  = Category::where('status', 1)->orderBy('serial', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
        foreach($data['main_category'] as $item){
            $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
        }
        foreach($sub_category as $item){
            $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
        }
        return view('frontend.user.change_password.change_password', compact('user'))->with($data);
    }



    public function UserChangePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
    }



    public function MobileLogin(Request $request)
    {
        $phoneNumber = $request->phone;
        if (substr($phoneNumber, 0, 3) === "+88") {
            // Remove the first three digits
            $phoneNumber = substr($phoneNumber, 3);
        }
        $user = User::where('phone', $phoneNumber)->first();
        if ($user) {
            Auth::login($user);

        } else {
            
            // User does not exist, create a new account
            $user = new User();
            $user->google_id = $request->id;
            $user->phone = $phoneNumber;
            $user->name = $phoneNumber;
            $user->email = $request->id . "@null.com";
            $user->password = encrypt('123456dummy');           
            $user->save();

            // Log the new user in
            Auth::login($user);
        }
        return response()->json(['success' => 'Successful']);
    }



    public function loginOrSignup(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user && !Hash::check($request->input('password'), $user->password)) {
            $notification = array(
                'message' => 'Incorrect Password',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }

        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                // User exists and password matches, log them in
                Auth::login($user);
                $notification = array(
                    'message' => 'Login Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('front_index')->with($notification);
            }
        } else {
            // User does not exist, create a new account
            $user = new User();
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            // Log the new user in
            Auth::login($user);
            $notification2 = array(
                'message' => 'Login Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification2);
        }

        // If we haven't redirected yet, the login or signup failed
        return redirect()->back()->withErrors(['email' => 'Invalid login or signup details.']);
    }



    public function destroy(Request $request): LogoutResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return app(LogoutResponse::class);
        return redirect()->url("/");
    }



}
