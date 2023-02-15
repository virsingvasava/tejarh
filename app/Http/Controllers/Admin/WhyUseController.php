<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    WhyUse,
};

class WhyUseController extends Controller
{
    public function index()
    {
        $general = WhyUse::get();
        return view('admin.why_use.index', compact('general'));
    }

    public function create()
    {
        return view('admin.why_use.create');
    }

    public function store(Request $request)
    {
        $add_general = new WhyUse;
        $add_general->title = $request->title;
        $add_general->description = $request->description;

        $add_general->ar_title = $request->ar_title;
        $add_general->ar_description = $request->ar_description;

        if ($request->hasFile('general_image')) {
            $general_image = $request->file('general_image');
            $name = time() . '.' . $general_image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/general_image');

            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $general_image->move($destinationPath, $name);
            $add_general->general_image = $name;
        }
        $add_general->status = $request->status;
        $add_general->ar_status = $request->ar_status;
        $add_general->save();
        return redirect()->route('admin.why_use.index')->with('success', 'Added successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->general_id;
        WhyUse::where('id', $id)->delete();
        return redirect()->route('admin.why_use.index')->with('error', 'Deleted successfully!');
    }

    public function general_status_update(Request $request)
    {
        $status_update = WhyUse::where('id', $request->general_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.why_use.index')->with('success', 'Status updated successfully!');
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_general = WhyUse::where('id', $id)->first();
        return view('admin.why_use.view', compact('view_general'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_general = WhyUse::where('id', $id)->first();
        return view('admin.why_use.edit', compact('edit_general'));
    }

    public function update(Request $request){
        $general_update = WhyUse::where('id', $request->id)->first();
        $general_update->title = $request->title;
        $general_update->description = $request->description;
        $general_update->ar_title = $request->ar_title;
        $general_update->ar_description = $request->ar_description;
        $image = $request->general_image;
        if ($request->has('general_image')) {

            $imageName = $request->general_image;
            $imageold = WhyUse::find($request->id);
            $destination = public_path('assets/general_image');
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } 
        else {

            $imageold = WhyUse::find($request->id);
            $imageName = $imageold->general_image;
        }
        $general_update->general_image = $imageName;
        $general_update->status = $request->status;
        $general_update->ar_status = $request->ar_status;
        $general_update->save();
        return redirect()->route('admin.why_use.index')->with('success','Updated successfully');
    }
}
