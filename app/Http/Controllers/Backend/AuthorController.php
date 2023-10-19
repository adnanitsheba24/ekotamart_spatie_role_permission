<?php

namespace App\Http\Controllers\Backend;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book_type;
use App\Models\Publication;

class AuthorController extends Controller
{
   public function AuthorView()
   {
       $authors = Author::with('category', 'book_type', 'publication')->latest()->get();
       $categories = Category::orderBy('category_name_en', 'ASC')->get();
       return view('backend.author.author_view', compact('authors', 'categories'));
   }



   public function AuthorAdd()
   {
       $categories = Category::orderBy('category_name_en', 'ASC')->get();
       $book_types = Book_type::orderBy('book_type_name_en', 'ASC')->get();
       $publications = Publication::orderBy('publication_name_en', 'ASC')->get();
       return view('backend.author.author_add', compact('categories', 'book_types', 'publications'));
   }


   public function AuthorStore(Request $request)
   {
        // dd($request);
        $request->validate([
            'category_id' => 'required',
            'book_type_id' => 'required',
            // 'publication_id' => 'required',
            'author_name_en' => 'required',
            'author_name_bn' => 'required',
        ],[
            'category_id.required' => 'Please Select The Category',
            'book_type_id.required' => 'Please Select The Book-Type',
            // 'publication_id.required' => 'Please Select The Publication',
            'author_name_en.required' => 'Input Author English Name',
            'author_name_bn.required' => 'Input Author Bangla Name',
        ]);

        $authors = new Author();

        $authors->category_id = $request->input('category_id');
        $authors->book_type_id = $request->input('book_type_id');
        $authors->publication_id = $request->input('publication_id');
        $authors->author_name_en = $request->input('author_name_en');
        $authors->author_name_bn = $request->input('author_name_bn');
        $authors->status = $request->input('status') == "" ? 0 : $request->input('status');
        $authors->save();
        if ($authors) {
            $notification = array(
                'message' => 'Author Created Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.author')->with($notification);
        } else {
            return redirect()->back()->with('error', 'Author Created Inserted Failed');
        }
   }



   public function AuthorEdit($id)
   {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $book_types = Book_type::orderBy('book_type_name_en', 'ASC')->get();
        $publications = Publication::orderBy('publication_name_en', 'ASC')->get();
        $authors = Author::findOrFail($id);
        return view('backend.author.author_edit', compact('categories', 'book_types', 'publications', 'authors'));
   }


   public function AuthorUpdate(Request $request, $id)
    {

        $request->validate([
            'category_id' => 'required',
            'book_type_id' => 'required',
            // 'publication_id' => 'required',
            'author_name_en' => 'required',
            'author_name_bn' => 'required',
        ],[
            'category_id.required' => 'Please Select The Category',
            'book_type_id.required' => 'Please Select The Book-Type',
            // 'publication_id.required' => 'Please Select The Publication',
            'author_name_en.required' => 'Input Author English Name',
            'author_name_bn.required' => 'Input Author Bangla Name',
        ]);

        $authors = Author::find($id);

        $authors->category_id = $request->input('category_id');
        $authors->book_type_id = $request->input('book_type_id');
        $authors->publication_id = $request->input('publication_id');
        $authors->author_name_en = $request->input('author_name_en');
        $authors->author_name_bn = $request->input('author_name_bn');
        $authors->status = $request->input('status') == "" ? 0 : $request->input('status');
        $authors->update();
        if ($authors) {
            $notification = array(
                'message' => 'Author Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.author')->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Author Updated Failed');
        }
    }



    public function AuthorDelete($id)
    {
        $authors = Author::findOrFail($id);
        $authors->delete();
        if ($authors) {
            $notification = array(
                'message' => 'Author Deleted Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Author Deleted Failed');
        }
    }

    

}
