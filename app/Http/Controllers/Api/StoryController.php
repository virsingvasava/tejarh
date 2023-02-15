<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\cardDetails;
use App\Models\storie_preview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserStory;
use App\Models\UserDeviceToken;
use Illuminate\Support\Facades\Auth;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Crypt;
use Tymon\JWTAuth\JWTAuth as JWTAuthJWTAuth;
use Checkout\CheckoutSdk;
use Checkout\Common\Address;
use Checkout\Environment;
use Checkout\Common\Currency;
use Checkout\Common\Country;
use App\Models\CheckOutPayment;
use App\Models\City;
use App\Models\StoryPrice;
use Checkout\Common\Phone;
use Checkout\Common\Country as checkoutCountry;
use Checkout\Common\CustomerRequest;
use Checkout\Payments\Request\PaymentRequest;
use Checkout\Payments\Request\Source\RequestCardSource;
use Checkout\Payments\Sender\Identification;
use Checkout\Payments\Sender\IdentificationType;
use Checkout\Payments\Sender\PaymentIndividualSender;
use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth')->except(['getStoryList','storyprice']);
    }
    public function getStoryList(Request $request)
    {

        $inputData = $request->all();

        $user_story_list = UserStory::select('user_id')->groupBy('user_id')
            ->where('deleted_at', '=', NULL)
            ->where('is_paid', '=', '1')->get();
        $story_list = array();
        foreach ($user_story_list as $key => $value) {
            //$story_list[$key] = $value;
            $Story = UserStory::where('deleted_at', '=', NULL)
                ->where('is_paid', '=', '1')
                ->where('user_id', '=', $value['user_id'])
                ->get();

            $user = User::where('id', $value['user_id'])->first();
            $story_list[$key] = $user;

            $story_list[$key]['Story'] = $Story;
        }

        if (!empty($story_list)  && count($story_list) > 0) {
            $message = 'Fetch users story listing successfully.';
            return SuccessResponse($message, 200, $story_list);
        } else {
            $message = "Users story not found";
            return InvalidResponse($message, 101);
        }
    }

    public function addStory(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'video_or_image_file' => 'required',
            'product_name' => 'required',
            'category_id' => 'required',
            'story_description' => 'required',
            'story_price' => 'required',
            'store_location' => 'required',
            'file_type' => 'required',
        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }

        $usetStory = new UserStory;

        $image = $request->video_or_image_file;

        if ($request->has('video_or_image_file')) {
            $imagename = $request->video_or_image_file;

            $removeImage = public_path() . "\assets\userstories" . "\\" . $imagename;
            if (is_file($removeImage)) {
                unlink($removeImage);
            }
            $destination = public_path('assets/userstories');
            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }
            $name = 'images' . time();
            $imageName = $name . '.' . $image->getClientOriginalExtension();
            //dd($imageName);
            $image->move($destination, $imageName);
        } else {
            $imageName = null;
        }
         $storyprices = StoryPrice::first();
        $usetStory->user_id = $user_id;
        $usetStory->video_or_image_file = $imageName;
        $usetStory->product_name = $request->product_name;
        $usetStory->category_id = $request->category_id;
        $usetStory->story_description = $request->story_description;
        $usetStory->product_price = $storyprices->story_price;
        $usetStory->store_location = $request->store_location;
        $usetStory->file_type = $request->file_type;
        $usetStory->save();

        $save_token = new cardDetails();
        $save_token->user_id  = $user_id;
        $save_token->holder_name  = $request->holder_name;
        $save_token->card_number  = $request->card_number;
        $save_token->expiry_month  = $request->expiry_month;
        $save_token->expiry_year  = $request->expiry_year;
        $save_token->cvv  = $request->cvv;
        $save_token->save();

        $api = CheckoutSdk::builder()->staticKeys()
            ->environment(Environment::sandbox())
            ->secretKey("sk_sbox_kxgkyhqokicx6oll6dzvf7zdxqk")
            ->build();

        $api = CheckoutSdk::builder()->oAuth()
            ->clientCredentials("ack_4vesek7j37ne5l73rfg5pxolzy", "cCJYVaOdkJLU72BRCOagBxQivblDEIW0LxsZyeQ3sPsW_w_buLocD9e0A20dkkpF_B7OjY3LzM3FR51cuDJnOg")
            ->scopes(['gateway'])
            ->environment(Environment::sandbox())
            ->build();
        $user = User::where('id', $user_id)->first();
        $city = $user->city_id;
        $cityDetails = City::where('id',$city)->first();

        $phone = new Phone;
        $phone->country_code = $user->phone_code;
        $phone->number = $user->phone_number;
        
        $address = new Address();
        $address->address_line1 = 'NULL';
        $address->address_line2 = 'NULL';
        $address->city = $cityDetails->name;
        // $address->state = "London";
        $address->zip = 'NULL';
        $address->country = checkoutCountry::$GB;

        $requestCardSource = new RequestCardSource;
        $requestCardSource->name = $request->holder_name;
        $requestCardSource->number = $request->card_number;
        $requestCardSource->expiry_month = $request->expiry_month;
        $requestCardSource->expiry_year = $request->expiry_year;
        $requestCardSource->cvv = $request->cvv;
        $requestCardSource->billing_address = $address;
        $requestCardSource->phone = $phone;

        $customerRequest = new CustomerRequest;
        $customerRequest->email = $user->email;
        $customerRequest->name =  $user->first_name;
        
        $identification = new Identification();
        $identification->issuing_country = checkoutCountry::$GT;
        $identification->number = "1234";
        $identification->type = IdentificationType::$drivingLicence;
        
        $paymentIndividualSender = new PaymentIndividualSender();
        $paymentIndividualSender->fist_name = "FirstName";
        $paymentIndividualSender->last_name = "LastName";
        $paymentIndividualSender->address = $address;
        $paymentIndividualSender->identification = $identification;
        
        $request = new PaymentRequest();
        $request->source = $requestCardSource;
        $request->capture = true;
        $request->reference = "Business Story Payment";
        $request->amount = $storyprices->story_price;
        $request->currency = Currency::$USD;
        $request->customer = $customerRequest;
        $request->sender = $paymentIndividualSender;
        
        try {
            $response = $api->getPaymentsClient()->requestPayment($request);
            
            $save_checkout_details = new CheckOutPayment();
            $save_checkout_details->user_id  = Auth::id();
            $save_checkout_details->item_id  = $usetStory->id;
            $save_checkout_details->payment_id  = $response['id'];
            $save_checkout_details->action_id  = $response['action_id'];
            $save_checkout_details->amount  = $response['amount'];
            $save_checkout_details->status  = $response['approved'];
            $save_checkout_details->currency  = $response['currency'];
            $save_checkout_details->type  = 'story';
            $save_checkout_details->save();
            
            $updateId = UserStory::where('id', $usetStory->id)->first();
            $updateId->is_paid = '1';
            $updateId->save();
            $message = 'Payment SuccessFull.';   
            return SuccessResponse($message,200,'');
            // return redirect()->route('frontend.business.home.index')->with('success', __('Payment SuccessFull'));
        } catch (CheckoutApiException $e) {
            // API error
            $error_details = $e->error_details;
            $message = 'Payment UnsuccessFull.';   
            return SuccessResponse($message,200,'');
            // return redirect()->back()->with('danger', __('Payment UnsuccessFull'));
            $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;
        } catch (CheckoutAuthorizationException $e) {
            // Bad Invalid authorization
        }

        $message = 'Story Add Successfully.';
        return SuccessResponse($message, 200, $usetStory);
    }

    public function getStoryDetails(Request $request)
    {
        $inputData = $request->all();

        $header = $request->header('AuthorizationUser');
        $user_token = $request->header('authorization');

        if (empty($header)) {
            $message = 'Authorisation required';
            return InvalidResponse($message, 101);
        }

        $response = veriftyAPITokenData($header);
        $success = $response->original['success'];

        if (!$success) {
            return $response;
        }

        $validator = Validator::make($request->all(), [
            'story_id' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }

        $user_story_details = UserStory::where('id', $request->story_id)->first();

        if (empty($user_story_details)) {
            $message = "User story detail not found";
            return InvalidResponse($message, 101);
        }
        $message = 'Fetch user story detail successfully';
        return SuccessResponse($message, 200, $user_story_details);
    }

    public function storypreview(Request $request)
    {
        $user_token = $request->header('authorization');
        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        $usetStory = new storie_preview;
        $usetStory->user_id = $user_id;
        $usetStory->stories_id = $request->stories_id;
        $usetStory->is_preview = TRUE;
        $usetStory->save();
    }

    public function storyprice(Request $request)
    {
        $storyprices = StoryPrice::first();
        $message = 'Story Add Successfully.';
        return SuccessResponse($message, 200, $storyprices);
    }
}
