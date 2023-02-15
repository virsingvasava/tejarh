<?php

use App\Http\Controllers\Api\AdminSupportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\VerificationOtpController;

use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\Users\UsersRegisterController;
use App\Http\Controllers\Api\Users\UsersListController;
use App\Http\Controllers\Api\Users\UserItemsController;
use App\Http\Controllers\Api\Users\UserStoryController;
use App\Http\Controllers\Api\Users\OfferController;
use App\Http\Controllers\Api\Users\FilterController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\Users\BoostItemController;
use App\Http\Controllers\Api\Users\OrderSummaryController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\CountryStateCityController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\BusinessUsers\BusinessUsersRegisterController;
use App\Http\Controllers\Api\BusinessUsers\BusinessUsersProfileController;
use App\Http\Controllers\Api\BusinessUsers\BranchController;
use App\Http\Controllers\Api\BusinessUsers\StoreTypeController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ChangesPasswordController;
use App\Http\Controllers\Api\citiesController;
use App\Http\Controllers\Api\ForgotpasswordController;
use App\Http\Controllers\Api\CommonController;
use App\Http\Controllers\Api\countriesController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PayoutController;
use App\Http\Controllers\Api\postItemController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SellerProfileController;
use App\Http\Controllers\Api\sliderController;
use App\Http\Controllers\Api\statesController;
use App\Http\Controllers\Api\UserAddressController;
use App\Http\Controllers\Api\UserChatController;
use App\Http\Controllers\Api\Users\ProfileController;
use App\Http\Controllers\Api\UserSupportController;
use App\Http\Controllers\Api\walletController;
use App\Http\Controllers\Frontend\Business\BusinessProfileController;
use App\Models\Cart;
use App\Models\Item;
use App\Models\ReviewRatings;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersDeliveryAddress;
use Database\Seeders\Users;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Login and Verify for both user */
// Route::post('register', [RegisterController::class, 'register']);
// Route::post('verify_otp', [RegisterController::class, 'verify_otp']);
// Route::post('resend_otp', [RegisterController::class, 'resend_otp']);

/* Users List */
Route::post('/users/user_register', [UsersRegisterController::class, 'user_register']);

Route::post('/users/get-users-list', [UsersListController::class, 'getUsersList']);
Route::post('/users/get-user-story', [UserStoryController::class, 'getUserStory']);
Route::post('/users/get-user-story-details', [UserStoryController::class, 'getUserStoryDetails']);
// Route::post('/users/get-follower', [UserStoryController::class, 'getFollower']);
// Route::post('/users/get-following', [UserStoryController::class, 'getFollowing']);
Route::post('/users/get-bought', [UserStoryController::class, 'getBought']);
Route::post('/users/get-sold', [UserStoryController::class, 'getSold']);
Route::post('/users/uploading-story', [UserStoryController::class, 'uploadingStory']);
Route::post('/users/story-preview', [UserStoryController::class, 'storyPreview']);

Route::post('/users/verified-profile-by', [UserStoryController::class, 'verifiedProfileBy']);
Route::post('/users/verified-seller-badge', [UserStoryController::class, 'verifiedSellerBadge']);
Route::post('/users/items-from-this-seller', [UserStoryController::class, 'itemsFromThisSeller']);
Route::post('/users/verified-your-account', [UserStoryController::class, 'verifiedYourAccount']);

// Route::post('/users/post-an-item', [UserItemsController::class, 'postAnItem']);
Route::post('/users/items-on-sell', [UserItemsController::class, 'ItemsOnSell']);
Route::post('/users/items-sold', [UserItemsController::class, 'ItemsSold']);
Route::post('/users/items-buy', [UserItemsController::class, 'ItemsBuy']);
Route::post('/users/items-booked', [UserItemsController::class, 'ItemsBooked']);
Route::post('/users/on-Item-customer-review', [UserItemsController::class, 'onItemCustomerReview']);
Route::post('/users/make-an-offer', [OfferController::class, 'makeAnOffer']);
Route::post('/users/hold-an-offer', [OfferController::class, 'holdAnOffer']);
Route::post('/users/offer-negotiate', [OfferController::class, 'offerNegotiate']);
Route::post('/users/offer-recieved', [OfferController::class, 'offerRecieved']);

Route::post('/users/filter-items', [FilterController::class, 'filterItems']);


