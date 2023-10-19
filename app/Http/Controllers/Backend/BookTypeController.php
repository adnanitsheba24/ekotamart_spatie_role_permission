<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book_type;
use Illuminate\Http\Request;

class BookTypeController extends Controller
{

    public function BookTypeView()
    {
        $book_types = Book_type::latest()->get();
        return view('backend.book_type.book_type_view', compact('book_types'));
    }


    public function BookTypeStore(Request $request)
    {
        $request->validate([
            'book_type_name_en' => 'required|max:100',
            'book_type_name_bn' => 'required|max:100',
        ],[
            'book_type_name_en.required' => 'Input Book-Type English Name',
            'book_type_name_bn.required' => 'Input Book-Type Bangla Name',
        ]);

        Book_type::insert([
            'book_type_name_en' => $request->book_type_name_en,
            'book_type_name_bn' => $request->book_type_name_bn,
            'status' => $request->status == "" ? 0 : $request->status,
        ]);
        $notification = array(
            'message' => 'Book-Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    public function BookTypeEdit($id)
    {
        $book_types = Book_type::findOrFail($id);
        return view('backend.book_type.book_type_edit', compact('book_types'));
    }


    public function BookTypeUpdate(Request $request, $id)
    {

        $request->validate([
            'book_type_name_en' => 'required|max:100',
            'book_type_name_bn' => 'required|max:100',
        ],[
            'book_type_name_en.required' => 'Input Book-Type English Name',
            'book_type_name_bn.required' => 'Input Book-Type Bangla Name',
        ]);

        $book_types = Book_type::find($id);

        $book_types->book_type_name_en = $request->input('book_type_name_en');
        $book_types->book_type_name_bn = $request->input('book_type_name_bn');
        $book_types->status = $request->input('status') == "" ? 0 : $request->input('status');
        // dd($news);
        $book_types->update();
        if ($book_types) {
            $notification = array(
                'message' => 'Book Type Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.book-type')->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Book Type Updated Failed');
        }
    }


    public function BookTypeDelete($id)
    {
        $book_types = Book_type::findOrFail($id);
        $book_types->delete();
        if ($book_types) {
            $notification = array(
                'message' => 'Book Type Deleted Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Book Type Deleted Failed');
        }
    }

}
