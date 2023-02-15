<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserFollowers;
use App\Models\User;
use App\Models\City;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class FollowUnfollowController extends Controller
{ 
    public function index(){

        $userId = Auth::user()->id;

        $userList = UserFollowers::where(['following_id' => $userId, 'follow_unfollow_status' => TRUE])->get()
        ->toArray();
        
        $followingArr = [];
        foreach ($userList as $key => $value) {
            
            $followingArr[$key] = $value;
            
            $user = User::where('id', $value['follower_id'])->first();
            $followingArr[$key]['user'] = $user;
        }

        return view('frontend.business.pages.profiles.following', compact('followingArr'));
    }

    public function followUnfollowFilter(Request $request){

        if (!empty($request->sorting_data) && $request->sorting_data = 'follow') {

            $data = UserFollowers::where(['follower_id' => $request->followerId, 'follow_unfollow_status' => TRUE])->get()->toArray();

        }else if (!empty($request->sorting_data) && $request->sorting_data = 'unfollow'){

            $data = UserFollowers::where(['following_id' => $request->followerId, 'follow_unfollow_status' => TRUE])->get()->toArray();

        }

        $followerArr = [];
        foreach ($data as $key => $value) {
            
            $followerArr[$key] = $value;

            $user = User::where('id', $value['following_id'])->first();
            $followerArr[$key]['user'] = $user;

        }
        return view('frontend.business.pages.follow_unfollow.followunfollowFilter', compact('followerArr'));

    }

    public function followers(Request $request)
    {
        
        $data = UserFollowers::where(['following_id' => $request->following_id, 'follower_id' => $request->follower_id])->first();
       
        if (!empty($data)) {


            if ($request->follow_unfollow_status == 'Follow') {

                $status_update = UserFollowers::where(['following_id' => $request->following_id, 'follower_id' => $request->follower_id])->first();
                $status_update->following_id = $request->following_id;
                $status_update->follower_id = $request->follower_id;
                $status_update->follow_unfollow_status = FALSE;
                $status_update->save();
                $follower_user = UserFollowers::where(['follower_id' => $request->follower_id, 'follow_unfollow_status' => TRUE])->count();
                return response()->json(['data' => $follower_user, 'code' => 200, 'success' => "Successfully done ".$request->follow_unfollow_status.""], 200);

                

            } else {

                $status_update = UserFollowers::where(['following_id' => $request->following_id, 'follower_id' => $request->follower_id])->first();
                $status_update->following_id = $request->following_id;
                $status_update->follower_id = $request->follower_id;
                $status_update->follow_unfollow_status = TRUE;
                $status_update->save();
                $follower_user = UserFollowers::where(['follower_id' => $request->follower_id, 'follow_unfollow_status' => TRUE])->count();
                return response()->json(['data' => $follower_user, 'code' => 200, 'success' => "Successfully done ".$request->follow_unfollow_status.""], 200);

            }


        } else {

            $follow = new UserFollowers;
            $follow->following_id = $request->following_id;
            $follow->follower_id = $request->follower_id;
            $follow->follow_unfollow_status = true;
            $follow->save();
            $follower_user = UserFollowers::where(['follower_id' => $request->follower_id, 'follow_unfollow_status' => TRUE])->count();
            return response()->json(['data' => $follower_user, 'code' => 200, 'success' => "Successfully done ".$request->follow_unfollow_status.""], 200);
        }
    }

}
