<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{

    public function index() 
    {  
        $blogsArray = Blog::where('status','=','1')->get();
        return view('frontend.users.site_links.blogs.index',compact('blogsArray'));

    }


    public function blog_details($id)
    {
        $blogsDetails = Blog::where(['id' => $id, 'deleted_at' => NULL])
        ->where('status','=','1')
        ->orderBy('created_at','DESC')
        ->first();

        $relatedBlogs = Blog::where('status','=','1')->get();
        return view('frontend.users.site_links.blogs.view', compact('relatedBlogs', 'blogsDetails'));
    }
}
