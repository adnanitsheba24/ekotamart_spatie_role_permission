<?php

namespace App\Http\Controllers\Backend;

use App\Models\ProductUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Product_UnitController extends Controller
{
    public function ProductUnitsView()
    {
        $product_units = ProductUnit::latest()->get();
        return view('backend.product_units.product_units_view', compact('product_units'));
    }


    public function ProductUnitsStore(Request $request)
    {
        // dd($request);
        $request->validate([
            'product_units_name_en' => 'required|max:100',
            'product_units_name_bn' => 'required|max:100',
        ],[
            'product_units_name_en.required' => 'Input Product-Unit English Name',
            'product_units_name_bn.required' => 'Input Product-Unit Bangla Name',
        ]);

        ProductUnit::insert([
            'product_units_name_en' => $request->product_units_name_en,
            'product_units_name_bn' => $request->product_units_name_bn,
            'status' => $request->status == "" ? 0 : $request->status,
        ]);
        $notification = array(
            'message' => 'Product-Unit Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    public function ProductUnitsEdit($id)
    {
        $product_units = ProductUnit::findOrFail($id);
        return view('backend.product_units.product_units_edit', compact('product_units'));
    }


    public function ProductUnitsUpdate(Request $request, $id)
    {

        $request->validate([
            'product_units_name_en' => 'required|max:100',
            'product_units_name_bn' => 'required|max:100',
        ],[
            'product_units_name_en.required' => 'Input Product Unit English Name',
            'product_units_name_bn.required' => 'Input Product Unit Bangla Name',
        ]);

        $product_units = ProductUnit::find($id);

        $product_units->product_units_name_en = $request->input('product_units_name_en');
        $product_units->product_units_name_bn = $request->input('product_units_name_bn');
        $product_units->status = $request->input('status') == "" ? 0 : $request->input('status');
        // dd($news);
        $product_units->update();
        if ($product_units) {
            $notification = array(
                'message' => 'Product Unit Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.product_units')->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Product Unit Updated Failed');
        }
    }


    public function ProductUnitsDelete($id)
    {
        $product_units = ProductUnit::findOrFail($id);
        $product_units->delete();
        if ($product_units) {
            $notification = array(
                'message' => 'Product Unit Deleted Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Product Unit Deleted Failed');
        }
    }
}
