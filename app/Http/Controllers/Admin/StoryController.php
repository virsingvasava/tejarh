<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use App\Models\Stories;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserStory;

class StoryController extends Controller
{

    
    public function index() 
    {
        $story = Stories::with('user')->get();
        return view('admin.story.index',compact('story'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_story = Stories::where('id',$id)->first();
        $view_category = Category::where('id',$view_story->category_id)->first();
        $view_user = User::where('id',$view_story->user_id)->first();
        return view('admin.story.view',compact('view_story','view_category','view_user'));
    }

    public function destroy(Request $request)
    {
        $id = $request->story_id;
        Stories::where('id',$id)->delete();
        return redirect()->route('admin.story.index')->with('error','Story deleted successfully!');
    }

    public function story_status_update(Request $request)
    {
        $status_update = Stories::where('id',$request->story_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.story.index')->with('success','Status updated successfully!');
    }
}
