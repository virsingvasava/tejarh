<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserStory;
use App\Models\UserFollowers;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail;
use File;

class UserStoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function postRefreshToken(Request $request) 
    {
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) 
        {
            return $response;
        }
    }

    public function getUserStory(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $user_story = UserStory::where('user_id',$user_id)->first();        

        if(empty($user_story)){
            $message = "User story not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch user story listing successfully.';
        return SuccessResponse($message,200,$user_story);
    }

    public function getUserStoryDetails(Request $request)
    {
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'story_id' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $user_story = UserStory::where(['id' => $request->story_id, 'user_id' => $user_id])->first();        

        if(empty($user_story)){
            $message = "User Detail not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch user detail successfully.';
        return SuccessResponse($message,200,$user_story);
    }

    public function getBought(Request $request){

        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $user_story = User::where('id',$user_id)->first();        

        if(empty($user_story)){
            $message = "User bought detail not found";
            return InvalidResponse($message,101);
        }

        $message = 'User Bought detail';
        return SuccessResponse($message,200,$user_story);
    }

    public function getSold(Request $request){

        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $user_story = User::where('id',$user_id)->first();        

        if(empty($user_story)){
            $message = "User bought detail not found";
            return InvalidResponse($message,101);
        }

        $message = 'User Bought detail';
        return SuccessResponse($message,200,$user_story);
    }

    public function getFollower(Request $request){

        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $user_story = User::with('followers')->where('id',$user_id)->first();

        if(empty($user_story)){
            $message = "User follower detail not found";
            return InvalidResponse($message,101);
        }

        $message = 'User follower detail';
        return SuccessResponse($message,200,$user_story);
    }

    public function getFollowing(Request $request){
        
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $user_story = User::with('followers')->where('id',$user_id)->first();

        if(empty($user_story)){
            $message = "User following detail not found";
            return InvalidResponse($message,101);
        }

        $message = 'User following detail';
        return SuccessResponse($message,200,$user_story);
    }

    public function verifiedProfileBy(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $user_story = UserStory::where('user_id',$user_id)->first();        

        if(empty($user_story)){
            $message = "Not verified profile";
            return InvalidResponse($message,101);
        }

        $message = 'Verified profile successfully.';
        return SuccessResponse($message,200,$user_story);
    }

    public function verifiedSellerBadge(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $user_story = UserStory::where('user_id',$user_id)->first();        

        if(empty($user_story)){
            $message = "Not verified seller badge";
            return InvalidResponse($message,101);
        }

        $message = 'Verified seller badge successfully.';
        return SuccessResponse($message,200,$user_story);
    }

    public function itemsFromThisSeller(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $items_sell_from_this = UserStory::where('user_id',$user_id)->first();        

        if(empty($items_sell_from_this)){
            $message = "Items from this seller not found.";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch Items from this seller successfully.';
        return SuccessResponse($message,200,$items_sell_from_this);
    }
    
    public function verifiedYourAccount(Request $request)
    {
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $user_story = UserStory::where('user_id',$user_id)->first();        

        if(empty($user_story)){
            $message = "Not verified your account";
            return InvalidResponse($message,101);
        }

        $message = 'Verified your account successfully.';
        return SuccessResponse($message,200,$user_story);
    }

    public function uploadingStory(Request $request)
    {    
        $inputData = $request->all();
        
        $header = $request->header('AuthorizationUser');
        
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'video_or_image_file' => 'required',
            'product_name' => 'required',
            'category_id' => 'required',
            'story_description' => 'required',
            'product_price' => 'required',
            'store_location' => 'required',
            //'customer_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        
        $uploading_story = new UserStory;
        $uploading_story->user_id = $user_id;
        $uploading_story->product_name = $request->product_name;
        $uploading_story->category_id = $request->category_id;
        $uploading_story->story_description = $request->story_description;
        $uploading_story->product_price = $request->product_price;
        $uploading_story->store_location = $request->store_location;
        //$uploading_story->customer_id = $request->customer_id;

        if ($request->hasFile('video_or_image_file')) 
        {
            $video_or_image_file = $request->file('video_or_image_file');
            $name = time().'.'.$video_or_image_file->getClientOriginalExtension();
            $destinationPath = public_path('/userstories');
            $video_or_image_file->move($destinationPath, $name);
            if (!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $uploading_story->video_or_image_file = $name;
        }

        $uploading_story->save();

        $message = 'Story uploading Successfully.';

        return SuccessResponse($message,200,$uploading_story);
    }

    public function storyPreview(Request $request){

        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if(empty($header))
        {
            $message = 'Authorisation required' ;
            return InvalidResponse($message,101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];
        
        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            //'user_id' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $message = $validator->messages()->first();
            return InvalidResponse($message,101);
        }

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $storyPreview = UserStory::where('user_id',$user_id)->get();        

        if(empty($storyPreview)){
            $message = "Story Preview detail not found";
            return InvalidResponse($message,101);
        }

        $message = 'Fetch story preview successfully.';

        return SuccessResponse($message,200,$storyPreview);
    }
}
