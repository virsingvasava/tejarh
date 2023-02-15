<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use File;
use Lang;

class BlogController extends Controller
{
    public function index() 
    {
        $blogs = Blog::get();
        return view('admin.blog.index',compact('blogs'));
    }

    public function create()
    {
        $blog_create = Blog::get();
        return view('admin.blog.create',compact('blog_create'));
    }

    public function store(Request $request)
    { 

        $validatedRequestData = $request->validate([

            'heading_title' => 'required',
            'subtitle_heading' => 'required',
            'description' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'heading_title' => Lang::get('messages.blog.create.validation.please_enter_heading_title'),
            'subtitle_heading.required' => Lang::get('messages.blog.create.validation.please_enter_subtitle_heading'),
            'description.required' => Lang::get('messages.blog.create.validation.please_enter_descriptionl'),
            'slug.required' => Lang::get('messages.blog.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.blog.create.validation.please_select_status'),
        ]);

        $blog = new Blog;
        $blog->heading_title = $request->heading_title;
        $blog->subtitle_heading = $request->subtitle_heading;
        $blog->description = $request->description;
        $blog->slug = Str::slug($request->slug);
        $blog->status = $request->status;
        $blog->save();
        return redirect()->route('admin.blog.index')->with('success', __('messages.blog.success.blog_added_successfully'));
    }

    public function view($id)
    {
        $view_blog = Blog::where('id',$id)->first();
        return view('admin.blog.view',compact('view_blog'));
    }

    public function edit($id)
    {
        $edit_blog = Blog::where('id',$id)->first();
        return view('admin.blog.edit',compact('edit_blog'));

    }

    public function update(Request $request)
    {

        $validatedRequestData = $request->validate([

            'heading_title' => 'required',
            'subtitle_heading' => 'required',
            'description' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'heading_title' => Lang::get('messages.blog.create.validation.please_enter_heading_title'),
            'subtitle_heading.required' => Lang::get('messages.blog.create.validation.please_enter_subtitle_heading'),
            'description.required' => Lang::get('messages.blog.create.validation.please_enter_descriptionl'),
            'slug.required' => Lang::get('messages.blog.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.blog.create.validation.please_select_status'),
        ]);

        $blog_update = Blog::where('id',$request->id)->first();
        $blog_update->heading_title = $request->heading_title;
        $blog_update->subtitle_heading = $request->subtitle_heading;
        $blog_update->description = $request->description;
        $blog_update->slug = Str::slug($request->slug);
        $blog_update->status = $request->status;
        $blog_update->save();

        return redirect()->route('admin.blog.index')->with('success', __('messages.blog.success.blog_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->blog_id;
        Blog::where('id',$id)->delete();
        return redirect()->route('admin.blog.index')->with('error',__('messages.blog.success.blog_deleted_successfully'));

    }

    public function blog_status_update(Request $request)
    {
        $status_update = Blog::where('id',$request->blog_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.blog.index')->with('success',__('messages.blog.success.status_updated_successfully'));
    }
}
