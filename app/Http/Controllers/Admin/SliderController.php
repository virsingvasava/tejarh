<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use File;
use Lang;

class SliderController extends Controller
{
      
    public function index() 
    {
        $home_slider = Slider::get();
        return view('admin.slider.index',compact('home_slider'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    { 
        $validatedRequestData = $request->validate([
            'banner_heading_title' => 'required',
            'banner_sub_heading_title' => 'required',
            'banner_description' => 'required',
            'banner_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',

        ], [
            'banner_heading_title.required' => Lang::get('messages.slider.create.validation.banner_heading_title'),
            'banner_sub_heading_title.required' => Lang::get('messages.slider.create.validation.banner_sub_heading_title'),
            'banner_description.required' => Lang::get('messages.slider.create.validation.banner_description'),
            'banner_picture.required' => Lang::get('messages.slider.create.validation.banner_picture'),
            'status.required' => Lang::get('messages.slider.create.validation.status'),
        ]);

        $slider = new Slider;
        $slider->banner_heading_title = $request->banner_heading_title;
        $slider->banner_sub_heading_title = $request->banner_sub_heading_title ;
        $slider->banner_description = $request->banner_description;

        if ($request->hasFile('banner_picture')) 
        {
            $banner_picture = $request->file('banner_picture');
            $name = time().'.'.$banner_picture->getClientOriginalExtension();
            $destinationPath = public_path('/img/home_slider');
            $banner_picture->move($destinationPath, $name);
            
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
          
            $slider->banner_picture = $name;
        }
        
        $slider->status = $request->status;
        $slider->save();
        return redirect()->route('admin.slider.index')->with('success','Slider added successfully');

    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_slider = Slider::where('id',$id)->first();
        return view('admin.slider.view',compact('view_slider'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_slider = Slider::where('id',$id)->first();
        return view('admin.slider.edit',compact('edit_slider'));

    }

    public function update(Request $request)
    {

               // p($request->all());


        $validatedRequestData = $request->validate([
            'banner_heading_title' => 'required',
            'banner_sub_heading_title' => 'required',
            'banner_description' => 'required',
            'banner_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',

        ], [
            'banner_heading_title.required' => Lang::get('messages.slider.create.validation.banner_heading_title'),
            'banner_sub_heading_title.required' => Lang::get('messages.slider.create.validation.banner_sub_heading_title'),
            'banner_description.required' => Lang::get('messages.slider.create.validation.banner_description'),
            'banner_picture.required' => Lang::get('messages.slider.create.validation.banner_picture'),
            'status.required' => Lang::get('messages.slider.create.validation.status'),
        ]);

        $slider_update = Slider::where('id',$request->id)->first();
        $slider_update->banner_heading_title = $request->banner_heading_title;
        $slider_update->banner_sub_heading_title = $request->banner_sub_heading_title ;
        $slider_update->banner_description = $request->banner_description;

    
        $image = $request->banner_picture;
        if ($request->has('banner_picture')) {

            $imageName = $request->banner_picture;
            $imageold = Slider::find($request->id);
            //unlink("img/home_slider/".$imageold->banner_picture);
            $destination = public_path('img/home_slider');
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            $image->move($destination, $imageName);
        } 
        else {

            $imageold = Slider::find($request->id);
            $imageName = $imageold->banner_picture;
        }

        $slider_update->banner_picture = $imageName;
        $slider_update->status = $request->status;

        $slider_update->ar_banner_heading_title = $request->ar_banner_heading_title;
        $slider_update->ar_banner_sub_heading_title = $request->ar_banner_sub_heading_title ;
        $slider_update->ar_banner_description = $request->ar_banner_description;
        $slider_update->ar_status = $request->ar_status;
        $slider_update->save();
        return redirect()->route('admin.slider.index')->with('success','Slider updated successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->slider_id;
        Slider::where('id',$id)->delete();
        return redirect()->route('admin.slider.index')->with('error','Slider deleted successfully!');

    }

    public function slider_status_update(Request $request)
    {
        $status_update = Slider::where('id',$request->slider_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.slider.index')->with('success','Slider status updated successfully!');
    }
}
