<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Support\Str;
use File;
use Lang;

class FaqController extends Controller
{
    public function index() 
    {
        $faqs = Faq::get();
        return view('admin.faqs.faq.index',compact('faqs'));
    }

    public function create()
    {
        $category = FaqCategory::get();
        return view('admin.faqs.faq.create',compact('category'));
    }

    public function store(Request $request)
    { 

        $validatedRequestData = $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'status' => 'required',
        ], [
            'category_id.required' => Lang::get('messages.faq.create.validation.please_select_category'),
            'title.required' => Lang::get('messages.faq.create.validation.please_enter_title'),
            'subtitle.required' => Lang::get('messages.faq.create.validation.please_enter_sub_title'),
            'slug.required' => Lang::get('messages.faq.create.validation.please_enter_slug'),
            'short_description.required' => Lang::get('messages.faq.create.validation.please_enter_description'),
            'status.required' => Lang::get('messages.faq.create.validation.please_select_status'),

        ]);

        $faq = new Faq;
        $faq->category_id = $request->category_id;
        $faq->title = $request->title;
        $faq->subtitle = $request->subtitle;
        $faq->description = $request->short_description;
        $faq->slug = Str::slug($request->slug);
        $faq->status = $request->status;
        $faq->save();
        return redirect()->route('admin.faqs.faq.index')->with('success', __('messages.faq.success.faq_added_successfully'));

    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_faq = Faq::where('id',$id)->first();
        return view('admin.faqs.faq.view',compact('view_faq'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_faq = Faq::where('id',$id)->first();
        $category = FaqCategory::get();
        return view('admin.faqs.faq.edit',compact('edit_faq', 'category'));

    }

    public function update(Request $request)
    {

         $validatedRequestData = $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'status' => 'required',
        ], [
            'category_id.required' => Lang::get('messages.faq.create.validation.please_select_category'),
            'title.required' => Lang::get('messages.faq.create.validation.please_enter_title'),
            'subtitle.required' => Lang::get('messages.faq.create.validation.please_enter_sub_title'),
            'slug.required' => Lang::get('messages.faq.create.validation.please_enter_slug'),
            'short_description.required' => Lang::get('messages.faq.create.validation.please_enter_description'),
            'status.required' => Lang::get('messages.faq.create.validation.please_select_status'),

        ]);
         
        $faq_update = Faq::where('id',$request->id)->first();
        $faq_update->category_id = $request->category_id;
        $faq_update->title = $request->title;
        $faq_update->subtitle = $request->subtitle;
        $faq_update->description = $request->description;
        $faq_update->slug = Str::slug($request->slug);
        $faq_update->status = $request->status;
        $faq_update->save();

        return redirect()->route('admin.faqs.faq.index')->with('success', __('messages.faq.success.faq_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->faq_id;
        Faq::where('id',$id)->delete();
        return redirect()->route('admin.faqs.faq.index')->with('error', __('messages.faq.success.faq_deleted_successfully'));

    }

    public function faq_status_update(Request $request)
    {
        $status_update = Faq::where('id',$request->faq_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.faqs.faq.index')->with('success',__('messages.faq.success.status_updated_successfully'));
    }
}
