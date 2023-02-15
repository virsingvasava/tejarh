<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use Illuminate\Support\Str;
use File;
use Lang;


class CmsController extends Controller
{
    
    public function index()
    {
        $cms_pages = CmsPage::get();
        return view('admin.cms.index',compact('cms_pages'));
    }

    public function create()
    {
        return view('admin.cms.create');
    }
    public function store(Request $request)
    {
        $slug = str_replace(" ","_",$request->title);
        $slug = str_replace("#","_",$slug);
        $slug = str_replace("?","_",$slug);

        $cms_page_create = new CmsPage;
        $cms_page_create->title = $request->title;
        $cms_page_create->slug = strtolower($slug);
        $cms_page_create->short_description = $request->short_description;
        $cms_page_create->description = $request->description;
        $cms_page_create->status = $request->status;
        $cms_page_create->save();
        return redirect()->route('admin.cms.index')->with('success', __('messages.cms.success.cms_added_successfully'));        
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $page = CmsPage::where('id',$id)->first();
        return view('admin.cms.view',compact('page'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $page = CmsPage::where('id',$id)->first();
        return view('admin.cms.edit',compact('page'));
    }

    public function update(Request $request)
    {
        $cms_page_create = CmsPage::where('id',$request->id)->first();
        $cms_page_create->title = $request->title;
        $cms_page_create->short_description = $request->short_description;
        $cms_page_create->description = $request->description;
        $cms_page_create->status = $request->status;
        $cms_page_create->save();
        return redirect()->route('admin.cms.index')->with('success', __('messages.cms.success.cms_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->cms_id;
        CmsPage::where('id',$id)->delete();
        return redirect()->route('admin.cms.index')->with('error',__('messages.cms.success.cms_deleted_successfully'));

    }

    public function cms_status_update(Request $request)
    {
        $status_update = CmsPage::where('id',$request->cms_id)->first();
        $status_update->status = $request->status;
        $status_update->save();

        return redirect()->route('admin.cms.index')->with('success', __('messages.cms.success.status_updated_successfully'));
    }
}
