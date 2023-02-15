<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    WholesaleGeneral,
};

class WholesaleGeneralController extends Controller
{
    public function index()
    {
        $wholesale_general = WholesaleGeneral::get();
        return view('admin.wholesale_general.index', compact('wholesale_general'));
    }

    public function create()
    {
        return view('admin.wholesale_general.create');
    }

    public function store(Request $request)
    {
        $add_wholesale_general = new WholesaleGeneral();
        $add_wholesale_general->title = $request->title;
        $add_wholesale_general->description = $request->description;

        $add_wholesale_general->ar_title = $request->ar_title;
        $add_wholesale_general->ar_description = $request->ar_description;

        if ($request->hasFile('wholesale_general_image')) {
            $wholesale_general_image = $request->file('wholesale_general_image');
            $name = time() . '.' . $wholesale_general_image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/wholesale_general');

            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $wholesale_general_image->move($destinationPath, $name);
            $add_wholesale_general->wholesale_general_image = $name;
        }
        $add_wholesale_general->status = $request->status;
        $add_wholesale_general->ar_status = $request->ar_status;
        $add_wholesale_general->save();
        return redirect()->route('admin.wholesale_general.index')->with('success', 'Wholesale General added successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->wholesale_general_id;
        WholesaleGeneral::where('id', $id)->delete();
        return redirect()->route('admin.wholesale_general.index')->with('error', 'Wholesale General deleted successfully!');
    }

    public function wholesale_general_status_update(Request $request)
    {
        $status_update = WholesaleGeneral::where('id', $request->wholesale_general_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.wholesale_general.index')->with('success', 'Status updated successfully!');
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_wholesale_general = WholesaleGeneral::where('id', $id)->first();
        return view('admin.wholesale_general.view', compact('view_wholesale_general'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_wholesale_general = WholesaleGeneral::where('id', $id)->first();
        return view('admin.wholesale_general.edit', compact('edit_wholesale_general'));
    }

    public function update(Request $request){

        //p($request->all());

        $wholesale_general_update = WholesaleGeneral::where('id', $request->id)->first();
        $wholesale_general_update->title = $request->title;
        $wholesale_general_update->description = $request->description;
        
        $wholesale_general_update->ar_title = $request->ar_title;
        $wholesale_general_update->ar_description = $request->ar_description;
        $image = $request->wholesale_general_image;
        if ($request->has('wholesale_general_image')) {

            $imageName = $request->wholesale_general_image;
            $imageold = WholesaleGeneral::find($request->id);
            $destination = public_path('assets/wholesale_general');
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } 
        else {

            $imageold = WholesaleGeneral::find($request->id);
            $imageName = $imageold->wholesale_general_image;
        }
        $wholesale_general_update->wholesale_general_image = $imageName;
        $wholesale_general_update->status = $request->status;
        $wholesale_general_update->ar_status = $request->ar_status;
        $wholesale_general_update->save();
        return redirect()->route('admin.wholesale_general.index')->with('success','Wholesale General updated successfully');
    }
}
