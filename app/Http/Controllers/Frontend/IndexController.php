<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\UserStory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    
    public function index(Request $request){

        $sliderImage = Slider::where('status',ACTIVE)->where('deleted_at','=',NULL)->get();      
        $category =  Category::where('status',ACTIVE)->where('deleted_at','=',NULL)->limit(7)->get();
        
        $AllCategoryCount =  Category::where('status',ACTIVE)->where('deleted_at','=',NULL)->count();

        $take = $AllCategoryCount - count($category);
        $skip = 7;
        $categorySingle =  Category::where('status',ACTIVE)->where('deleted_at','=',NULL)->skip($skip)->take($take)->get();  
        if(Auth::check()){
            $LoginuserStory =  UserStory::select('user_id')->groupBy('user_id')->where('user_id','=',Auth::user()->id)->where('deleted_at','=',NULL)->get();  
            $Story = UserStory::where('deleted_at','=',NULL)->where('user_id','=',Auth::user()->id)->get();     
        }else{
            $LoginuserStory =  UserStory::select('user_id')->groupBy('user_id')->where('deleted_at','=',NULL)->get(); 
            $user = User::where('role',USER_ROLE)->get();
            $userArray = array();
            foreach($user as $usr){
                $userArray[] = $usr->id; 
            }    
            // For Multi Story
            $StoryAll = UserStory::select('user_id')->where('deleted_at','=',NULL)->whereIn('user_id',$userArray)->groupBy('user_id')->get(); 
                       
            $CheckUser = array();
            foreach($StoryAll as $key => $tr){
                $CheckUser[] = $tr['user_id'];         
            }

            $Story = array();
            foreach($CheckUser as $key => $value){
                $StoryAll = UserStory::with('user','category')->where('deleted_at','=',NULL)->where('user_id',$value)->get()->toArray(); 
                $Story[] = $StoryAll;
            }

        }      
    
        return view('frontend.home',compact('sliderImage','category','LoginuserStory','categorySingle','Story','AllCategoryCount'));   
    }     

}
