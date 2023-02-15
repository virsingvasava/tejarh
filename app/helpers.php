<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\User as UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

CONST ADMIN_ROLE = 1;
CONST API_ROLE = 2;
CONST USER_ROLE = 3;
CONST BUSINESS_ROLE = 4;
CONST MANAGER_ROLE = 5;
CONST STORE_BOYS_ROLE  = 6;
CONST STORE_ROLE  = 8;
CONST DELIVERY_BOY_ROLE = 7;

//order status
CONST ORDER_CREATE = 0;
CONST ORDER_PROCESSING = 1;
CONST ORDER_DISPATCH = 2;
CONST ORDER_CANCELED = 3;
CONST ORDER_DELIEVERED = 4;
CONST ORDER_RETURN = 5;
CONST ORDER_COMPLETED = 6;
CONST ORDER_RETURN_APPROVE = 7;
CONST ORDER_RETURN_DECLINE = 8;

/* Menu Type */
CONST SITE_LINKS = 1; 
CONST POPULAR_CITIES = 2;
CONST USEFUL_LINKS = 3;

/* Active & Inactive */
CONST ACTIVE = 1; 
CONST INACTIVE = 0;

//Business Flow Public Folder
CONST BUSINESS_PROFILE_FOLDER = 'assets/users'; 
CONST BUSINESS_BANNER_FOLDER = 'assets/banner';
CONST BUSINESS_ITEMS_POST_FOLDER = 'assets/post';
CONST BUSINESS_ASSETS_FOLDER = 'fronted/business_flow/assets';

//Users Flow Public Folder
CONST USERS_PROFILE_FOLDER = 'assets/users';
CONST USERS_SELLER_PROFILE_FOLDER = 'assets/users';
CONST USERS_BANNER_FOLDER = 'assets/banner';
CONST USERS_SELLER_BANNER_FOLDER = 'assets/banner';
CONST USERS_ITEMS_POST_FOLDER = 'assets/post';
CONST USERS_ASSETS_FOLDER = 'fronted/users_flow/assets';
CONST USERS_TICKET = 'assets/ticket';

CONST NEW_ITEMS = "New";
CONST USED_ITEMS = "Used";
CONST UNUSED_ITEMS = "Unused";
CONST TOP_DEALS_ITEMS = "Top Deals";
CONST TRENDING_ITEMS = "Trending Items";
CONST RECOMMENDED_ITEMS = "Recommended Items";

function veriftyAPITokenData($header) 
{    
    try 
    {
        $authorization_cred = Crypt::decrypt($header);
        $expcred = explode('|', $authorization_cred);
        $apiuser = $expcred[0];
        $apipassword = $expcred[1];
    } 
    catch(\Exception $e) 
    {
        $message = "Invalid User Authentication";
        return InvalidResponse($message,101);
    }

    $user = UserModel::where('email', $apiuser)->where('role',API_ROLE)->first();
    if ($user && Hash::check($apipassword, $user->password)) 
    {
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Token valid',
            'data' => array(),
        ]);
    } 
    else 
    {
        $message = 'Invalid Token';
        return InvalidResponse($message,101);
    }
}

function SuccessResponse($message,$status_code,$data)
{
    return response()->json(['success' => true,
		'status_code' => $status_code,
		'message' => $message,
		'data' => $data
    ]);
}

function numberFormat($number)
{
    $number_data = number_format((float)$number, 2, '.', '');
    return $number_data;
}

function InvalidResponse($message,$status_code)
{
    return response()->json(['success' => false,
		'status_code' => $status_code,
		'message' => $message,
		'data' => array()
    ]);
}

function sendOtp($mobile_number,$otp){
    $mobile_number = '91'.$mobile_number;
    $message = env('MSG91_MESSAGE').' '.$otp;

    \LaravelMsg91::sendOtp($mobile_number, $otp, $message);

}

function generateRandomString($length)
{
	$randomString = '';
	$characters = '123456789';
	$characterLengths = strlen($characters);
	for($i=0; $i<$length;$i++)
	{
		$randomString .= $characters[rand(0,$characterLengths - 1)];
	}
	return $randomString;
}

function generateRandomToken($length)
{
	$randomString = '';
	$characters = 'ABCDEFGHIJKLMNOPQRSTUVWZY';
	$characterLengths = strlen($characters);
	for($i=0; $i<$length;$i++)
	{
		$randomString .= $characters[rand(0,$characterLengths - 1)];
	}
	return $randomString;
}

function sendPushNotification($title,$message,$topic)
{
    $url = 'https://fcm.googleapis.com/fcm/send';

    $notification = ['title' =>$title, 'body' => $message ];

    $server_key = 'AAAAAnNyTi8:APA91bGcG_yD4NmGkef1OK_7OeMJRnY-ByLHqDtDJxhRn5uODxMTYOkY8jW_FFZ9sHd43WHmXzFoUZr3QnsTood5TlXHPhBl2GZ-uj4MAcmcmpktvq3ISfw4d9UP5eOJrSxHq5jZul7M';

    $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

    $fcmNotification = [
        'to'  => $topic,
        'notification' => $notification,
        'data' => $extraNotificationData
    ];

    $fields = json_encode ( $fcmNotification );

    $headers = array (
        'Authorization: key=' .$server_key,
        'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
    echo $result;
    curl_close ( $ch );
}

function change_timezone_local($value,$timezone) {
    if($timezone == ''){
        $timezone = 'UTC';
    }
    return Carbon::createFromTimestamp(strtotime($value))->timezone($timezone)->toDateTimeString();
}

function get_current_timezone()
{
    //$ip = "189.240.194.147";  //$_SERVER['REMOTE_ADDR'];

    $ip = $_SERVER['REMOTE_ADDR'];
    $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
    $ipInfo = json_decode($ipInfo);

    if($ipInfo->status == 'fail'){
        $timezone = 'UTC';
    } else {
        $timezone = $ipInfo->timezone;  
    }
    return $timezone;
    //return 'Asia/Kolkata';
}

/**
 *
 * Get times as option-list.
 *
 * @return string List of times
 */
function get_working_hours_times ($default = '19:00', $interval = '+30 minutes') {

    $output = '';

    $current = strtotime('00:00');
    $end = strtotime('23:59');

    while ($current <= $end) {
        $time = date('H:i', $current);
        $sel = ($time == $default) ? ' selected' : '';

        $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A', $current) .'</option>';
        $current = strtotime($interval, $current);
    }

    return $output;
}

?>
