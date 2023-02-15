<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class B_ImagesBulkController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $images = Image::where('user_id',$userId)->orderBy('id','DESC')->get();
        return view('frontend.business.pages.upload_images',compact('images'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png|max:2048'
        ]);

        $userId = Auth::user()->id;
        $images = [];
        if ($request->imageFile) {
            foreach ($request->imageFile as $key => $image) {

                $imageName = time() . rand(1, 99) . '.' . $image->extension();
                $destinationPath = public_path('/assets/post');
                $image->move($destinationPath, $imageName);

                // $createImage = new Image;
                // $createImage->image = $imageName;
                // $createImage->user_id = $userId;
                // $createImage->save();

                $createArr = ['name' => $imageName, 'user_id' => $userId];
                Image::insert($createArr);

            }
        }
        foreach ($images as $key => $image) {
            Image::create($image);
        }
        return back()->with('success', 'File has successfully uploaded!');
    }

    public function destroy(Request $request){
        $id = $request->image_id;
        Image::where('id', $id)->delete();
        return back()->with('success', 'File has Deleted Successfully');
    }
}
