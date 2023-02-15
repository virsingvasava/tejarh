<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\cardDetails;
use App\Models\User;
use App\Models\WalletUser;
use Illuminate\Http\Request;
use App\Models\CheckOutPayment;
use App\Models\Wallet;
use Checkout\CheckoutSdk;
use Checkout\Common\Phone;
use Checkout\Environment;
use Checkout\Common\CustomerRequest;
use Checkout\Payments\Previous\Source\RequestCardSource;
use Checkout\Payments\Sender\PaymentIndividualSender;
use Checkout\Payments\Sender\Identification;
use Checkout\Payments\Sender\IdentificationType;
use Checkout\Payments\Request\PaymentRequest;
use Checkout\Common\Currency;
use Checkout\Common\Country;
use Tymon\JWTAuth\Facades\JWTAuth;
use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use Validator;

class walletController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function Addwallet(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;

        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'holder_name' => 'required',
            'card_number' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            'cvv' => 'required',

        ]);
        if ($validator->fails()) {
            $message = $validator->messages()->first();
            return InvalidResponse($message, 101);
        }
        $createWallet = new WalletUser;
        $createWallet->user_id = $user_id;
        $createWallet->amount = $request->amount;
        $createWallet->status = FALSE;
        $createWallet->is_paid = FALSE;
        $createWallet->save();

        $save_token = new cardDetails;
        $save_token->user_id      = $user_id;
        $save_token->holder_name  = $request->holder_name;
        $save_token->card_number  = $request->card_number;
        $save_token->expiry_month = $request->expiry_month;
        $save_token->expiry_year  = $request->expiry_year;
        $save_token->cvv          = $request->cvv;
        $save_token->save();

        $api = CheckoutSdk::builder()->staticKeys()
            ->environment(Environment::sandbox())
            ->secretKey(env('CHECKOUT_SECRET_KEY'))
            ->build();

        $api = CheckoutSdk::builder()->oAuth()
            ->clientCredentials(env('CHECKOUT_ACCESS_KEY_ID'), env('CHECKOUT_ACCESS_KEY_VALUE'))
            ->scopes(['gateway'])
            ->environment(Environment::sandbox())
            ->build();

        $user = User::where('id', $user_id)->first();

        $phone = new Phone;
        $phone->country_code = $user->phone_code;
        $phone->number = $user->phone_number;

        $requestCardSource = new RequestCardSource;
        $requestCardSource->name = $request->holder_name;
        $requestCardSource->number = $request->card_number;
        $requestCardSource->expiry_year = $request->expiry_year;
        $requestCardSource->expiry_month = $request->expiry_month;
        $requestCardSource->cvv = $request->cvv;
        $requestCardSource->billing_address = "";
        $requestCardSource->phone = $phone;

        $customerRequest = new CustomerRequest();
        $customerRequest->email = $user->email;
        $customerRequest->name =  $user->first_name;

        $identification = new Identification();
        $identification->issuing_country = Country::$GT;
        $identification->number = "1234";
        $identification->type = IdentificationType::$drivingLicence;

        $paymentIndividualSender = new PaymentIndividualSender();
        $paymentIndividualSender->fist_name = $user->first_name;
        $paymentIndividualSender->last_name = "LastName";
        $paymentIndividualSender->address = "";
        $paymentIndividualSender->identification = $identification;

        $request = new PaymentRequest();
        $request->source = $requestCardSource;
        $request->capture = true;
        $request->reference = "Wallet-Payment";
        $request->amount = $createWallet->amount;
        $request->currency = Currency::$SAR;
        $request->customer = $customerRequest;
        $request->sender = $paymentIndividualSender;

        try {
            $response = $api->getPaymentsClient()->requestPayment($request);

            $save_checkout_details = new CheckOutPayment;
            $save_checkout_details->user_id     = $user_id;
            $save_checkout_details->item_id     = "";
            $save_checkout_details->payment_id  = $response['id'];
            $save_checkout_details->action_id   = $response['action_id'];
            $save_checkout_details->amount      = $response['amount'];
            $save_checkout_details->status      = $response['approved'];
            $save_checkout_details->currency    = $response['currency'];
            $save_checkout_details->type        = 'wallet-payment';
            $save_checkout_details->save();

            $updateUserWallet = WalletUser::where('user_id',$user_id)->Latest('id')->first();
            $updateUserWallet->is_paid = TRUE;
            $updateUserWallet->status = TRUE;
            $updateUserWallet->save();

            $checkWallet = Wallet::where('user_id',$user_id)->first();
            if(!empty($checkWallet))
            {
                $updateWallet = Wallet::where('user_id',$user_id)->first();
                $updateWallet->total_amount += $response['amount'];
                $updateWallet->save();
            }
            else{
                $createWallet = new Wallet;
                $createWallet->user_id = $user_id;
                $createWallet->total_amount = $response['amount'];
                $createWallet->save();
            }
            cardDetails::where('user_id', $user_id)->delete();
            $message = 'Payment Successfully.';   
            return SuccessResponse($message,200,'');
            // return redirect()->back()->with('success', __('Payment SuccessFull'));

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
    }

    public function walltlist(Request $request)
    {
        $user_token = $request->header('authorization');

        $jwt_user = JWTAuth::parseToken()->authenticate($user_token);
        $user_id = $jwt_user->id;
        $userWalletTotal = Wallet::where('user_id', $user_id)->first();
        if(!empty($userWalletTotal))
        {
            $totalMoney = $userWalletTotal->total_amount;
        }else{
            $totalMoney = 0;
        }
        $getData = WalletUser::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        $message = 'Total payment.';   
        return SuccessResponse($message,200,[$totalMoney,$getData]);
    }
}
