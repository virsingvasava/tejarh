<?php

namespace App\Http\Controllers;

use App\Models\ShortBanner;
use Illuminate\Http\Request;
use File;

class ShortBannerController extends Controller
{
    public function index()
    {
        $short_banner = ShortBanner::get();
        return view('admin.short_banner.index', compact('short_banner'));
    }

    public function create()
    {
        return view('admin.short_banner.create');
    }

    public function store(Request $request)
    {
        $add_short_banner = new ShortBanner();
        $add_short_banner->title = $request->title;
        if ($request->hasFile('short_banners_image')) {
            $short_banners_image = $request->file('short_banners_image');
            $name = time() . '.' . $short_banners_image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/short_banners');

            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $short_banners_image->move($destinationPath, $name);
            $add_short_banner->short_banners_image = $name;
        }
        $add_short_banner->status = $request->status;
        $add_short_banner->save();
        return redirect()->route('admin.short_banner.index')->with('success', 'Banner added successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->short_banner_id;
        ShortBanner::where('id', $id)->delete();
        return redirect()->route('admin.short_banner.index')->with('error', 'Banner deleted successfully!');
    }

    public function short_banner_status_update(Request $request)
    {
        $status_update = ShortBanner::where('id', $request->short_banner_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.short_banner.index')->with('success', 'Status updated successfully!');
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_short_banner = ShortBanner::where('id', $id)->first();
        return view('admin.short_banner.view', compact('view_short_banner'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_short_banner = ShortBanner::where('id', $id)->first();
        return view('admin.short_banner.edit', compact('edit_short_banner'));
    }

    public function update(Request $request){
        $short_banner_update = ShortBanner::where('id', $request->id)->first();
        $short_banner_update->title = $request->title;
        $image = $request->short_banners_image;
        if ($request->has('short_banners_image')) {

            $imageName = $request->short_banners_image;
            $imageold = ShortBanner::find($request->id);
            $destination = public_path('assets/short_banners');
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } 
        else {

            $imageold = ShortBanner::find($request->id);
            $imageName = $imageold->short_banners_image;
        }
        $short_banner_update->short_banners_image = $imageName;
        $short_banner_update->status = $request->status;
        $short_banner_update->save();
        return redirect()->route('admin.short_banner.index')->with('success','Banner updated successfully');
    }
}
