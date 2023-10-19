<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Shipping;
use App\Models\ShipUpazila;
use App\Models\SubCategory;
use App\Models\ShipDistrict;

use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutController extends Controller
{
    public function DistrictGetAjax($division_id)
    {
        $ship = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        // dd($ship);
        return json_encode($ship);

    }


    public function UpazilaGetAjax($district_id)
    {
        $ship = ShipUpazila::where('district_id', $district_id)->orderBy('upazila_name', 'ASC')->get();
        return json_encode($ship);
    }


    public function CheckoutStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'shipping_name' => 'required|max:100',
            'shipping_email' => 'required|max:50',
            'shipping_phone' => 'required|numeric|digits:11',
            'date_of_birth' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'address' => 'required|max:255',
             'gender' => 'required',
        ],[
            'name.required' => 'Name field is a required',
            'email.required' => 'Email field is a required',
            'phone.required' => 'Phone field is a required',
            'date_of_birth.required' => 'Date Of Birth field is a required',
            'division_id.required' => 'Division field is a required',
            'district_id.required' => 'District field is a required',
            'upazila_id.required' => 'upazila field is a required',
            'address.required' => 'Address field is a required',
            'gender.required' => 'Gender field is a required',
        ]);
        
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['gender'] = $request->gender;
        $data['date_of_birth'] = $request->date_of_birth;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['upazila_id'] = $request->upazila_id;
        $data['address'] = $request->address;
        $data['main_category']  = Category::orderBy('id', 'asc')->get();
        $sub_category  = SubCategory::orderBy('id', 'asc')->get();
                foreach($data['main_category'] as $item){
                    $data['sub_category'][$item->id] = SubCategory::orderBy('id', 'asc')->where('category_id', $item->id)->get();
                }
                foreach($sub_category as $item){
                    $data['sub_sub_category'][$item->id] = SubSubCategory::orderBy('id', 'asc')->where('subcategory_id',$item->id)->get();
                }
        
        $cartTotal = Cart::total();

        if ($request->payment_method == 'stripe') {
            return view('frontend.payment.stripe', compact('data','cartTotal'))->with($data);
        }elseif ($request->payment_method == 'bkash') {
            return 'bkash';
        }else{
            return view('frontend.payment.cash', compact('data','cartTotal'))->with($data);
        }


    }
}
