<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function PublicationView()
    {
        $publications = Publication::latest()->get();
        return view('backend.publication.publication_view', compact('publications'));
    }


    public function PublicationStore(Request $request)
    {
        $request->validate([
            'publication_name_en' => 'required|max:100',
            'publication_name_bn' => 'required|max:100',
        ],[
            'publication_name_en.required' => 'Input Publication English Name',
            'publication_name_bn.required' => 'Input Publication Bangla Name',
        ]);

        Publication::insert([
            'publication_name_en' => $request->publication_name_en,
            'publication_name_bn' => $request->publication_name_bn,
            'status' => $request->status == "" ? 0 : $request->status,
        ]);
        $notification = array(
            'message' => 'Publication Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function PublicationEdit($id)
    {
        $publications = Publication::findOrFail($id);
        return view('backend.publication.publication_edit', compact('publications'));
    }


    public function PublicationUpdate(Request $request, $id)
    {

        $request->validate([
            'publication_name_en' => 'required|max:100',
            'publication_name_bn' => 'required|max:100',
        ],[
            'publication_name_en.required' => 'Input Publication English Name',
            'publication_name_bn.required' => 'Input Publication Bangla Name',
        ]);

        $publications = Publication::find($id);

        $publications->publication_name_en = $request->input('publication_name_en');
        $publications->publication_name_bn = $request->input('publication_name_bn');
        $publications->status = $request->input('status') == "" ? 0 : $request->input('status');
        // dd($news);
        $publications->update();
        if ($publications) {
            $notification = array(
                'message' => 'Publication Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.publication')->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Publication Updated Failed');
        }
    }


    public function PublicationDelete($id)
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();
        if ($publication) {
            $notification = array(
                'message' => 'Publication Deleted Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            return redirect()->back()->with('fail', 'Publication Deleted Failed');
        }
    }
}
