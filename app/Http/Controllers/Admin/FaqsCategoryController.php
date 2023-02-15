<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Support\Str;
use File;
use Lang;

class FaqsCategoryController extends Controller
{
    public function index() 
    {
        $faqs = FaqCategory::get();
        return view('admin.faqs.faqs_category.index',compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.faqs_category.create');
    }

    public function store(Request $request)
    { 
        $validatedRequestData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ], [
            'name.required' => Lang::get('messages.faq_category.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.faq_category.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.faq_category.create.validation.please_select_status'),
        ]);

        $faq = new FaqCategory;
        $faq->name = $request->name;
        $faq->slug = Str::slug($request->slug);
        $faq->status = $request->status;
        $faq->save();
        return redirect()->route('admin.faqs.faqs_category.index')->with('success', __('messages.faq_category.success.faq_category_added_successfully'));

    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_category = FaqCategory::where('id',$id)->first();
        return view('admin.faqs.faqs_category.view',compact('view_category'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_faq = FaqCategory::where('id',$id)->first();
        return view('admin.faqs.faqs_category.edit',compact('edit_faq'));

    }

    public function update(Request $request)
    {
        $validatedRequestData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ], [
            'name.required' => Lang::get('messages.faq_category.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.faq_category.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.faq_category.create.validation.please_select_status'),
        ]);

        $faq_update = FaqCategory::where('id',$request->id)->first();
        $faq_update->name = $request->name;
        $faq_update->slug = Str::slug($request->slug);
        $faq_update->status = $request->status;
        $faq_update->save();

        return redirect()->route('admin.faqs.faqs_category.index')->with('success', __('messages.faq_category.success.faq_category_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->faq_category_id;
        FaqCategory::where('id',$id)->delete();
        return redirect()->route('admin.faqs.faqs_category.index')->with('error', __('messages.faq_category.success.faq_category_deleted_successfully'));

    }

    public function faq_category_status_update(Request $request)
    {
        $status_update = FaqCategory::where('id',$request->faq_category_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.faqs.faqs_category.index')->with('success', __('messages.faq_category.success.status_updated_successfully'));
    }
}