Route::post('/users/boost-item-detail', [BoostItemController::class, 'boostItemDetail']);
Route::post('/users/boost-item-price', [BoostItemController::class, 'boostItemPrice']);

// Route::post('/users/order-summary', [OrderSummaryController::class, 'orderSummary']);
// Route::post('/users/my-orders', [OrderSummaryController::class, 'myOrders']);
// Route::post('/users/order-details', [OrderSummaryController::class, 'orderDetails']);
// Route::post('/users/return-item', [OrderSummaryController::class, 'returnItem']);

/* Business Users List */
Route::post('/business_users/register', [BusinessUsersRegisterController::class, 'register']);
Route::post('/business_users/update-profile', [BusinessUsersProfileController::class, 'updateProfile']);
Route::post('/business_users/profile-banner',[BusinessUsersProfileController::class, 'profilebanner']);
Route::post('/business_users/get-profile', [BusinessUsersProfileController::class, 'getProfile']);
Route::post('/business_users/get-store-type-list', [StoreTypeController::class, 'getStoreTypeList']);

/* Category List */
Route::post('get-category-list', [CategoryController::class, 'getCategoryList']);
Route::post('get-sub-category-list', [SubCategoryController::class, 'getSubCategoryList']);

Route::post('get-story-list', [StoryController::class, 'getStoryList']);
Route::post('add-story',[StoryController::class,'addStory']);
Route::post('get-story-details', [StoryController::class, 'getStoryDetails']);
Route::post('story-preview',[StoryController::class,'storypreview']);
Route::post('story-price',[StoryController::class,'storyprice']);
/* Login */
Route::post('login', [LoginController::class, 'login']);
Route::post('verify_otp', [VerificationOtpController::class, 'verify_otp']);
Route::post('resend_otp', [VerificationOtpController::class, 'resend_otp']);
Route::post('delete/user', [LoginController::class, 'userDelete']);

Route::post('verify_otp_without_auth', [LoginController::class, 'verify_otp_without_auth']);
Route::post('resend_otp_without_auth', [LoginController::class, 'resend_otp_without_auth']);
Route::post('auto_login', [LoginController::class, 'auto_login']);


Route::post('get-country-list', [CountryStateCityController::class, 'getCountryList']);
Route::post('get-state-list', [CountryStateCityController::class, 'getStateList']);
Route::post('get-city-list', [CountryStateCityController::class, 'getCityList']);
Route::post('get-country-code-list', [CountryStateCityController::class, 'getCountryCodeList']);

/* postItem*/
Route::post('get-brand',[postItemController::class,'getbrand']);
Route::post('get-attribute',[postItemController::class,'getattribute']);
Route::post('get-attribute-variants',[postItemController::class,'getattributevariants']);
Route::post('get-condition',[postItemController::class,'getcondition']);
Route::post('get-delivery-type',[postItemController::class,'getdeliverytype']);
Route::post('post-an-item', [postItemController::class, 'postAnItem']);
Route::post('get-post-item',[postItemController::class,'getpostitem']);
Route::post('update-post-item',[postItemController::class,'updatepostitem']);
Route::post('delete-post-item',[postItemController::class,'deletepostitem']);
Route::post('boost-item-price',[postItemController::class,'boostitemperice']);
Route::post('boost-item-payment',[postItemController::class,'boostitem']);


/* Forgot Password */
Route::post('forgot_password',  [ForgotpasswordController::class, 'forgot_password']);
Route::post('submit_reset_password', [ForgotpasswordController::class, 'password_submit']);
Route::post('check_otp',  [ForgotpasswordController::class, 'check_otp']);
Route::post('logout', [CommonController::class, 'logout']);

/* Profile */
Route::post('/users/update-profile', [ProfileController::class, 'updateProfile']);
Route::post('/users/profile-banner',[ProfileController::class, 'profilebanner']);
Route::post('/users/get-profile', [ProfileController::class, 'getProfile']);
Route::post('/users/update_location', [ProfileController::class, 'updateLocation']);




/* Seller-Profile */ 
Route::post('/Seller-Profile',[SellerProfileController::class,'SellerProfile']);
Route::post('/followers', [SellerProfileController::class, 'followers']);
Route::post('/unfollwer',[SellerProfileController::class, 'unfollower']);
Route::post('/follower-listing', [SellerProfileController::class, 'followerlisting']);
Route::post('/following-listing', [SellerProfileController::class, 'followinglisting']);
Route::post('/sold-list', [SellerProfileController::class, 'sold_details']);
Route::post('/bought-list', [SellerProfileController::class, 'bought_details']);


