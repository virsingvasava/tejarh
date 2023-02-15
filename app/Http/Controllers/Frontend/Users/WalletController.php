<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use App\Models\cardDetails;
use App\Models\CheckOutPayment;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletUser;
use Checkout\Accounts\Identification;
use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use Checkout\CheckoutSdk;
use Checkout\Common\Country;
use Checkout\Common\Currency;
use Checkout\Common\CustomerRequest;
use Checkout\Common\Phone;
use Checkout\Environment;
use Checkout\Payments\Previous\Source\RequestCardSource;
use Checkout\Payments\Request\PaymentRequest;
use Checkout\Payments\Sender\IdentificationType;
use Checkout\Payments\Sender\PaymentIndividualSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function index()
    {
        $authId = Auth::user()->id;
        $user = User::where('id', $authId)->first();
        $userWalletTotal = Wallet::where('user_id', $authId)->first();
        if(!empty($userWalletTotal))
        {
            $totalMoney = $userWalletTotal->total_amount;
        }else{
            $totalMoney = 0;
        }
        $userWalletAmount = WalletUser::where('user_id', $authId)->where('is_paid', 0)->Latest('id')->first();
        if (!empty($userWalletAmount)) {
            $amount = $userWalletAmount['amount'];
            $walletId = $userWalletAmount['id'];
        } else {
            $amount = 0;
            $walletId = 0;
        }
        $getData = WalletUser::where('user_id', $authId)->orderBy('id', 'DESC')->get();
        // $getData = WalletUser::select(
        //     DB::raw("is_paid","status"),
        //     DB::raw("MONTHNAME(created_at) as month_name")
        // )
        // ->whereYear('created_at', date('Y'))
        // ->groupBy('month_name')
        // ->get()
        // ->toArray();
        $monthArray = array(
            "1" => "January", "2" => "February", "3" => "March", "4" => "April",
            "5" => "May", "6" => "June", "7" => "July", "8" => "August",
            "9" => "September", "10" => "October", "11" => "November", "12" => "December",
        );
        return view('frontend.users.wallet.index',compact('user','totalMoney','amount','monthArray','walletId','getData'));
    }

    public function store(Request $request)
    {
        $authId = Auth::user()->id;
        $createWallet = new WalletUser;
        $createWallet->user_id = $authId;
        $createWallet->amount = $request->amount;
        $createWallet->status = FALSE;
        $createWallet->is_paid = FALSE;
        $createWallet->save();

        return response()->json(['success' => 'Amount Added successfully.']);
    }

    public function wallet_paid(Request $request)
    {
        $authId = Auth::user()->id;

        $save_token = new cardDetails;
        $save_token->user_id      = $authId;
        $save_token->holder_name  = $request->holder_name;
        $save_token->card_number  = $request->card_number;
        $save_token->expiry_month = $request->cardExpMonth;
        $save_token->expiry_year  = $request->cardExpYear;
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

        $card_details = cardDetails::where('user_id',$authId)->Latest('id')->first();

        $user = User::where('id', $authId)->first();

        $userWallet = WalletUser::where('user_id',$authId)->Latest('id')->first();
        $totalAmount = $userWallet['amount'];

        $phone = new Phone();
        $phone->country_code = $user->phone_code;
        $phone->number = $user->phone_number;

        $requestCardSource = new RequestCardSource();
        $requestCardSource->name = $card_details->holder_name;
        $requestCardSource->number = $card_details->card_number;
        $requestCardSource->expiry_year = $card_details->expiry_year;
        $requestCardSource->expiry_month = $card_details->expiry_month;
        $requestCardSource->cvv = $card_details->cvv;
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
        $request->amount = $totalAmount;
        $request->currency = Currency::$USD;
        $request->customer = $customerRequest;
        $request->sender = $paymentIndividualSender;

        try {
            $response = $api->getPaymentsClient()->requestPayment($request);

            $save_checkout_details = new CheckOutPayment;
            $save_checkout_details->user_id     = Auth::id();
            $save_checkout_details->item_id     = "";
            $save_checkout_details->payment_id  = $response['id'];
            $save_checkout_details->action_id   = $response['action_id'];
            $save_checkout_details->amount      = $response['amount'];
            $save_checkout_details->status      = $response['approved'];
            $save_checkout_details->currency    = $response['currency'];
            $save_checkout_details->type        = 'wallet-payment';
            $save_checkout_details->save();

            $updateUserWallet = WalletUser::where('user_id',$authId)->Latest('id')->first();
            $updateUserWallet->is_paid = TRUE;
            $updateUserWallet->status = TRUE;
            $updateUserWallet->save();

            $checkWallet = Wallet::where('user_id',$authId)->first();
            if(!empty($checkWallet))
            {
                $updateWallet = Wallet::where('user_id',$authId)->first();
                $updateWallet->total_amount += $response['amount'];
                $updateWallet->save();
            }
            else{
                $createWallet = new Wallet;
                $createWallet->user_id = $authId;
                $createWallet->total_amount = $response['amount'];
                $createWallet->save();
            }
            cardDetails::where('user_id', $authId)->delete();
            return redirect()->back()->with('success', __('Payment SuccessFull'));

        } catch (CheckoutApiException $e) {
            // API error
            $error_details = $e->error_details;
            return redirect()->back()->with('danger', __('Payment UnsuccessFull'));
            $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;
        } catch (CheckoutAuthorizationException $e) {
            // Bad Invalid authorization
        }
    }
}