/* Post Items Collection */

Route::post('new-item-list', [ItemsController::class, 'newItemList']);
Route::post('promoted-item-list',[ItemsController::class,'promotedItemList']);
Route::post('recommendation-list', [ItemsController::class, 'recommendationList']);
Route::post('recommendation-post-detail', [ItemsController::class, 'recommendationPostDetail']);
Route::post('used-item-list', [ItemsController::class, 'usedItemList']);
Route::post('used-item-detail', [ItemsController::class, 'usedItemDetail']);
Route::post('unused-item-list', [ItemsController::class, 'unusedItemList']);
Route::post('unused-item-detail', [ItemsController::class, 'unusedItemDetail']);
Route::post('sub-category-item-list',[ItemsController::class, 'subcategoryItemList']);
Route::post('user-commission',[ItemsController::class,'usercommission']);
Route::post('business-commission',[ItemsController::class,'businesscommission']);
Route::post('Item-filter',[ItemsController::class,'Itemfilter']);


/* slider */
Route::post('slider',[sliderController::class,'slider']);

/* */
Route::post('get-country-list', [countriesController::class, 'getcountryList']);
Route::post('get-state-list', [statesController::class, 'getstateList']);
Route::post('get-city-list', [citiesController::class, 'getCityList']);

/* Change - Password*/ 
Route::post('change-password',[ChangesPasswordController::class,'changespassword']);

/* wishlist */ 
Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist']);
Route::post('/user-wishlist', [WishlistController::class, 'userWishlist']);
Route::post('/remove-from-wishlist', [WishlistController::class, 'removeFromWishlist']);


/* productLike */
Route::post('/add-to-like',[LikeController::class,'addTolike']);
Route::post('/user-like',[LikeController::class,'userlike']);
Route::post('/remove-from-like',[LikeController::class,'removelike']);


/* review */
Route::post('/add-product-review-rating',[ReviewController::class, 'addproductReviewRating']);
Route::post('/add-seller-review-rating',[ReviewController::class, 'addsellerReviewRating']);
Route::post('/product-reviewlisting',[ReviewController::class,'productReviewlisting']);
Route::post('/seller-reciewlisting',[ReviewController::class,'sellerReviewlisting']);

/*order */
Route::post('my-order',[OrderController::class,'myorder']);
Route::post('my-order-detail',[OrderController::class,'myorderdetail']);

/*cart*/ 
Route::post('add-to-cart',[CartController::class,'addTocart']);
Route::post('cart-listing',[CartController::class,'cartlisting']);
Route::post('update-quantity',[CartController::class,'updatequantity']);
Route::post('delete-cartlist',[CartController::class,'deletecartlist']);

/*addresss*/ 
Route::post('my-address',[UserAddressController::class,'myaddress']);
Route::post('my-address-listing',[UserAddressController::class,'myaddresslisting']);
Route::post('select-address',[UserAddressController::class,'selectaddress']);
Route::post('update-address',[UserAddressController::class,'updateaddress']);

/*wallet*/
 Route::post('Add-Wallet',[walletController::class,'Addwallet']);
 Route::post('wallt-list',[walletController::class,'walltlist']);

/*user-support*/
Route::post('user-suppoet-list',[UserSupportController::class,'suppoetlist']);  
Route::post('user-Add-support',[UserSupportController::class,'Addsupport']);
Route::post('user-Support-details',[UserSupportController::class,'Supportdetails']);
Route::post('user-Add-reply',[UserSupportController::class,'Addreply']);
Route::post('user-request-list',[UserSupportController::class,'requestlist']);
Route::post('user-request-details',[UserSupportController::class,'requestdetails']);


/*Admin-support*/ 
Route::post('suppoet-list',[AdminSupportController::class,'suppoetlist']);
Route::post('Add-support',[AdminSupportController::class,'Addsupport']);
Route::post('Support-details',[AdminSupportController::class,'Supportdetails']);
Route::post('Add-reply',[AdminSupportController::class,'Addreply']);
Route::post('Support-Category',[AdminSupportController::class,'supportcat']);



/*website -chat*/
Route::post('/chat-user-images',[UserChatController::class,'useriamges']); 
