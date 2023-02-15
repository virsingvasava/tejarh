
<?php

/* Admin side */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BusinessUserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\ForgotpasswordController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\SiteLinksController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ConditionController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PopularCityController;
use App\Http\Controllers\Admin\UsefulLinksController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FaqsCategoryController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PaymentHistoryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ShipModeController;
use App\Http\Controllers\Admin\StoreTypeController;
use App\Http\Controllers\Admin\CustomerSupportController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\StoryPriceController;
use App\Http\Controllers\Admin\VerifiedAccountController;
use App\Http\Controllers\Admin\AdminroleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AppNotificationController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributesVariantController;
use App\Http\Controllers\Admin\DeliveryTypeController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\EmailLogsController;
use App\Http\Controllers\Admin\ShortBannerController;
use App\Http\Controllers\Admin\SupportCategoryController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\UserTicketController as AdminUserTicketController;
use App\Http\Controllers\Admin\WhyUseController;
use App\Http\Controllers\Admin\WholesaleGeneralController;

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MyCheckOutController;

// use App\Http\Controllers\WhyuseController;
// use App\Http\Controllers\WholesaleGeneralController;
// use App\Http\Controllers\ShortBannerController;

use App\Http\Controllers\Frontend\FrontUserController;
use App\Http\Controllers\Frontend\IndexController;

/* Users Flow */
use App\Http\Controllers\Frontend\Users\SiteController;
use App\Http\Controllers\Frontend\Users\MakeAnOfferController as UserMakeAnOffer;
use App\Http\Controllers\Frontend\Users\ProfileController as UserProfile;
use App\Http\Controllers\Frontend\Users\PostItemsController;
use App\Http\Controllers\Frontend\Users\BoostItemsController as UserBoostItems;
use App\Http\Controllers\Frontend\Users\AddressController;
use App\Http\Controllers\Frontend\Users\OrdersDetailsController as OrdersDetails;
use App\Http\Controllers\Frontend\Users\MyOrdersController as MyOrders;
use App\Http\Controllers\Frontend\Users\MyItemsController as MyItems;
use App\Http\Controllers\Frontend\Users\WalletController;
use App\Http\Controllers\Frontend\Users\WishlistController as UserWishlist;
use App\Http\Controllers\Frontend\Users\ProfileSellerController as UserProfileSeller;
use App\Http\Controllers\Frontend\Users\UserItemController;
use App\Http\Controllers\Frontend\Users\PaymentController;
use App\Http\Controllers\Frontend\Users\SiteLinksController as UserSiteLinks;
use App\Http\Controllers\Frontend\Users\PromotedItemsController as PromotedItems;
use App\Http\Controllers\Frontend\Users\NewItemsController as NewItems;
use App\Http\Controllers\Frontend\Users\UsedItemsController as UsedItems;
use App\Http\Controllers\Frontend\Users\UnusedItemsController as UnusedItems;
use App\Http\Controllers\Frontend\Users\UserLikeController;
use App\Http\Controllers\Frontend\Users\ProductCategoryController;
use App\Http\Controllers\Frontend\Users\SearchProductController;
use App\Http\Controllers\Frontend\Users\ContactUsController as ContactUsForUsers;
use App\Http\Controllers\Frontend\Users\BlogController as BlogForUsers;
use App\Http\Controllers\Frontend\Users\ProductReviewsController;
use App\Http\Controllers\Frontend\Users\ImagesBulkController;
use App\Http\Controllers\Frontend\Users\ProductBulkController;
use App\Http\Controllers\Frontend\Users\SellerReviewsRatingsController as SellerReviewUsers;
use App\Http\Controllers\Frontend\Users\SubscriptionController as UserSubscribe;
use App\Http\Controllers\Frontend\Users\CustomerOrder;


/* Business Flow */
use App\Http\Controllers\Frontend\Business\RegisterController;
use App\Http\Controllers\Frontend\Business\AddressController as BusinessAddress;
use App\Http\Controllers\Frontend\Business\HomeController;
use App\Http\Controllers\Frontend\Business\BusinessDashboardController;
use App\Http\Controllers\Frontend\Business\BusinessProfileController;
use App\Http\Controllers\Frontend\Business\MyOrdersController;
use App\Http\Controllers\Frontend\Business\MyItemsController;
use App\Http\Controllers\Frontend\Business\BusinessWalletController;
use App\Http\Controllers\Frontend\Business\AddStoreController;
use App\Http\Controllers\Frontend\Business\AddRolesController;
use App\Http\Controllers\Frontend\Business\ItemPostController;
use App\Http\Controllers\Frontend\Business\ProfileSellerController;
use App\Http\Controllers\Frontend\Business\BoostItemsController;
use App\Http\Controllers\Frontend\Business\NewItemsController;
use App\Http\Controllers\Frontend\Business\PromotedItemsController;
use App\Http\Controllers\Frontend\Business\UnusedItemsController;
use App\Http\Controllers\Frontend\Business\UsedItemsController;
use App\Http\Controllers\Frontend\Business\TopDealsController;
use App\Http\Controllers\Frontend\Business\TrendingItemsController;
use App\Http\Controllers\Frontend\Business\RecommendedItemsController;
use App\Http\Controllers\Frontend\Business\WishlistController;
use App\Http\Controllers\Frontend\Business\ReturnPolicyController;
use App\Http\Controllers\Frontend\Business\OrderSummaryPaymentController;
use App\Http\Controllers\Frontend\Business\OrderDetailsController;
use App\Http\Controllers\Frontend\Business\AcceptOrderController;
use App\Http\Controllers\Frontend\Business\B_ImagesBulkController;
use App\Http\Controllers\Frontend\Business\B_ProductBulkController;
use App\Http\Controllers\Frontend\Business\CancelOrderController;
use App\Http\Controllers\Frontend\Business\B_ProfileController;
use App\Http\Controllers\Frontend\Business\MakeAnOfferController;
use App\Http\Controllers\Frontend\Business\HoldAnOfferController;
use App\Http\Controllers\Frontend\Business\SiteLinksController as BusinessSiteLinks;
use App\Http\Controllers\Frontend\Business\UserfullLinksController as BusinessUserfullLinks;
use App\Http\Controllers\Frontend\Business\BusinessReportController;
use App\Http\Controllers\Frontend\Business\SalesReportController as Testcontroller;
use App\Http\Controllers\Frontend\Business\UserLikeController as BusinessUserLike;
use App\Http\Controllers\Frontend\Business\ProductCategoryController as BusinessProductCategory;
use App\Http\Controllers\Frontend\Business\ContactUsController as ContactUsForBusiness;
use App\Http\Controllers\Frontend\Business\BlogController as BlogForBusiness;
use App\Http\Controllers\Frontend\Business\BusinessPermissionController;
use App\Http\Controllers\Frontend\Business\FollowUnfollowController;
use App\Http\Controllers\Frontend\Business\ProductReviewsController as ProductReviews;
use App\Http\Controllers\Frontend\Business\BusinessRoleController;
use App\Http\Controllers\Frontend\Business\BusinessUserController as BusinessBusinessUserController;
use App\Http\Controllers\Frontend\Business\ChatController as BusinessChatController;
use App\Http\Controllers\Frontend\Business\SellerReviewsRatingsController as SellerReviewBusiness;
use App\Http\Controllers\Frontend\Business\CustomerOrder as BusinessCustomerOrder;
use App\Http\Controllers\Frontend\Business\SubscriptionController as BusinessSubscribe;
use App\Http\Controllers\Frontend\Business\TicketController as BusinessTicketController;
use App\Http\Controllers\Frontend\Business\UserTicketController as BusinessUserTicketController;
use App\Http\Controllers\Frontend\Users\ChatController;
use App\Http\Controllers\Frontend\Users\TicketController;
use App\Http\Controllers\Frontend\Users\UserTicketController;
use App\Models\permission;
use App\Models\Image;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
 Super admin web route start here..
*/



Route::group(['middleware' => 'guest'], function ($router) {

    Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/submit', [LoginController::class, 'submit'])->name('login.submit');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register/post', [LoginController::class, 'register_post'])->name('register.post');
    Route::get('/forgot-password', [ForgotpasswordController::class, 'index'])->name('forgot_password');
    Route::post('/forgot-password/submit', [ForgotpasswordController::class, 'submit'])->name('forgot_password.submit');
    Route::get('/reset-password/{token}', [ForgotpasswordController::class, 'reset_password'])->name('auth.reset_password');
    Route::post('/password/submit', [ForgotpasswordController::class, 'password_submit'])->name('password.submit');
});

Route::get('/lang/{locally}', [LanguageController::class, 'index'])->name('lang');
Route::post('/lang-post', [LanguageController::class, 'post'])->name('lang.post');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');

    Route::group(['prefix' => 'cms'], function ($router) {
        Route::get('/', [CmsController::class, 'index'])->name('admin.cms.index');
        Route::get('/create', [CmsController::class, 'create'])->name('admin.cms.create');
        Route::post('/store', [CmsController::class, 'store'])->name('admin.cms.store');
        Route::post('/destroy', [CmsController::class, 'destroy'])->name('admin.cms.destroy');
        Route::get('/view/{id}',  [CmsController::class, 'view'])->name('admin.cms.view');
        Route::get('/edit/{id}',  [CmsController::class, 'edit'])->name('admin.cms.edit');
        Route::post('/update', [CmsController::class, 'update'])->name('admin.cms.update');
        Route::post('/cms_status_update', [CmsController::class, 'cms_status_update'])->name('admin.cms.cms_status_update');
    });

    Route::group(['prefix' => 'user'], function ($router) {
        Route::get('/',  [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/view/{id}', [UserController::class, 'view'])->name('admin.user.view');
        Route::post('/update', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('/edit/{id}',  [UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/destroy', [UserController::class, 'destroy'])->name('admin.user.destroy');
        Route::post('/status', [UserController::class, 'admin_users_status_update'])->name('admin.user.admin_users_status_update');
        Route::post('/phone-verified', [UserController::class, 'phoneVerified'])->name('admin.user.phone_verified');
        Route::post('/membersince-verified', [UserController::class, 'membersinceVerified'])->name('admin.user.member_since_verified');
        Route::post('/quickshipper-verified', [UserController::class, 'quickshipperVerified'])->name('admin.user.quick_shipper_verified');
        Route::post('/reliable-verified', [UserController::class, 'reliableVerified'])->name('admin.user.reliable_verified');
        Route::post('/user_status_update', [UserController::class, 'user_status_update'])->name('admin.user.user_status_update');
    });

    Route::group(['prefix' => 'business-user'], function ($router) {
        Route::get('/',  [BusinessUserController::class, 'index'])->name('admin.business_users.index');
        Route::get('/view/{id}', [BusinessUserController::class, 'view'])->name('admin.business_users.view');
        Route::post('/update', [BusinessUserController::class, 'update'])->name('admin.business_users.update');
        Route::get('/edit/{id}',  [BusinessUserController::class, 'edit'])->name('admin.business_users.edit');
        Route::post('/destroy', [BusinessUserController::class, 'destroy'])->name('admin.business_users.destroy');
        Route::post('/phone-verified', [BusinessUserController::class, 'phoneVerified'])->name('admin.business_users.phone_verified');
        Route::post('/cr-number-verified', [BusinessUserController::class, 'crNumberVerified'])->name('admin.business_users.cr_number_verified');
        Route::post('/cr-upload-verified', [BusinessUserController::class, 'crUploadVerified'])->name('admin.business_users.cr_upload_verified');
        Route::post('/membersince-verified', [BusinessUserController::class, 'membersinceVerified'])->name('admin.business_users.member_since_verified');
        Route::post('/quickshipper-verified', [BusinessUserController::class, 'quickshipperVerified'])->name('admin.business_users.quick_shipper_verified');
        Route::post('/reliable-verified', [BusinessUserController::class, 'reliableVerified'])->name('admin.business_users.reliable_verified');

        Route::get('/upload-cr-download/{upload_cr}', [BusinessUserController::class, 'crDownload'])->name('admin.business_users.upload_cr_download');
        Route::post('/cr-maroof-number-verified', [BusinessUserController::class, 'crMaroofNoVerified'])->name('admin.business_users.cr_maroof_number_verified');
        Route::get('/upload-manroof-download/{upload_maroof}', [BusinessUserController::class, 'manroofDownload'])->name('admin.business_users.upload_manroof_download');
        Route::post('/upload-maroofr-verified', [BusinessUserController::class, 'uploadMaroofrVerified'])->name('admin.business_users.upload_maroofr_verified');
        Route::post('/vat-number-verified', [BusinessUserController::class, 'vatNoVerified'])->name('admin.business_users.vat_number_verified');
        Route::get('/vat-certificate-download/{vat_certificate_file}', [BusinessUserController::class, 'vatCertificateDownload'])->name('admin.business_users.vat_certificate_download');
        Route::post('/vat-certificate-verified', [BusinessUserController::class, 'vatCertificateVerified'])->name('admin.business_users.vat_certificate_verified');
        Route::get('/ministry-of-government-certificate-download/{ministry_of_government}', [BusinessUserController::class, 'MOGCertificateDownload'])->name('admin.business_users.ministry_of_government_download');
        Route::post('/mog-certificate-verified', [BusinessUserController::class, 'mogCertificateVerified'])->name('admin.business_users.mog_certificate_verified');
        Route::post('/business_user_status_update', [BusinessUserController::class, 'business_user_status_update'])->name('admin.business_users.business_user_status_update');
    });

    Route::group(['prefix' => 'profile'], function ($router) {
        Route::get('/',  [ProfileController::class, 'profile'])->name('admin.profile.index');
        // Route::get('/index',  [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::post('/update',  [ProfileController::class, 'profile_update'])->name('admin.profile.update');
    });

    Route::group(['prefix' => 'change-password'], function ($router) {
        Route::get('/',  [ProfileController::class, 'change_password'])->name('admin.change_password');
        Route::post('/update',  [ProfileController::class, 'change_password_submit'])->name('admin.change_password.update');
    });

    Route::group(['prefix' => 'support'], function ($router) {
        Route::get('/',  [SupportController::class, 'index'])->name('admin.support.index');
        Route::post('/submit',  [SupportController::class, 'support_update'])->name('admin.support.support_update');
    });

    Route::group(['prefix' => 'site-links'], function ($router) {
        Route::get('/', [SiteLinksController::class, 'index'])->name('admin.menus.site_link.index');
        Route::get('/create', [SiteLinksController::class, 'create'])->name('admin.menus.site_link.create');
        Route::post('/store', [SiteLinksController::class, 'store'])->name('admin.menus.site_link.store');
        Route::post('/destroy', [SiteLinksController::class, 'destroy'])->name('admin.menus.site_link.destroy');
        Route::get('/view/{id}',  [SiteLinksController::class, 'view'])->name('admin.menus.site_link.view');
        Route::get('/edit/{id}',  [SiteLinksController::class, 'edit'])->name('admin.menus.site_link.edit');
        Route::post('/update', [SiteLinksController::class, 'update'])->name('admin.menus.site_link.update');
        Route::post('/menu_status_update', [SiteLinksController::class, 'menu_status_update'])->name('admin.menus.site_link.menu_status_update');
    });

    Route::group(['prefix' => 'popular-city'], function ($router) {
        Route::get('/', [PopularCityController::class, 'index'])->name('admin.menus.popular_city.index');
        Route::get('/create', [PopularCityController::class, 'create'])->name('admin.menus.popular_city.create');
        Route::post('/store', [PopularCityController::class, 'store'])->name('admin.menus.popular_city.store');
        Route::post('/destroy', [PopularCityController::class, 'destroy'])->name('admin.menus.popular_city.destroy');
        Route::get('/view/{id}',  [PopularCityController::class, 'view'])->name('admin.menus.popular_city.view');
        Route::get('/edit/{id}',  [PopularCityController::class, 'edit'])->name('admin.menus.popular_city.edit');
        Route::post('/update', [PopularCityController::class, 'update'])->name('admin.menus.popular_city.update');
        Route::post('/menu_status_update', [PopularCityController::class, 'menu_status_update'])->name('admin.menus.popular_city.menu_status_update');
    });

    Route::group(['prefix' => 'useful-links'], function ($router) {
        Route::get('/', [UsefulLinksController::class, 'index'])->name('admin.menus.useful_link.index');
        Route::get('/create', [UsefulLinksController::class, 'create'])->name('admin.menus.useful_link.create');
        Route::post('/store', [UsefulLinksController::class, 'store'])->name('admin.menus.useful_link.store');
        Route::post('/destroy', [UsefulLinksController::class, 'destroy'])->name('admin.menus.useful_link.destroy');
        Route::get('/view/{id}',  [UsefulLinksController::class, 'view'])->name('admin.menus.useful_link.view');
        Route::get('/edit/{id}',  [UsefulLinksController::class, 'edit'])->name('admin.menus.useful_link.edit');
        Route::post('/update', [UsefulLinksController::class, 'update'])->name('admin.menus.useful_link.update');
        Route::post('/menu_status_update', [UsefulLinksController::class, 'menu_status_update'])->name('admin.menus.useful_link.menu_status_update');
    });

    Route::group(['prefix' => 'category'], function ($router) {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::post('/destroy', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::get('/view/{id}',  [CategoryController::class, 'view'])->name('admin.category.view');
        Route::get('/edit/{id}',  [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/update', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::post('/category_status_update', [CategoryController::class, 'category_status_update'])->name('admin.category.category_status_update');
    });

    Route::group(['prefix' => 'sub-category'], function ($router) {
        Route::get('/', [SubCategoryController::class, 'index'])->name('admin.sub_category.index');
        Route::get('/create', [SubCategoryController::class, 'create'])->name('admin.sub_category.create');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('admin.sub_category.store');
        Route::post('/destroy', [SubCategoryController::class, 'destroy'])->name('admin.sub_category.destroy');
        Route::get('/view/{id}',  [SubCategoryController::class, 'view'])->name('admin.sub_category.view');
        Route::get('/edit/{id}',  [SubCategoryController::class, 'edit'])->name('admin.sub_category.edit');
        Route::post('/update', [SubCategoryController::class, 'update'])->name('admin.sub_category.update');
        Route::post('/sub_category_status_update', [SubCategoryController::class, 'sub_category_status_update'])->name('admin.sub_category.sub_category_status_update');
    });

    Route::group(['prefix' => 'brand'], function ($router) {
        Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index');
        Route::get('/create', [BrandController::class, 'create'])->name('admin.brand.create');
        Route::post('/store', [BrandController::class, 'store'])->name('admin.brand.store');
        Route::post('/destroy', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
        Route::get('/view/{id}',  [BrandController::class, 'view'])->name('admin.brand.view');
        Route::get('/edit/{id}',  [BrandController::class, 'edit'])->name('admin.brand.edit');
        Route::post('/update', [BrandController::class, 'update'])->name('admin.brand.update');
        Route::post('/sub-categories', [BrandController::class, 'subCategories'])->name('admin.brand.subCategories');
        Route::post('/brand_status_update', [BrandController::class, 'brand_status_update'])->name('admin.brand.brand_status_update');
    });

    Route::group(['prefix' => 'condition'], function ($router) {
        Route::get('/', [ConditionController::class, 'index'])->name('admin.condition.index');
        Route::get('/create', [ConditionController::class, 'create'])->name('admin.condition.create');
        Route::post('/store', [ConditionController::class, 'store'])->name('admin.condition.store');
        Route::post('/destroy', [ConditionController::class, 'destroy'])->name('admin.condition.destroy');
        Route::get('/view/{id}',  [ConditionController::class, 'view'])->name('admin.condition.view');
        Route::get('/edit/{id}',  [ConditionController::class, 'edit'])->name('admin.condition.edit');
        Route::post('/update', [ConditionController::class, 'update'])->name('admin.condition.update');
        Route::post('/condition_status_update', [ConditionController::class, 'condition_status_update'])->name('admin.condition.condition_status_update');
    });

    Route::group(['prefix' => 'store-type'], function ($router) {
        Route::get('/', [StoreTypeController::class, 'index'])->name('admin.store_type.index');
        Route::get('/create', [StoreTypeController::class, 'create'])->name('admin.store_type.create');
        Route::post('/store', [StoreTypeController::class, 'store'])->name('admin.store_type.store');
        Route::post('/destroy', [StoreTypeController::class, 'destroy'])->name('admin.store_type.destroy');
        Route::get('/view/{id}',  [StoreTypeController::class, 'view'])->name('admin.store_type.view');
        Route::get('/edit/{id}',  [StoreTypeController::class, 'edit'])->name('admin.store_type.edit');
        Route::post('/update', [StoreTypeController::class, 'update'])->name('admin.store_type.update');
        Route::post('/store_type_status_update', [StoreTypeController::class, 'store_type_status_update'])->name('admin.store_type.store_type_status_update');
    });

    Route::group(['prefix' => 'delivery-type'], function ($router) {
        Route::get('/', [DeliveryTypeController::class, 'index'])->name('admin.delivery_type.index');
        Route::get('/create', [DeliveryTypeController::class, 'create'])->name('admin.delivery_type.create');
        Route::post('/store', [DeliveryTypeController::class, 'store'])->name('admin.delivery_type.store');
        Route::post('/destroy', [DeliveryTypeController::class, 'destroy'])->name('admin.delivery_type.destroy');
        Route::get('/view/{id}',  [DeliveryTypeController::class, 'view'])->name('admin.delivery_type.view');
        Route::get('/edit/{id}',  [DeliveryTypeController::class, 'edit'])->name('admin.delivery_type.edit');
        Route::post('/update', [DeliveryTypeController::class, 'update'])->name('admin.delivery_type.update');
        Route::post('/delivery_type_status_update', [DeliveryTypeController::class, 'delivery_type_status_update'])->name('admin.delivery_type.delivery_type_status_update');
    });

    Route::group(['prefix' => 'ship-mode'], function ($router) {
        Route::get('/', [ShipModeController::class, 'index'])->name('admin.ship_mode.index');
        Route::get('/create', [ShipModeController::class, 'create'])->name('admin.ship_mode.create');
        Route::post('/store', [ShipModeController::class, 'store'])->name('admin.ship_mode.store');
        Route::post('/destroy', [ShipModeController::class, 'destroy'])->name('admin.ship_mode.destroy');
        Route::get('/view/{id}',  [ShipModeController::class, 'view'])->name('admin.ship_mode.view');
        Route::get('/edit/{id}',  [ShipModeController::class, 'edit'])->name('admin.ship_mode.edit');
        Route::post('/update', [ShipModeController::class, 'update'])->name('admin.ship_mode.update');
        Route::post('/ship_mode_status_update', [ShipModeController::class, 'ship_mode_status_update'])->name('admin.ship_mode.ship_mode_status_update');
    });

    Route::group(['prefix' => 'branch'], function ($router) {
        Route::get('/', [BranchController::class, 'index'])->name('admin.branch.index');
        Route::get('/create', [BranchController::class, 'create'])->name('admin.branch.create');
        Route::post('/store', [BranchController::class, 'store'])->name('admin.branch.store');
        Route::post('/destroy', [BranchController::class, 'destroy'])->name('admin.branch.destroy');
        Route::get('/view/{id}',  [BranchController::class, 'view'])->name('admin.branch.view');
        Route::get('/edit/{id}',  [BranchController::class, 'edit'])->name('admin.branch.edit');
        Route::post('/update', [BranchController::class, 'update'])->name('admin.branch.update');
        Route::post('/branch_status_update', [BranchController::class, 'branch_status_update'])->name('admin.branch.branch_status_update');
    });

    Route::group(['prefix' => 'slider'], function ($router) {
        Route::get('/', [SliderController::class, 'index'])->name('admin.slider.index');
        Route::get('/create', [SliderController::class, 'create'])->name('admin.slider.create');
        Route::post('/store', [SliderController::class, 'store'])->name('admin.slider.store');
        Route::post('/destroy', [SliderController::class, 'destroy'])->name('admin.slider.destroy');
        Route::get('/view/{id}',  [SliderController::class, 'view'])->name('admin.slider.view');
        Route::get('/edit/{id}',  [SliderController::class, 'edit'])->name('admin.slider.edit');
        Route::post('/update', [SliderController::class, 'update'])->name('admin.slider.update');
        Route::post('/slider_status_update', [SliderController::class, 'slider_status_update'])->name('admin.slider.slider_status_update');
    });

    Route::group(['prefix' => 'subscription'], function ($router) {
        Route::get('/', [SubscriptionController::class, 'index'])->name('admin.subscription.index');
        Route::get('/create', [SubscriptionController::class, 'create'])->name('admin.subscription.create');
        Route::post('/store', [SubscriptionController::class, 'store'])->name('admin.subscription.store');
        Route::post('/status-update', [SubscriptionController::class, 'subscription_status_update'])->name('admin.subscription.subscription_status_update');
    });

    Route::group(['prefix' => 'email-logs'], function ($router) {
        Route::get('/', [EmailLogsController::class, 'index'])->name('admin.email_logs.index');
    });

    Route::group(['prefix' => 'location'], function ($router) {

        /* Country */
        Route::get('/country', [LocationController::class, 'index'])->name('admin.location.country.index');
        Route::get('/country/create', [LocationController::class, 'create'])->name('admin.location.country.create');
        Route::post('/country/store', [LocationController::class, 'store'])->name('admin.location.country.store');
        Route::post('/destroy', [LocationController::class, 'destroy'])->name('admin.location.country.destroy');
        Route::get('/country/view/{id}',  [LocationController::class, 'view'])->name('admin.location.country.view');
        Route::get('/country/edit/{id}',  [LocationController::class, 'edit'])->name('admin.location.country.edit');
        Route::post('/country/update', [LocationController::class, 'update'])->name('admin.location.country.update');
        Route::post('/country_status_update', [LocationController::class, 'country_status_update'])->name('admin.location.country.country_status_update');

        /* State */
        Route::get('/state', [LocationController::class, 'state'])->name('admin.location.state.index');
        Route::get('/state/create', [LocationController::class, 'create_state'])->name('admin.location.state.create');
        Route::post('/state/store', [LocationController::class, 'store_state'])->name('admin.location.state.store_state');
        Route::get('/state/edit_state/{id}',  [LocationController::class, 'edit_state'])->name('admin.location.state.edit_state');
        Route::post('/state/update_state', [LocationController::class, 'update_state'])->name('admin.location.state.update_state');
        Route::get('/state/view_state/{id}',  [LocationController::class, 'view_state'])->name('admin.location.state.view_state');
        Route::post('/destroy_state', [LocationController::class, 'destroy_state'])->name('admin.location.state.destroy_state');
        Route::post('/state_status_update', [LocationController::class, 'state_status_update'])->name('admin.location.state.state_status_update');

        /* Cities */
        Route::get('/city', [LocationController::class, 'city'])->name('admin.location.city.index');
        Route::get('/city/create', [LocationController::class, 'create_city'])->name('admin.location.city.create');
        Route::post('/city/store', [LocationController::class, 'store_city'])->name('admin.location.city.store_city');
        Route::get('/city/edit_city/{id}',  [LocationController::class, 'edit_city'])->name('admin.location.city.edit_city');
        Route::post('/city/update_city', [LocationController::class, 'update_city'])->name('admin.location.city.update_city');
        Route::get('/city/view_city/{id}',  [LocationController::class, 'view_city'])->name('admin.location.city.view_city');
        Route::post('/destroy_city', [LocationController::class, 'destroy_city'])->name('admin.location.city.destroy_city');
        Route::post('/city_status_update', [LocationController::class, 'city_status_update'])->name('admin.location.city.city_status_update');
        Route::post('/state_listing', [LocationController::class, 'state_listing'])->name('admin.location.city.state_listing');
    });


    Route::group(['prefix' => 'product'], function ($router) {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::post('/destroy', [ProductController::class, 'destroy'])->name('admin.product.destroy');
        Route::get('/view/{id}',  [ProductController::class, 'view'])->name('admin.product.view');
        Route::get('/edit/{id}',  [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/update', [ProductController::class, 'update'])->name('admin.product.update');
        Route::post('/product_status_update', [ProductController::class, 'product_status_update'])->name('admin.product.product_status_update');
        Route::post('/productImport', [ProductController::class, 'productImport'])->name('admin.product.productImport');
        Route::post('/sub_category_listing', [ProductController::class, 'sub_category_listing'])->name('admin.product.sub_category_listing');
        Route::post('/attribute_listingt', [ProductController::class, 'attribute_listing'])->name('admin.product.attribute_listing');
        Route::post('/attribute_variant', [ProductController::class, 'attribute_variant_listing'])->name('admin.product.attribute_variant_listing');
        Route::post('/brand_listing', [ProductController::class, 'brand_listing'])->name('admin.product.brand_listing');
        Route::post('/condition_listing', [ProductController::class, 'condition_listing'])->name('admin.product.condition_listing');
        Route::post('/import', [ProductController::class, 'import'])->name('admin.product.import');
        Route::get('/export', [ProductController::class, 'export'])->name('admin.product.export');
    });

    Route::group(['prefix' => 'faq'], function ($router) {
        Route::get('/', [FaqController::class, 'index'])->name('admin.faqs.faq.index');
        Route::get('/create', [FaqController::class, 'create'])->name('admin.faqs.faq.create');
        Route::post('/store', [FaqController::class, 'store'])->name('admin.faqs.faq.store');
        Route::post('/destroy', [FaqController::class, 'destroy'])->name('admin.faqs.faq.destroy');
        Route::get('/view/{id}',  [FaqController::class, 'view'])->name('admin.faqs.faq.view');
        Route::get('/edit/{id}',  [FaqController::class, 'edit'])->name('admin.faqs.faq.edit');
        Route::post('/update', [FaqController::class, 'update'])->name('admin.faqs.faq.update');
        Route::post('/faq_status_update', [FaqController::class, 'faq_status_update'])->name('admin.faqs.faq.faq_status_update');
    });


    Route::group(['prefix' => 'faqs-category'], function ($router) {
        Route::get('/', [FaqsCategoryController::class, 'index'])->name('admin.faqs.faqs_category.index');
        Route::get('/create', [FaqsCategoryController::class, 'create'])->name('admin.faqs.faqs_category.create');
        Route::post('/store', [FaqsCategoryController::class, 'store'])->name('admin.faqs.faqs_category.store');
        Route::post('/destroy', [FaqsCategoryController::class, 'destroy'])->name('admin.faqs.faqs_category.destroy');
        Route::get('/view/{id}',  [FaqsCategoryController::class, 'view'])->name('admin.faqs.faqs_category.view');
        Route::get('/edit/{id}',  [FaqsCategoryController::class, 'edit'])->name('admin.faqs.faqs_category.edit');
        Route::post('/update', [FaqsCategoryController::class, 'update'])->name('admin.faqs.faqs_category.update');
        Route::post('/faq_category_status_update', [FaqsCategoryController::class, 'faq_category_status_update'])->name('admin.faqs.faqs_category.faq_category_status_update');
    });


    Route::group(['prefix' => 'story'], function ($router) {
        Route::get('/', [StoryController::class, 'index'])->name('admin.story.index');
        Route::post('/destroy', [StoryController::class, 'destroy'])->name('admin.story.destroy');
        Route::get('/view/{id}',  [StoryController::class, 'view'])->name('admin.story.view');
        Route::post('/story_status_update', [StoryController::class, 'story_status_update'])->name('admin.story.story_status_update');
    });

    Route::group(['prefix' => 'orders'], function ($router) {
        Route::get('/', [OrdersController::class, 'index'])->name('admin.order.index');
        Route::post('/destroy', [OrdersController::class, 'destroy'])->name('admin.order.destroy');
        Route::get('/view/{id}',  [OrdersController::class, 'view'])->name('admin.order.view');
        Route::post('/order_status_update', [OrdersController::class, 'order_status_update'])->name('admin.order.order_status_update');
    });

    Route::group(['prefix' => 'ticket'], function ($router) {
        Route::get('/', [AdminTicketController::class, 'index'])->name('admin.ticket.index');
        Route::get('/view/{id}', [AdminTicketController::class, 'view'])->name('admin.ticket.view');
        Route::post('reply', [AdminTicketController::class, 'reply'])->name('admin.ticket.reply');
        Route::post('/status-update', [AdminTicketController::class, 'status_update'])->name('admin.ticket.status_update');
    });

    Route::group(['prefix' => 'user-ticket'], function ($router) {
        Route::get('/', [AdminUserTicketController::class, 'index'])->name('admin.user-ticket.index');
        Route::get('/view/{id}', [AdminUserTicketController::class, 'view'])->name('admin.user-ticket.view');
        Route::post('/status-update', [AdminUserTicketController::class, 'status_update'])->name('admin.user-ticket.status_update');
    });

    Route::group(['prefix' => 'app-notification'], function ($router) {
        Route::get('/', [AppNotificationController::class, 'index'])->name('admin.app-notification.index');
        Route::get('/create', [AppNotificationController::class, 'create'])->name('admin.app-notification.create');
        Route::post('/store', [AppNotificationController::class, 'store'])->name('admin.app-notification.store');
        Route::post('/destroy', [AppNotificationController::class, 'destroy'])->name('admin.app-notification.destroy');
        Route::get('/broad-cast-notification', [AppNotificationController::class, 'broad_cast_notification'])->name('admin.app-notification.broad_cast_notification');
        Route::get('/broad-cast-create', [AppNotificationController::class, 'broad_cast_create'])->name('admin.app-notification.broad_cast_create');
        Route::post('/broad-cast-individual-store', [AppNotificationController::class, 'broad_cast_individual_store'])->name('admin.app-notification.broad_cast_individual_store');
        Route::post('/broad-cast-group-store', [AppNotificationController::class, 'broad_cast_group_store'])->name('admin.app-notification.broad_cast_group_store');
        Route::post('/broad-cast-all-store', [AppNotificationController::class, 'broad_cast_all_store'])->name('admin.app-notification.broad_cast_all_store');
    });

    Route::group(['prefix' => 'payment-history'], function ($router) {
        Route::get('/', [PaymentHistoryController::class, 'index'])->name('admin.payment.index');
        Route::post('/destroy', [PaymentHistoryController::class, 'destroy'])->name('admin.payment.destroy');
        Route::get('/view/{id}',  [PaymentHistoryController::class, 'view'])->name('admin.payment.view');
        Route::post('/payment_status_update', [PaymentHistoryController::class, 'payment_status_update'])->name('admin.payment.payment_status_update');
    });

    Route::group(['prefix' => 'report'], function ($router) {
        Route::get('/', [ReportController::class, 'index'])->name('admin.report.sales.index');
        Route::post('/destroy', [ReportController::class, 'destroy'])->name('admin.report.sales.destroy');
        Route::post('/report_status_update', [ReportController::class, 'report_status_update'])->name('admin.report.sales.report_status_update');
    });

    Route::group(['prefix' => 'commission'], function ($router) {
        Route::get('/', [CommissionController::class, 'index'])->name('admin.commission.index');
        Route::get('/create', [CommissionController::class, 'create'])->name('admin.commission.create');
        Route::post('/store', [CommissionController::class, 'store'])->name('admin.commission.store');
        Route::post('/destroy', [CommissionController::class, 'destroy'])->name('admin.commission.destroy');
        Route::get('/view/{id}',  [CommissionController::class, 'view'])->name('admin.commission.view');
        Route::get('/edit/{id}',  [CommissionController::class, 'edit'])->name('admin.commission.edit');
        Route::post('/update', [CommissionController::class, 'update'])->name('admin.commission.update');
        Route::post('/commission_status_update', [CommissionController::class, 'commission_status_update'])->name('admin.commission.commission_status_update');
        Route::post('/commission_update', [CommissionController::class, 'commission_update'])->name('admin.commission.commission_update');
    });

    Route::group(['prefix' => 'story-price'], function ($router) {
        Route::get('/', [StoryPriceController::class, 'index'])->name('admin.story-price.index');
        Route::post('/story_price_update', [StoryPriceController::class, 'story_price_update'])->name('admin.story-price.story_price_update');
    });

    Route::group(['prefix' => 'support'], function ($router) {
        Route::get('/', [SupportController::class, 'index'])->name('admin.support.settings');
        Route::post('/submit', [SupportController::class, 'support_update'])->name('admin.support.support_update');
    });

    Route::group(['prefix' => 'role'], function ($router) {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::post('/destroy', [RoleController::class, 'destroy'])->name('admin.role.destroy');
        Route::get('/view/{id}',  [RoleController::class, 'view'])->name('admin.role.view');
        Route::get('/edit/{id}',  [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('/update', [RoleController::class, 'update'])->name('admin.role.update');
        Route::post('/role_status_update', [RoleController::class, 'role_status_update'])->name('admin.role.role_status_update');
        Route::post('/role_update', [RoleController::class, 'role_update'])->name('admin.role.role_update');
    });

    Route::group(['prefix' => 'verified-account'], function ($router) {
        Route::get('/', [VerifiedAccountController::class, 'index'])->name('admin.verified_account.index');
        Route::post('/destroy', [VerifiedAccountController::class, 'destroy'])->name('admin.verified_account.destroy');
        Route::get('/view/{id}',  [VerifiedAccountController::class, 'view'])->name('admin.verified_account.view');
        Route::post('/payment_status_update', [VerifiedAccountController::class, 'payment_status_update'])->name('admin.verified_account.payment_status_update');
    });

    Route::group(['prefix' => 'why-use'], function ($router) {
        Route::get('/', [WhyUseController::class, 'index'])->name('admin.why_use.index');
        Route::get('/create', [WhyUseController::class, 'create'])->name('admin.why_use.create');
        Route::post('/store', [WhyUseController::class, 'store'])->name('admin.why_use.store');
        Route::post('/destroy', [WhyUseController::class, 'destroy'])->name('admin.why_use.destroy');
        Route::get('/view/{id}',  [WhyUseController::class, 'view'])->name('admin.why_use.view');
        Route::get('/edit/{id}',  [WhyUseController::class, 'edit'])->name('admin.why_use.edit');
        Route::post('/update', [WhyUseController::class, 'update'])->name('admin.why_use.update');
        Route::post('/why_use_status_update', [WhyUseController::class, 'general_status_update'])->name('admin.why_use.general_status_update');
    });

    Route::group(['prefix' => 'wholesale_general'], function ($router) {
        Route::get('/', [WholesaleGeneralController::class, 'index'])->name('admin.wholesale_general.index');
        Route::get('/create', [WholesaleGeneralController::class, 'create'])->name('admin.wholesale_general.create');
        Route::post('/store', [WholesaleGeneralController::class, 'store'])->name('admin.wholesale_general.store');
        Route::post('/destroy', [WholesaleGeneralController::class, 'destroy'])->name('admin.wholesale_general.destroy');
        Route::get('/view/{id}',  [WholesaleGeneralController::class, 'view'])->name('admin.wholesale_general.view');
        Route::get('/edit/{id}',  [WholesaleGeneralController::class, 'edit'])->name('admin.wholesale_general.edit');
        Route::post('/update', [WholesaleGeneralController::class, 'update'])->name('admin.wholesale_general.update');
        Route::post('/wholesale_general_status_update', [WholesaleGeneralController::class, 'wholesale_general_status_update'])
            ->name('admin.wholesale_general.wholesale_general_status_update');
    });

    Route::group(['prefix' => 'short_banner'], function ($router) {
        Route::get('/', [ShortBannerController::class, 'index'])->name('admin.short_banner.index');
        Route::get('/create', [ShortBannerController::class, 'create'])->name('admin.short_banner.create');
        Route::post('/store', [ShortBannerController::class, 'store'])->name('admin.short_banner.store');
        Route::post('/destroy', [ShortBannerController::class, 'destroy'])->name('admin.short_banner.destroy');
        Route::get('/view/{id}',  [ShortBannerController::class, 'view'])->name('admin.short_banner.view');
        Route::get('/edit/{id}',  [ShortBannerController::class, 'edit'])->name('admin.short_banner.edit');
        Route::post('/update', [ShortBannerController::class, 'update'])->name('admin.short_banner.update');
        Route::post('/short_banner_status_update', [ShortBannerController::class, 'short_banner_status_update'])
            ->name('admin.short_banner.short_banner_status_update');
    });


    Route::group(['prefix' => 'customer-support'], function ($router) {
        Route::get('/', [CustomerSupportController::class, 'index'])->name('admin.customer_support.index');
        Route::post('/destroy', [CustomerSupportController::class, 'destroy'])->name('admin.customer_support.destroy');
    });

    Route::group(['prefix' => 'blog'], function ($router) {
        Route::get('/', [BlogController::class, 'index'])->name('admin.blog.index');
        Route::get('/create', [BlogController::class, 'create'])->name('admin.blog.create');
        Route::post('/store', [BlogController::class, 'store'])->name('admin.blog.store');
        Route::post('/destroy', [BlogController::class, 'destroy'])->name('admin.blog.destroy');
        Route::get('/view/{id}',  [BlogController::class, 'view'])->name('admin.blog.view');
        Route::get('/edit/{id}',  [BlogController::class, 'edit'])->name('admin.blog.edit');
        Route::post('/update', [BlogController::class, 'update'])->name('admin.blog.update');
        Route::post('/blog_status_update', [BlogController::class, 'blog_status_update'])->name('admin.blog.blog_status_update');
        Route::post('/blog_update', [BlogController::class, 'blog_update'])->name('admin.blog.blog_update');
    });

    Route::group(['prefix' => 'permission'], function ($router) {
        Route::get('/', [PermissionController::class, 'index'])->name('admin.permission.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('admin.permission.create');
        Route::post('/store', [PermissionController::class, 'store'])->name('admin.permission.store');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
        Route::post('/update', [PermissionController::class, 'update'])->name('admin.permission.update');
    });

    Route::group(['prefix' => 'admin-role'], function ($router) {
        Route::get('/', [AdminroleController::class, 'index'])->name('admin.admin_role.index');
        Route::get('/create', [AdminroleController::class, 'create'])->name('admin.admin_role.create');
        Route::post('/store', [AdminroleController::class, 'store'])->name('admin.admin_role.store');
        Route::get('/edit/{id}', [AdminroleController::class, 'edit'])->name('admin.admin_role.edit');
        Route::post('/update', [AdminroleController::class, 'update'])->name('admin.admin_role.update');
    });

    Route::group(['prefix' => 'admin_user'], function ($router) {
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.admin_index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('admin.admin_user.create');
        Route::post('/store', [AdminUserController::class, 'store'])->name('admin.admin_user.store');
        Route::post('/destroy', [AdminUserController::class, 'destroy'])->name('admin.admin_user.destroy');
    });


    Route::group(['prefix' => 'attribute'], function ($router) {
        Route::get('/', [AttributeController::class, 'index'])->name('admin.attribute.index');
        Route::get('/create', [AttributeController::class, 'create'])->name('admin.attribute.create');
        Route::post('/store', [AttributeController::class, 'store'])->name('admin.attribute.store');
        Route::post('/attribute_status_update', [AttributeController::class, 'attribute_status_update'])->name('admin.attribute.attribute_status_update');
        Route::get('/view/{id}', [AttributeController::class, 'view'])->name('admin.attribute.view');
        Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('admin.attribute.edit');
        Route::post('/update', [AttributeController::class, 'update'])->name('admin.attribute.update');
        Route::post('/destroy', [AttributeController::class, 'destroy'])->name('admin.attribute.destroy');
    });

    Route::group(['prefix' => 'items-attributes-variant'], function ($router) {
        Route::get('/', [AttributesVariantController::class, 'index'])->name('admin.attribute_variant.index');
        Route::get('/create', [AttributesVariantController::class, 'create'])->name('admin.attribute_variant.create');
        Route::post('/store', [AttributesVariantController::class, 'store'])->name('admin.attribute_variant.store');
        Route::get('/edit/{id}', [AttributesVariantController::class, 'edit'])->name('admin.attribute_variant.edit');
        Route::post('/update', [AttributesVariantController::class, 'update'])->name('admin.attribute_variant.update');
        Route::post('/attribute_variant_status_update', [AttributesVariantController::class, 'attribute_variant_status_update'])->name('admin.attribute.attribute_variant_status_update');
    });

    Route::group(['prefix' => 'support-categories'], function ($router) {
        Route::get('/', [SupportCategoryController::class, 'index'])->name('admin.support-categories.index');
        Route::get('/create', [SupportCategoryController::class, 'create'])->name('admin.support-categories.create');
        Route::post('/store', [SupportCategoryController::class, 'store'])->name('admin.support-categories.store');
        Route::get('/edit/{id}', [SupportCategoryController::class, 'edit'])->name('admin.support-categories.edit');
        Route::post('/update', [SupportCategoryController::class, 'update'])->name('admin.support-categories.update');
        Route::post('/destroy', [SupportCategoryController::class, 'destroy'])->name('admin.support-categories.destroy');
        Route::post('/status-update', [SupportCategoryController::class, 'status_update'])->name('admin.support-categories.status_update');
    });
});


/* Fronted route start here */
Route::get('/', [SiteController::class, 'index'])->name('frontend.users.site.index');

Route::group(['middleware' => 'guest'], function ($router) {
    Route::post('/user-resetpassword', [FrontUserController::class, 'UserResetpassword'])->name('front.resetpassword');
    Route::group(['prefix' => 'user'], function ($router) {
        Route::post('/forgot-password', [SiteController::class, 'forgot_password'])->name('frontend.users.site.forgot_password');
        Route::post('/verify-user', [SiteController::class, 'verify_user_otp'])->name('frontend.users.site.verify_user_otp');
        Route::post('/resend-otp', [SiteController::class, 'resend_otp'])->name('frontend.users.site.resend_otp');
        Route::post('/reset_password', [SiteController::class, 'reset_password'])->name('frontend.users.site.reset_password');
        Route::post('/reset-password', [SiteController::class, 'resetPassword'])->name('frontend.users.site.resetPassword');

    });
});


Route::group(['namespace' => 'Users'], function ($router) {

    Route::get('/', [SiteController::class, 'index'])->name('frontend.users.site.index');
    Route::get('/logout', [SiteController::class, 'logout'])->name('frontend.users.site.logout');

    Route::get('/search', [SiteController::class, 'home_search_bar'])->name('frontend.users.site.home_search_bar');
    Route::post('/check-username-email', [SiteController::class, 'checkUsernameEmail'])->name('frontend.users.site.checkUsernameEmail');

    Route::get('/chat', [ChatController::class, 'index'])->name('frontend.users.chat');
    
    Route::group(['prefix' => 'search-items'], function ($router) {
        Route::get('/{id}', [SearchProductController::class, 'index'])->name('frontend.users.search.index');
    });

    Route::group(['prefix' => 'user'], function ($router) {
        Route::post('/register', [SiteController::class, 'register'])->name('frontend.users.site.register');
        Route::post('/login', [SiteController::class, 'login'])->name('frontend.users.site.login');
        Route::post('/users-login', [SiteController::class, 'users_login'])->name('frontend.users.site.users_login');
        Route::post('/story', [SiteController::class, 'add_user_story'])->name('frontend.users.site.add_user_story');
        Route::get('/story_payment/{id}', [SiteController::class, 'story_payment'])->name('frontend.users.site.story_payment');
        Route::post('/Payment_successfull/{storyPriceId}',  [SiteController::class, 'payment_successfull'])->name('frontend.users.site.payment_successfull');
        Route::post('/support-query', [SiteController::class, 'storeSupportsMessage'])->name('frontend.users.site.storeSupportsMessage');
    });

    Route::post('/subscribe', [SiteController::class, 'subscribe_tejarh'])->name('frontend.users.site.subscribe_tejarh');

    Route::group(['prefix' => 'subscribe-user'], function ($router) {
        Route::post('/subscribe', [UserSubscribe::class, 'subscribe'])->name('frontend.users.subscribe.subscribe');
    });


    Route::group(['prefix' => 'profile'], function ($router) {
        Route::get('/', [UserProfile::class, 'index'])->name('frontend.users.profile.index');
        Route::get('address/', [UserProfile::class, 'UserAddress'])->name('frontend.users.profile.address');
        Route::get('/story_payment/{id}', [UserProfile::class, 'story_payment'])->name('frontend.users.profile.story_payment');
        Route::post('/payment_successfull/{storyPriceId}',  [UserProfile::class, 'payment_successfull'])->name('frontend.users.profile.payment_successfull');
        Route::post('add_address/', [UserProfile::class, 'add_address'])->name('frontend.users.profile.add_address');
        Route::post('update_address/{id}', [UserProfile::class, 'update_address'])->name('frontend.users.profile.update_address');
        Route::post('edit_profile/', [UserProfile::class, 'edit_profile'])->name('frontend.users.profile.edit_profile');
        Route::post('change_password/', [UserProfile::class, 'change_password'])->name('frontend.users.profile.change_password');
        Route::post('profile_banner/', [UserProfile::class, 'profile_banner'])->name('frontend.users.profile.profile_banner');
        Route::post('/post_removed', [UserProfile::class, 'post_removed'])->name('frontend.users.profile.post_removed');
        Route::get('/follower-details', [UserProfile::class, 'followerDetails'])->name('frontend.users.profile.follower-details');
        Route::get('/following-details', [UserProfile::class, 'followingDetails'])->name('frontend.users.profile.following-details');
        Route::get('/sold-list', [UserProfile::class, 'sold_details'])->name('frontend.users.profile.sold_details');
        Route::get('/bought-list', [UserProfile::class, 'bought_details'])->name('frontend.users.profile.bought_details');
    });

    Route::group(['prefix' => 'product-category'], function ($router) {
        Route::get('/{id}', [ProductCategoryController::class, 'index'])->name('frontend.users.product_category.index');
        Route::post('/user-product-category-filter', [ProductCategoryController::class, 'userSubCateFilter'])->name('frontend.users.product_category.userSubCateFilter');
        Route::get('/', [ProductCategoryController::class, 'search_data'])->name('frontend.users.product_category.search_data');
    });

    Route::group(['prefix' => 'wishlist'], function ($router) {
        Route::get('/', [UserWishlist::class, 'index'])->name('frontend.users.wishlist.index');
        Route::post('/add_to_wishlist', [UserWishlist::class, 'add_to_wishlist'])->name('frontend.users.wishlist.add_to_wishlist');
        Route::post('/remove_to_wishlist', [UserWishlist::class, 'remove_to_wishlist'])->name('frontend.users.wishlist.remove_to_wishlist');
        Route::post('/wishlist_removed', [UserWishlist::class, 'wishlist_removed'])->name('frontend.users.wishlist.wishlist_removed');
    });

    Route::group(['prefix' => 'likelist'], function ($router) {
        Route::get('/', [UserLikeController::class, 'index'])->name('frontend.users.likelist.index');
        Route::post('/likelist_removed', [UserLikeController::class, 'likelist_removed'])->name('frontend.users.likelist.likelist_removed');
    });

    Route::group(['prefix' => 'support'], function ($router) {
        Route::get('/', [TicketController::class, 'index'])->name('frontend.users.support.index');
        Route::post('/add-support', [TicketController::class, 'store'])->name('frontend.users.support.store');
        Route::get('/support-details/{id}', [TicketController::class, 'ticket_details'])->name('frontend.users.support.ticket_details');
        Route::post('/add-reply', [TicketController::class, 'add_reply'])->name('frontend.users.support.add_reply');
    });

    Route::group(['prefix' => 'user-support'], function ($router) {
        Route::get('/', [UserTicketController::class, 'index'])->name('frontend.users.user-support.index');
        Route::post('/add-support', [UserTicketController::class, 'store'])->name('frontend.users.user-support.store');
        Route::get('/support-details/{id}', [UserTicketController::class, 'ticket_details'])->name('frontend.users.user-support.ticket_details');
        Route::post('/add-reply', [UserTicketController::class, 'add_reply'])->name('frontend.users.user-support.add_reply');
        Route::get('/request-list', [UserTicketController::class, 'reaquested_list'])->name('frontend.users.user-support.reaquested_list');
        Route::get('/received-details/{id}', [UserTicketController::class, 'received_details'])->name('frontend.users.user-support.received_details');
    });

    Route::group(['prefix' => 'address'], function ($router) {
        Route::get('/', [AddressController::class, 'index'])->name('frontend.users.address.index');
        Route::get('/shipping-address/{id}', [AddressController::class, 'shipping_address'])->name('frontend.users.address.shipping_address');
    });

    Route::group(['prefix' => 'post-items'], function ($router) {
        Route::get('/', [PostItemsController::class, 'index'])->name('frontend.users.post-items.index');
        Route::post('/', [PostItemsController::class, 'store'])->name('frontend.users.post-items.store');

        Route::get('/edit/{id}',  [PostItemsController::class, 'edit'])->name('frontend.users.post-items.edit');
        Route::post('/update', [PostItemsController::class, 'update'])->name('frontend.users.post-items.update');

        Route::get('subcat/{id}', [PostItemsController::class, 'getSubCat'])->name('frontend.users.post-items.getSubCat');
        Route::get('brand/{id}', [PostItemsController::class, 'getBrand'])->name('frontend.users.post-items.getBrand');
        Route::post('get-attribute', [PostItemsController::class, 'getAttribute'])->name('frontend.users.post-items.getAttribute');
        Route::post('get-attribute-variants', [PostItemsController::class, 'getAttributevariants'])->name('frontend.users.post-items.getAttributevariants');
    });

    Route::group(['prefix' => 'userlike'], function ($router) {
        Route::post('/add_to_like', [UserLikeController::class, 'add_to_like'])->name('frontend.users.userlike.add_to_like');
    });

    Route::group(['prefix' => 'promoted-items'], function ($router) {
        Route::get('/index', [PromotedItems::class, 'index'])->name('frontend.users.promoted-items.index');
        Route::get('/item-details/{id}',  [PromotedItems::class, 'item_details'])->name('frontend.users.promoted-items.item_details');
    });

    Route::group(['prefix' => 'new-items'], function ($router) {
        Route::get('/index', [NewItems::class, 'index'])->name('frontend.users.new-items.index');
        Route::get('/item-details/{id}',  [NewItems::class, 'item_details'])->name('frontend.users.new-items.item_details');
        Route::get('/my-product/{id}', [NewItems::class, 'myproduct_details'])->name('frontend.users.new-items.product_details');
    });

    Route::group(['prefix' => 'used-items'], function ($router) {
        Route::get('/index', [UsedItems::class, 'index'])->name('frontend.users.used-items.index');
        Route::get('/item-details/{id}',  [UsedItems::class, 'item_details'])->name('frontend.users.used-items.item_details');
        Route::get('/my-product/{id}', [UsedItems::class, 'myproduct_details'])->name('frontend.users.used-items.product_details');
    });

    Route::group(['prefix' => 'unused-items'], function ($router) {
        Route::get('/index', [UnusedItems::class, 'index'])->name('frontend.users.unused-items.index');
        Route::get('/item-details/{id}',  [UnusedItems::class, 'item_details'])->name('frontend.users.unused-items.item_details');
        Route::get('/my-product/{id}', [UnusedItems::class, 'myproduct_details'])->name('frontend.users.unused-items.product_details');
    });

    Route::group(['prefix' => 'boost-items'], function ($router) {
        Route::get('/index', [UserBoostItems::class, 'index'])->name('frontend.users.boost-items.index');
        Route::get('/item-details/{id}',  [UserBoostItems::class, 'item_details'])->name('frontend.users.boost-items.item_details');
        Route::post('/boost_items_payment_details',  [UserBoostItems::class, 'boost_items_payment_details'])->name('frontend.users.boost-items.boost_items_payment_details');
        Route::get('/boost_items_payment/{id}',  [UserBoostItems::class, 'boost_items_payment'])->name('frontend.users.boost-items.boost_items_payment');
        Route::post('/boost_items_payment_info',  [UserBoostItems::class, 'boost_items_payment_info'])->name('frontend.users.boost-items.boost_items_payment_info');
    });

    Route::group(['prefix' => 'make-an-offer'], function ($router) {
        Route::post('/make-an-offer',  [UserMakeAnOffer::class, 'make_an_offer'])->name('frontend.users.make-an-offer.make_an_offer');
        Route::post('/make-an-offer-post',  [UserMakeAnOffer::class, 'make_an_offer_post'])->name('frontend.users.make-an-offer.make_an_offer_post');
    });

    Route::group(['prefix' => 'orders-management'], function ($router) {
        Route::get('/', [CustomerOrder::class, 'index'])->name('frontend.users.orders-sold.index');
        Route::post('/create-shipping', [CustomerOrder::class, 'create_shipping'])->name('frontend.users.orders-sold.create_shipping');
        Route::post('/order-filter', [CustomerOrder::class, 'orderFilter'])->name('frontend.users.orders-sold.orderFilter');
        Route::post('/last-30-days-order-filter', [CustomerOrder::class, 'last_30_DaysOrderFilter'])->name('frontend.users.orders-sold.last_30_DaysOrderFilter');
        Route::get('/order-return', [CustomerOrder::class, 'return_order'])->name('frontend.users.orders-sold.return_order');
        Route::post('/return-order-accept', [CustomerOrder::class, 'return_order_accept'])->name('frontend.users.orders-sold.return_order_accept');
        Route::post('/return-order-decline', [CustomerOrder::class, 'return_order_decline'])->name('frontend.users.orders-sold.return_order_decline');
    });

    Route::group(['prefix' => 'my-orders'], function ($router) {
        Route::get('/', [MyOrders::class, 'index'])->name('frontend.users.my-orders.index');
        Route::get('/filter_ajax', [MyOrders::class, 'filter_ajax'])->name('frontend.users.my-orders.filter_ajax');
        Route::post('/order-filter', [MyOrders::class, 'orderFilter'])->name('frontend.users.my-orders.orderFilter');
        Route::post('/last-30-days-order-filter', [MyOrders::class, 'last_30_DaysOrderFilter'])->name('frontend.users.my-orders.last_30_DaysOrderFilter');
        Route::get('/filter_date_ajax', [MyOrders::class, 'filter_date_ajax'])->name('frontend.users.my-orders.filter_date_ajax');
        Route::post('/review-post-user-details', [MyOrders::class, 'users_review_post_user_details'])->name('frontend.users.my-orders.users_review_post_user_details');
        Route::post('/review-post-store', [MyOrders::class, 'users_review_post_store'])->name('frontend.users.my-orders.users_review_post_store');
        Route::post('/retrive-reviews', [MyOrders::class, 'users_retrive_reviews'])->name('frontend.users.my-orders.users_retrive_reviews');
        Route::get('/track-orders/{id}', [MyOrders::class, 'track_orders'])->name('frontend.users.my-orders.track_orders');
        Route::post('/order-cancel', [MyOrders::class, 'order_cancel'])->name('frontend.users.my-orders.order_cancel');
        Route::post('/add-support', [MyOrders::class, 'store'])->name('frontend.users.my-orders.store');

    });

    Route::group(['prefix' => 'product-reviews'], function ($router) {
        Route::get('/', [ProductReviewsController::class, 'index'])->name('frontend.users.product-reviews.index');
        Route::get('/list-of-reviews/{id}',  [ProductReviewsController::class, 'reviews_details'])->name('frontend.users.product-reviews.reviews_details');
    });

    Route::group(['prefix' => 'seller-reviews'], function ($router) {
        Route::get('/', [SellerReviewUsers::class, 'index'])->name('frontend.users.seller-reviews.index');
        Route::get('/seller-reviews-details/{id}',  [SellerReviewUsers::class, 'seller_reviews_details'])->name('frontend.users.seller-reviews.seller_reviews_details');
        Route::post('/seller-review-post-store', [SellerReviewUsers::class, 'seller_review_post_store'])->name('frontend.users.seller-reviews.seller_review_post_store');
    });

    Route::group(['prefix' => 'my-items'], function ($router) {
        Route::get('/', [MyItems::class, 'index'])->name('frontend.users.my-items.index');
        Route::post('/item-filters', [MyItems::class, 'itemsFilterUser'])->name('frontend.users.my-items.itemsFilterUser');
        Route::post('/user-product-category-filter', [MyItems::class, 'userSubCateFilter'])->name('frontend.users.my-items.userSubCateFilter');
    });

    Route::group(['prefix' => 'wallet'], function ($router) {
        Route::get('/', [WalletController::class, 'index'])->name('frontend.users.wallet.index');
        Route::post('/wallet-store', [WalletController::class, 'store'])->name('frontend.users.wallet.store');
        Route::post('/wallet-paid', [WalletController::class, 'wallet_paid'])->name('frontend.users.wallet.wallet_paid');
    });

    Route::group(['prefix' => 'wishlist'], function ($router) {
        Route::get('/', [UserWishlist::class, 'index'])->name('frontend.users.wishlist.index');
    });

    Route::group(['prefix' => 'order-details'], function ($router) {
        Route::get('/', [OrdersDetails::class, 'index'])->name('frontend.users.order-details.index');
        Route::post('/accept-order', [OrdersDetails::class, 'accept_order'])->name('frontend.users.order-details.accept_order');
        Route::get('/checkout/{id}',  [OrdersDetails::class, 'checkout'])->name('frontend.users.order-details.checkout');
        Route::get('/checkout',  [OrdersDetails::class, 'checkout_empty'])->name('frontend.users.order-details.checkout_empty');
        Route::get('/remove-item/{id}',  [OrdersDetails::class, 'removedItem'])->name('frontend.users.order-details.removed-item');
        Route::get('/card-details/{id}',  [OrdersDetails::class, 'card_details'])->name('frontend.users.order-details.card_details');
        Route::post('/thankyou',  [OrdersDetails::class, 'thankyou'])->name('frontend.users.order-details.thankyou');
        Route::post('/order-placed',  [OrdersDetails::class, 'order_placed'])->name('frontend.users.order-details.order_placed');
        Route::post('/card-add',  [OrdersDetails::class, 'card_add'])->name('frontend.users.order-details.card_add');
        Route::post('/make_an_offer',  [OrdersDetails::class, 'make_an_offer'])->name('frontend.users.order-details.make_an_offer');
        Route::get('/order-details/{id}',  [OrdersDetails::class, 'order_details'])->name('frontend.users.order-details.order_details');
        Route::get('/download_invoice/{id}', [OrdersDetails::class, 'pdf_download_invoice'])->name('frontend.users.order-details.pdf_download_invoice');
        Route::post('/quantity-add-minus', [OrdersDetails::class, 'qty_add_minus'])->name('frontend.users.order-details.qty_add_minus');
        Route::post('/removed-items', [OrdersDetails::class, 'removedItems'])->name('frontend.users.order-details.removedItems');
        Route::post('/add-to-cart', [OrdersDetails::class, 'addToCart'])->name('frontend.users.order-details.addToCart');
        Route::get('/order-payment/{id}', [OrdersDetails::class, 'orderPaymentChoose'])->name('frontend.users.order-details.orderPaymentChoose');
        Route::get('/payment-cod', [OrdersDetails::class, 'orderPaymentCOD'])->name('frontend.users.order-details.orderPaymentCOD');
        Route::post('/order-payment-select', [OrdersDetails::class, 'orderPaymentSelect'])->name('frontend.users.order-details.orderPaymentSelect');
        Route::post('/payment-gpay', [OrdersDetails::class, 'orderPaymentgpay'])->name('frontend.users.order-details.orderPaymentgpay');
        Route::get('/order-successfull', [OrdersDetails::class, 'order_successfull'])->name('frontend.users.order-details.order_successfull');
        Route::get('/order-wallet', [OrdersDetails::class, 'order_wallet'])->name('frontend.users.order-details.order_wallet');
        Route::post('/order-return', [OrdersDetails::class, 'order_return'])->name('frontend.users.order-details.order_return');
    });

    Route::group(['prefix' => 'order-placed-successfully'], function ($router) {
        Route::get('/', [PaymentController::class, 'index'])->name('frontend.users.payment-success.index');
    });

    Route::group(['prefix' => 'order-summary-payment'], function ($router) {
        Route::get('/', [OrderSummaryPaymentController::class, 'index'])->name('frontend.users.order-summary-payment.index');
        Route::post('/payment_details', [OrderSummaryPaymentController::class, 'payment_details'])->name('frontend.users.order-summary-payment.payment_details');
    });

    Route::group(['prefix' => 'profile-seller'], function ($router) {
        Route::get('/{id}', [UserProfileSeller::class, 'index'])->name('frontend.users.profile-seller.index');
        Route::post('/followers', [UserProfileSeller::class, 'followers'])->name('frontend.users.profile-seller.followers');
    });

    Route::group(['prefix' => 'import-image'], function ($router) {
        Route::get('/', [ImagesBulkController::class, 'index'])->name('frontend.users.pages.import_images');
        Route::post('/store', [ImagesBulkController::class, 'store'])->name('frontend.users.pages.store');
        Route::post('/destroy', [ImagesBulkController::class, 'destroy'])->name('frontend.users.pages.destroy');
    });

    Route::group(['prefix' => 'import-product'], function ($router) {
        Route::post('/', [ProductBulkController::class, 'index'])->name('frontend.users.pages.importproduct.index');
        Route::post('/export', [ProductBulkController::class, 'sampleExport'])->name('frontend.users.pages.importproduct.export');
        Route::post('/import_parse', [ProductBulkController::class, 'parseImport'])->name('frontend.users.pages.importproduct.import_parse');
        Route::post('/import', [ProductBulkController::class, 'import'])->name('frontend.users.pages.importproduct.import');
    });

    Route::group(['prefix' => 'about-us'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'aboutUs'])->name('frontend.users.about-us.aboutUs');
    });

    Route::group(['prefix' => 'location'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'location'])->name('frontend.users.location.location');
    });

    Route::group(['prefix' => 'coupons-Offers'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'couponsOffers'])->name('frontend.users.coupons-Offers.couponsOffers');
    });

    Route::group(['prefix' => 'Contact-Us'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'contactUs'])->name('frontend.users.Contact-Us.contactUs');
    });

    Route::group(['prefix' => 'Careers'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'careers'])->name('frontend.users.Careers.careers');
    });

    Route::group(['prefix' => 'faq'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'faq'])->name('frontend.users.faq.faq');
    });

    Route::group(['prefix' => 'terms-condition'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'termsCondition'])->name('frontend.users.terms-condition.termsCondition');
    });

    Route::group(['prefix' => 'term-of-use'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'termsOfUse'])->name('frontend.users.term-of-use.termsOfUse');
    });

    Route::group(['prefix' => 'track-order'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'trackOrder'])->name('frontend.users.track-order.trackOrder');
    });

    Route::group(['prefix' => 'shipping'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'shipping'])->name('frontend.users.shipping.shipping');
    });

    Route::group(['prefix' => 'cancellation'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'cancellation'])->name('frontend.users.cancellation.cancellation');
    });

    Route::group(['prefix' => 'return'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'returnOrder'])->name('frontend.users.return.returnOrder');
    });

    Route::group(['prefix' => 'whitehat'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'whitehat'])->name('frontend.users.whitehat.whitehat');
    });

    Route::group(['prefix' => 'privacy-policy'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'privacyPolicy'])->name('frontend.users.privacy-policy.privacyPolicy');
    });

    Route::group(['prefix' => 'site-map'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'siteMap'])->name('frontend.users.site-map.siteMap');
    });

    Route::group(['prefix' => 'support-s'], function ($router) {
        Route::get('/', [UserSiteLinks::class, 'supportPage'])->name('frontend.users.support.supportPage');
    });

    Route::group(['prefix' => 'contact-us'], function ($router) {
        Route::post('/contact-us', [ContactUsForUsers::class, 'seedMessageForContactUs'])->name('frontend.users.contact-us.seedMessageForContactUs');
    });

    Route::group(['prefix' => 'blogs'], function ($router) {
        Route::get('/', [BlogForUsers::class, 'index'])->name('frontend.users.blogs.index');
        Route::get('/blog-details/{id}', [BlogForUsers::class, 'blog_details'])->name('frontend.users.blogs.blog_details');
    });
});

Route::group(['middleware' => 'auth', 'namespace' => 'Front'], function ($router) {

    Route::get('/product-detail', [FrontUserController::class, 'productdetail'])->name('product-detail');
    Route::get('/product-list', [FrontUserController::class, 'productlist'])->name('product-list');

    Route::get('/user/profile', [UserProfileController::class, 'UserProfile'])->name('user.profile');
});

Route::get('/social-media-share', [SocialShareButtonsController::class, 'ShareWidget']);

/* Business Flow  */

Route::group(['namespace' => 'Business', 'prefix' => 'business'], function ($router) {

    Route::get('/chat', [BusinessChatController::class, 'index'])->name('frontend.business.chat');

    Route::group(['prefix' => 'about-us'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'aboutUs'])->name('frontend.business.about-us.aboutUs');
    });

    Route::group(['prefix' => 'location'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'location'])->name('frontend.business.location.location');
    });

    Route::group(['prefix' => 'coupons-Offers'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'couponsOffers'])->name('frontend.business.coupons-Offers.couponsOffers');
    });

    Route::group(['prefix' => 'Contact-Us'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'contactUs'])->name('frontend.business.Contact-Us.contactUs');
    });

    Route::group(['prefix' => 'Careers'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'careers'])->name('frontend.business.Careers.careers');
    });

    Route::group(['prefix' => 'faq'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'faq'])->name('frontend.business.faq.faq');
    });

    Route::group(['prefix' => 'terms-condition'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'termsCondition'])->name('frontend.business.terms-condition.termsCondition');
    });

    Route::group(['prefix' => 'term-of-use'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'termsOfUse'])->name('frontend.business.term-of-use.termsOfUse');
    });

    Route::group(['prefix' => 'track-order'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'trackOrder'])->name('frontend.business.track-order.trackOrder');
    });

    Route::group(['prefix' => 'shipping'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'shipping'])->name('frontend.business.shipping.shipping');
    });

    Route::group(['prefix' => 'cancellation'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'cancellation'])->name('frontend.business.cancellation.cancellation');
    });

    Route::group(['prefix' => 'return'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'returnOrder'])->name('frontend.business.return.returnOrder');
    });

    Route::group(['prefix' => 'whitehat'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'whitehat'])->name('frontend.business.whitehat.whitehat');
    });

    Route::group(['prefix' => 'blog'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'blog'])->name('frontend.business.blog.blog');
    });

    Route::group(['prefix' => 'privacy-policy'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'privacyPolicy'])->name('frontend.business.privacy-policy.privacyPolicy');
    });

    Route::group(['prefix' => 'site-map'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'siteMap'])->name('frontend.business.site-map.siteMap');
    });

    Route::group(['prefix' => 'support-s'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'supportPage'])->name('frontend.business.support.supportPage');
    });
    Route::post('/register', [RegisterController::class, 'store'])->name('frontend.business.register.store');

    Route::get('/country-state-city', [RegisterController::class, 'getCountry'])->name('frontend.business.register.getCountry');
    Route::post('/get-states-by-country', [RegisterController::class, 'getState'])->name('frontend.business.register.getState');
    Route::post('/get-cities-by-state', [RegisterController::class, 'getCity'])->name('frontend.business.register.getCity');

    Route::group(['prefix' => 'home'], function ($router) {
        Route::get('/index', [HomeController::class, 'index'])->name('frontend.business.home.index');
        Route::get('/logout', [HomeController::class, 'logout'])->name('frontend.business.home.logout');
        Route::get('/story', [HomeController::class, 'story'])->name('frontend.business.home.story');
        Route::post('/Payment_successfull/{storyPriceId}',  [HomeController::class, 'payment_successfull'])->name('frontend.business.home.payment_successfull');
        Route::get('/story_payment/{id}', [HomeController::class, 'story_payment'])->name('frontend.business.home.story_payment');

        Route::post('/support-query', [HomeController::class, 'storeSupportsMessage'])->name('frontend.business.home.storeSupportsMessage');
    });

    Route::group(['prefix' => 'business-dashboard'], function ($router) {
        Route::get('/', [BusinessDashboardController::class, 'index'])->name('frontend.business.business-dashboard.index');
    });

    Route::group(['prefix' => 'likelist'], function ($router) {
        Route::get('/', [BusinessUserLike::class, 'index'])->name('frontend.business.likelist.index');
        Route::post('/likelist_removed', [BusinessUserLike::class, 'likelist_removed'])->name('frontend.business.likelist.likelist_removed');
    });

    Route::group(['prefix' => 'business-profile'], function ($router) {
        Route::get('/', [BusinessProfileController::class, 'index'])->name('frontend.business.business-profile.index');
        Route::post('/post_removed', [BusinessProfileController::class, 'post_removed'])->name('frontend.business.business-profile.post_removed');
        Route::post('add_address/', [BusinessProfileController::class, 'add_address'])->name('frontend.business.profile.add_address');
        Route::post('update_address/{id}', [BusinessProfileController::class, 'update_address'])->name('frontend.business.profile.update_address');
        Route::get('/following-list', [BusinessProfileController::class, 'following_details'])->name('frontend.business.profile.following_details');
        Route::get('/follower-list', [BusinessProfileController::class, 'follower_details'])->name('frontend.business.profile.follower_details');
        Route::get('/sold-list', [BusinessProfileController::class, 'sold_details'])->name('frontend.business.profile.sold_details');
        Route::get('/bought-list', [BusinessProfileController::class, 'bought_details'])->name('frontend.business.profile.bought_details');
        Route::get('/return-policy', [BusinessProfileController::class, 'return_policy'])->name('frontend.business.profile.return_policy');
        Route::post('/add-return-policy', [BusinessProfileController::class, 'add_return_policy'])->name('frontend.business.profile.add_return_policy');
        Route::post('/edit-return-policy', [BusinessProfileController::class, 'edit_return_policy'])->name('frontend.business.profile.edit_return_policy');
        Route::get('/term-condition', [BusinessProfileController::class, 'term_condition'])->name('frontend.business.profile.term_condition');
        Route::post('/add-term-condition', [BusinessProfileController::class, 'add_term_condition'])->name('frontend.business.profile.add_term_condition');
        Route::post('/edit-term-condition', [BusinessProfileController::class, 'edit_term_condition'])->name('frontend.business.profile.edit_term_condition');
    });

    Route::group(['prefix' => 'product-category'], function ($router) {
        Route::get('/{id}', [BusinessProductCategory::class, 'index'])->name('frontend.business.product_category.index');
        Route::post('/sub-cate-filter', [BusinessProductCategory::class, 'subCateFilter'])->name('frontend.business.product_category.subCateFilter');
        Route::get('/', [BusinessProductCategory::class, 'search_data'])->name('frontend.business.product_category.search_data');
    });

    Route::group(['prefix' => 'my-orders'], function ($router) {
        Route::get('/', [MyOrdersController::class, 'index'])->name('frontend.business.my-orders.index');
        Route::get('/filter_ajax', [MyOrdersController::class, 'filter_ajax'])->name('frontend.business.my-orders.filter_ajax');
        Route::post('/order-filter', [MyOrdersController::class, 'orderFilter'])->name('frontend.business.my-orders.orderFilter');
        Route::post('/last-30-days-order-filter', [MyOrdersController::class, 'last_30_DaysOrderFilter'])->name('frontend.business.my-orders.last_30_DaysOrderFilter');
        Route::post('/review-post-user-details', [MyOrdersController::class, 'busines_review_post_user_details'])->name('frontend.business.my-orders.busines_review_post_user_details');
        Route::post('/review-post-store', [MyOrdersController::class, 'busines_review_post_store'])->name('frontend.business.my-orders.busines_review_post_store');
        Route::post('/retrive-reviews', [MyOrdersController::class, 'busines_retrive_reviews'])->name('frontend.business.my-orders.busines_retrive_reviews');
        Route::get('/track-orders/{id}', [MyOrdersController::class, 'track_orders'])->name('frontend.business.my-orders.track_orders');
        Route::post('/order-cancel', [MyOrdersController::class, 'order_cancel'])->name('frontend.business.my-orders.order_cancel');
        Route::post('/add-support', [MyOrdersController::class, 'store'])->name('frontend.business.my-orders.store');
    });

    Route::group(['prefix' => 'orders-management'], function ($router) {
        Route::get('/', [BusinessCustomerOrder::class, 'index'])->name('frontend.business.orders-sold.index');
        Route::post('/create-shipping', [BusinessCustomerOrder::class, 'create_shipping'])->name('frontend.business.orders-sold.create_shipping');
        Route::post('/order-filter', [BusinessCustomerOrder::class, 'orderFilter'])->name('frontend.business.orders-sold.orderFilter');
        Route::post('/last-30-days-order-filter', [BusinessCustomerOrder::class, 'last_30_DaysOrderFilter'])->name('frontend.business.orders-sold.last_30_DaysOrderFilter');
        Route::get('/order-return', [BusinessCustomerOrder::class, 'return_order'])->name('frontend.business.orders-sold.return_order');
        Route::post('/return-order-accept', [BusinessCustomerOrder::class, 'return_order_accept'])->name('frontend.business.orders-sold.return_order_accept');
        Route::post('/return-order-decline', [BusinessCustomerOrder::class, 'return_order_decline'])->name('frontend.business.orders-sold.return_order_decline');

    });

    Route::group(['prefix' => 'product-reviews'], function ($router) {
        Route::get('/', [ProductReviews::class, 'index'])->name('frontend.business.product-reviews.index');
        Route::get('/reviews-details/{id}',  [ProductReviews::class, 'reviews_details'])->name('frontend.business.product-reviews.reviews_details');
    });

    Route::group(['prefix' => 'seller-reviews'], function ($router) {
        Route::get('/', [SellerReviewBusiness::class, 'index'])->name('frontend.business.seller-reviews.index');
        Route::get('/list-of-reviews/{id}',  [SellerReviewBusiness::class, 'seller_reviews_details'])->name('frontend.business.seller-reviews.seller_reviews_details');
        Route::post('/seller-review-post-store', [SellerReviewBusiness::class, 'seller_review_post_store'])->name('frontend.business.seller-reviews.seller_review_post_store');
    });

    Route::get('/my-items', [MyItemsController::class, 'index'])->name('frontend.business.my-items.index');
    Route::post('/items-filter', [MyItemsController::class, 'itemsFilter'])->name('frontend.business.my-items.itemsFilter');
    Route::post('/business-product-category-filter', [MyItemsController::class, 'userSubCateFilter'])->name('frontend.business.my-items.userSubCateFilter');
    Route::get('/export-items/{id}', [MyItemsController::class, 'exportitems'])->name('frontend.business.my-items.exportitems');

    Route::group(['prefix' => 'wallet'], function ($router) {
        Route::get('/', [BusinessWalletController::class, 'index'])->name('frontend.business.business-wallet.index');
        Route::post('/wallet-store', [BusinessWalletController::class, 'store'])->name('frontend.business.business-wallet.store');
        Route::post('/wallet-paid', [BusinessWalletController::class, 'wallet_paid'])->name('frontend.business.business-wallet.wallet_paid');
    });
    
    Route::group(['prefix' => 'store'], function ($router) {
        Route::get('/store-list', [AddStoreController::class, 'index'])->name('frontend.business.add-store.index');
        Route::get('/create-store', [AddStoreController::class, 'create_store'])->name('frontend.business.add-store.create_store');
        Route::post('/add-store', [AddStoreController::class, 'addStore'])->name('frontend.business.add-store.addStore');
        Route::get('/edit/{id}',  [AddStoreController::class, 'edit'])->name('frontend.business.add-store.edit');
        Route::post('/update',  [AddStoreController::class, 'update'])->name('frontend.business.add-store.update');
        Route::post('/store-removed', [AddStoreController::class, 'store_removed'])->name('frontend.business.business.add-store.store_removed');
        Route::post('/state_list', [AddStoreController::class, 'state_list'])->name('frontend.business.add-store.state_list');
        Route::post('/city_list', [AddStoreController::class, 'city_list'])->name('frontend.business.add-store.city_list');
    });



    Route::group(['prefix' => 'b-profile'], function ($router) {
        Route::get('/', [B_ProfileController::class, 'index'])->name('frontend.business.b-profile.index');
    });

    Route::get('/edit-profile', [BusinessProfileController::class, 'editProfile'])->name('frontend.business.business-profile.editProfile');
    Route::post('/update-profile', [BusinessProfileController::class, 'updateProfile'])->name('frontend.business.business-profile.updateProfile');
    Route::post('/replace-banner', [BusinessProfileController::class, 'businessReplaceBanner'])->name('frontend.business.business-profile.businessReplaceBanner');
    Route::post('/add-story', [BusinessProfileController::class, 'addBusinessStory'])->name('frontend.business.business-profile.addBusinessStory');
    Route::post('/state_listing', [BusinessProfileController::class, 'state_listing'])->name('frontend.business.business-profile.state_listing');
    Route::post('/city_listing', [BusinessProfileController::class, 'city_listing'])->name('frontend.business.business-profile.city_listing');
    Route::post('/story-add', [BusinessProfileController::class, 'addStory'])->name('frontend.business.business-profile.addStory');
    Route::get('/story_payment/{id}', [BusinessProfileController::class, 'story_payment'])->name('frontend.business.business-profile.story_payment');
    Route::post('/Payment_successfull/{storyPriceId}',  [BusinessProfileController::class, 'payment_successfull'])->name('frontend.business.business-profile.payment_successfull');



    Route::group(['prefix' => 'item-post'], function ($router) {

        Route::get('/', [ItemPostController::class, 'index'])->name('frontend.business.item-post.index');
        Route::post('/store', [ItemPostController::class, 'store'])->name('frontend.business.item-post.store');

        Route::post('get-sub-category', [ItemPostController::class, 'getSubCat'])->name('frontend.business.item-post.getSubCat');
        Route::post('get-brand', [ItemPostController::class, 'getBrand'])->name('frontend.business.item-post.getBrand');
        Route::post('get-attribute', [ItemPostController::class, 'getAttribute'])->name('forntend.business.item-post.getAttribute');
        Route::post('get-attribute-variants', [ItemPostController::class, 'getAttributevariants'])->name('forntend.business.item-post.getAttributevariants');

        Route::get('/items_details/{id}',  [ItemPostController::class, 'items_details'])->name('frontend.business.item-post.items_details');

        Route::get('/edit/{id}',  [ItemPostController::class, 'edit'])->name('frontend.business.item-post.edit');
        Route::post('/update', [ItemPostController::class, 'update'])->name('frontend.business.item-post.update');
    });

    Route::group(['prefix' => 'userlike'], function ($router) {
        Route::post('/add_to_like', [BusinessUserLike::class, 'add_to_like'])->name('frontend.business.userlike.add_to_like');
    });

    Route::group(['prefix' => 'promoted-items'], function ($router) {
        Route::get('/index', [PromotedItemsController::class, 'index'])->name('frontend.business.promoted-items.index');
        Route::get('/item-details/{id}',  [PromotedItemsController::class, 'item_details'])->name('frontend.business.promoted-items.item_details');
        Route::post('/make-an-offer',  [PromotedItemsController::class, 'make_an_offer'])->name('frontend.business.promoted-items.make_an_offer');
        Route::post('/hold-an-offer',  [PromotedItemsController::class, 'hold_an_offer'])->name('frontend.business.promoted-items.hold_an_offer');
    });

    Route::group(['prefix' => 'make-an-offer'], function ($router) {
        Route::post('/make-an-offer-post',  [MakeAnOfferController::class, 'make_an_offer_post'])->name('frontend.business.make-an-offer.make_an_offer_post');
    });

    Route::group(['prefix' => 'hold-an-offer'], function ($router) {
        Route::post('/hold-an-offer-post',  [HoldAnOfferController::class, 'hold_an_offer_post'])->name('frontend.business.hold-an-offer.hold_an_offer_post');
    });

    Route::group(['prefix' => 'new-items'], function ($router) {
        Route::get('/index', [NewItemsController::class, 'index'])->name('frontend.business.new-items.index');
        Route::get('/item-details/{id}',  [NewItemsController::class, 'item_details'])->name('frontend.business.new-items.item_details');
        Route::get('/my-product/{id}',  [NewItemsController::class, 'myproduct_details'])->name('frontend.business.new-items.myproduct_details');
    });

    Route::group(['prefix' => 'used-items'], function ($router) {
        Route::get('/index', [UsedItemsController::class, 'index'])->name('frontend.business.used-items.index');
        Route::get('/item-details/{id}',  [UsedItemsController::class, 'item_details'])->name('frontend.business.used-items.item_details');
        Route::get('/my-product/{id}',  [UsedItemsController::class, 'myproduct_details'])->name('frontend.business.used-items.myproduct_details');
    });

    Route::group(['prefix' => 'unused-items'], function ($router) {
        Route::get('/index', [UnusedItemsController::class, 'index'])->name('frontend.business.unused-items.index');
        Route::get('/item-details/{id}',  [UnusedItemsController::class, 'item_details'])->name('frontend.business.unused-items.item_details');
        Route::get('/my-product/{id}',  [UnusedItemsController::class, 'myproduct_details'])->name('frontend.business.unused-items.myproduct_details');
    });

    Route::group(['prefix' => 'boost-items'], function ($router) {
        Route::get('/index', [BoostItemsController::class, 'index'])->name('frontend.business.boost-items.index');
        Route::get('/item-details/{id}',  [BoostItemsController::class, 'item_details'])->name('frontend.business.boost-items.item_details');
        Route::post('/boost_items_payment_details',  [BoostItemsController::class, 'boost_items_payment_details'])->name('frontend.business.boost-items.boost_items_payment_details');
        Route::get('/boost_items_payment/{id}',  [BoostItemsController::class, 'boost_items_payment'])->name('frontend.business.boost-items.boost_items_payment');
        Route::post('/boost_items_payment_info',  [BoostItemsController::class, 'boost_items_payment_info'])->name('frontend.business.boost-items.boost_items_payment_info');
    });

    Route::group(['prefix' => 'profile-seller'], function ($router) {
        Route::get('/{id}', [ProfileSellerController::class, 'index'])->name('frontend.business.profile-seller.index');
        Route::post('/followers', [ProfileSellerController::class, 'followers'])->name('frontend.business.profile-seller.followers');
    });

    Route::group(['prefix' => 'follow-unfollow'], function ($router) {
        // Route::get('/list', [FollowUnfollowController::class, 'index'])->name('frontend.business.follow-unfollow.index');
        Route::get('/list', [FollowUnfollowController::class, 'index'])->name('frontend.business.following.index');
        Route::post('/followers', [FollowUnfollowController::class, 'followers'])->name('frontend.business.follow-unfollow.followers');
        Route::post('/follow-unfollow-filter', [FollowUnfollowController::class, 'followUnfollowFilter'])->name('frontend.business.follow-unfollow.followUnfollowFilter');
    });

    Route::get('/loadFollower', [ProfileSellerController::class, 'loadFollower'])->name('frontend.business.profile-seller.loadFollower');
    Route::get('/loadFollowing', [ProfileSellerController::class, 'loadFollowing'])->name('frontend.business.profile-seller.loadFollowing');

    Route::post('/change-password', [BusinessProfileController::class, 'businessChangePassword'])->name('frontend.business.business-profile.businessChangePassword');
    Route::get('/top-deals-items', [TopDealsController::class, 'index'])->name('frontend.business.top-deals-items.index');
    Route::get('/trending-items', [TrendingItemsController::class, 'index'])->name('frontend.business.trending-items.index');
    Route::get('/recommended-items', [RecommendedItemsController::class, 'index'])->name('frontend.business.recommended-items.index');

    Route::group(['prefix' => 'wishlist'], function ($router) {
        Route::get('/', [WishlistController::class, 'index'])->name('frontend.business.wishlist.index');
        Route::post('/add_to_wishlist', [WishlistController::class, 'add_to_wishlist'])->name('frontend.business.wishlist.add_to_wishlist');
        Route::post('/wishlist_removed', [WishlistController::class, 'wishlist_removed'])->name('frontend.business.wishlist.wishlist_removed');
    });

    Route::group(['prefix' => 'return-policy'], function ($router) {
        Route::get('/', [ReturnPolicyController::class, 'index'])->name('frontend.business.return-policy.index');
        Route::post('/items_return', [ReturnPolicyController::class, 'items_return_form'])->name('frontend.business.return-policy.items_return_form');
    });

    Route::group(['prefix' => 'address'], function ($router) {
        Route::get('/', [BusinessAddress::class, 'index'])->name('frontend.business.address.index');
        Route::get('/shipping-address/{id}', [BusinessAddress::class, 'shipping_address'])->name('frontend.business.address.shipping_address');
    });

    Route::group(['prefix' => 'order-summary-payment'], function ($router) {
        Route::get('/', [OrderSummaryPaymentController::class, 'index'])->name('frontend.business.order-summary-payment.index');
        Route::post('/payment_details', [OrderSummaryPaymentController::class, 'payment_details'])->name('frontend.business.order-summary-payment.payment_details');
    });

    Route::group(['prefix' => 'order-details'], function ($router) {
        Route::get('/order/{id}', [OrderDetailsController::class, 'index'])->name('frontend.business.order-details.index');
        Route::post('/accept-order', [OrderDetailsController::class, 'accept_order'])->name('frontend.business.order-details.accept_order');
        Route::get('/checkout/{id}',  [OrderDetailsController::class, 'checkout'])->name('frontend.business.order-details.checkout');
        Route::get('/checkout',  [OrderDetailsController::class, 'checkout_empty'])->name('frontend.business.order-details.checkout_empty');	
        Route::get('/remove-item/{id}',  [OrderDetailsController::class, 'removedItem'])->name('frontend.business.order-details.removed-item');
        Route::get('/card-details/{id}',  [OrderDetailsController::class, 'card_details'])->name('frontend.business.order-details.card_details');
        Route::post('/order-placed',  [OrderDetailsController::class, 'order_placed'])->name('frontend.business.order-details.order_placed');
        Route::post('/add-to-cart', [OrderDetailsController::class, 'addToCart'])->name('frontend.business.order-details.addToCart');
        Route::post('/business-qty-add-minus', [OrderDetailsController::class, 'qtyAddMinus'])->name('frontend.business.order-details.qtyAddMinus');
        Route::post('/order-data-filter', [OrderDetailsController::class, 'orderFilter'])->name('frontend.business.order-details.orderFilter');
        Route::get('/order-payment/{id}', [OrderDetailsController::class, 'orderPaymentChoose'])->name('frontend.business.order-details.orderPaymentChoose');
        Route::post('/order-payment-select', [OrderDetailsController::class, 'orderPaymentSelect'])->name('frontend.business.order-details.orderPaymentSelect');
        Route::get('/payment-cod', [OrderDetailsController::class, 'orderPaymentCOD'])->name('frontend.business.order-details.orderPaymentCOD');
        Route::post('/payment-gpay', [OrderDetailsController::class, 'orderPaymentgpay'])->name('frontend.business.order-details.orderPaymentgpay');
        Route::get('/download-invoice/{id}', [OrderDetailsController::class, 'pdf_download_invoice'])->name('frontend.business.order-details.pdf_download_invoice');
        Route::get('/order-successfull', [OrderDetailsController::class, 'order_successfull'])->name('frontend.business.order-details.order_successfull');
        Route::get('/order-wallet', [OrderDetailsController::class, 'order_wallet'])->name('frontend.business.order-details.order_wallet');
        Route::post('/order-return', [OrderDetailsController::class, 'order_return'])->name('frontend.business.order-details.order_return');
    });

    Route::group(['prefix' => 'support'], function ($router) {
        Route::get('/', [BusinessTicketController::class, 'index'])->name('frontend.business.support.index');
        Route::post('/add-support', [BusinessTicketController::class, 'store'])->name('frontend.business.support.store');
        Route::get('/support-details/{id}', [BusinessTicketController::class, 'ticket_details'])->name('frontend.business.support.ticket_details');
        Route::post('/add-reply', [BusinessTicketController::class, 'add_reply'])->name('frontend.business.support.add_reply');
    });

    Route::group(['prefix' => 'user-support'], function ($router) {
        Route::get('/', [BusinessUserTicketController::class, 'index'])->name('frontend.business.user-support.index');
        Route::post('/add-support', [BusinessUserTicketController::class, 'store'])->name('frontend.business.user-support.store');
        Route::get('/support-details/{id}', [BusinessUserTicketController::class, 'ticket_details'])->name('frontend.business.user-support.ticket_details');
        Route::post('/add-reply', [BusinessUserTicketController::class, 'add_reply'])->name('frontend.business.user-support.add_reply');
        Route::get('/request-list', [BusinessUserTicketController::class, 'reaquested_list'])->name('frontend.business.user-support.reaquested_list');
        Route::get('/received-details/{id}', [BusinessUserTicketController::class, 'received_details'])->name('frontend.business.user-support.received_details');
    });

    Route::group(['prefix' => 'accept-order'], function ($router) {
        Route::get('/', [AcceptOrderController::class, 'index'])->name('frontend.business.accept-order.index');
    });

    Route::group(['prefix' => 'cancel-order'], function ($router) {
        Route::get('/', [CancelOrderController::class, 'index'])->name('frontend.business.cancel-order.index');
    });

    Route::group(['prefix' => 'business-report'], function ($router) {
        Route::get('/', [BusinessReportController::class, 'index'])->name('frontend.business.business-report.index');
        Route::post('/filter', [BusinessReportController::class, 'business_report_filter'])->name('frontend.business.business-report.business_report_filter');
    });

    Route::group(['prefix' => 'sales-report'], function ($router) {
        Route::get('/', [Testcontroller::class, 'index'])->name('frontend.business.sales-report.index');
    });

    Route::group(['prefix' => 'contact-us'], function ($router) {
        Route::post('/contact-us', [ContactUsForBusiness::class, 'seedMessageForContactUs'])->name('frontend.business.contact-us.seedMessageForContactUs');
    });


    Route::group(['prefix' => 'blog-details'], function ($router) {
        Route::post('/blog-details/{id}', [BlogForUsers::class, 'blog_details'])->name('frontend.business.blog.blog_details');
    });

    Route::group(['prefix' => 'upload-image'], function ($router) {
        Route::get('/', [B_ImagesBulkController::class, 'index'])->name('frontend.business.pages.import_images');
        Route::post('/store', [B_ImagesBulkController::class, 'store'])->name('frontend.business.pages.store');
        Route::post('/destroy', [B_ImagesBulkController::class, 'destroy'])->name('frontend.business.pages.destroy');
    });

    Route::group(['prefix' => 'permission'], function ($router) {
        Route::get('/', [BusinessPermissionController::class, 'index'])->name('frontend.business.permission.index');
        Route::get('/create', [BusinessPermissionController::class, 'create'])->name('frontend.business.permission.create');
        Route::post('/store', [BusinessPermissionController::class, 'store'])->name('frontend.business.permission.store');
    });

    Route::group(['prefix' => 'business-user'], function ($router) {
        Route::get('/', [BusinessBusinessUserController::class, 'index'])->name('frontend.business.business_user.index');
        Route::post('/store', [BusinessBusinessUserController::class, 'store'])->name('frontend.business.business_user.store');
    });

    Route::group(['prefix' => 'roles'], function ($router) {
        Route::get('/index', [AddRolesController::class, 'index'])->name('frontend.business.add-roles.index');
        Route::get('/create', [AddRolesController::class, 'create'])->name('frontend.business.add-roles.create');
        Route::post('/store', [AddRolesController::class, 'store'])->name('frontend.business.add-roles.store');
    });

    Route::group(['prefix' => 'subscribe-business'], function ($router) {
        Route::post('/subscribe', [BusinessSubscribe::class, 'subscribe'])->name('frontend.business.subscribe.subscribe');
    });

    
});
Route::group(['namespace' => 'Store', 'prefix' => 'store'], function ($router) {

    Route::group(['prefix' => 'about-us'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'aboutUs'])->name('frontend.store.about-us.aboutUs');
    });

    Route::group(['prefix' => 'location'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'location'])->name('frontend.store.location.location');
    });

    Route::group(['prefix' => 'coupons-Offers'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'couponsOffers'])->name('frontend.store.coupons-Offers.couponsOffers');
    });

    Route::group(['prefix' => 'Contact-Us'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'contactUs'])->name('frontend.store.Contact-Us.contactUs');
    });

    Route::group(['prefix' => 'Careers'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'careers'])->name('frontend.store.Careers.careers');
    });

    Route::group(['prefix' => 'faq'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'faq'])->name('frontend.store.faq.faq');
    });

    Route::group(['prefix' => 'terms-condition'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'termsCondition'])->name('frontend.store.terms-condition.termsCondition');
    });

    Route::group(['prefix' => 'term-of-use'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'termsOfUse'])->name('frontend.store.term-of-use.termsOfUse');
    });

    Route::group(['prefix' => 'track-order'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'trackOrder'])->name('frontend.store.track-order.trackOrder');
    });

    Route::group(['prefix' => 'shipping'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'shipping'])->name('frontend.store.shipping.shipping');
    });

    Route::group(['prefix' => 'cancellation'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'cancellation'])->name('frontend.store.cancellation.cancellation');
    });

    Route::group(['prefix' => 'return'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'returnOrder'])->name('frontend.store.return.returnOrder');
    });

    Route::group(['prefix' => 'whitehat'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'whitehat'])->name('frontend.store.whitehat.whitehat');
    });

    Route::group(['prefix' => 'blog'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'blog'])->name('frontend.store.blog.blog');
    });

    Route::group(['prefix' => 'privacy-policy'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'privacyPolicy'])->name('frontend.store.privacy-policy.privacyPolicy');
    });

    Route::group(['prefix' => 'site-map'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'siteMap'])->name('frontend.store.site-map.siteMap');
    });

    Route::group(['prefix' => 'support'], function ($router) {
        Route::get('/', [BusinessSiteLinks::class, 'supportPage'])->name('frontend.store.support.supportPage');
    });

    Route::get('/country-state-city', [RegisterController::class, 'getCountry'])->name('frontend.store.register.getCountry');
    Route::post('/get-states-by-country', [RegisterController::class, 'getState'])->name('frontend.store.register.getState');
    Route::post('/get-cities-by-state', [RegisterController::class, 'getCity'])->name('frontend.store.register.getCity');

    Route::group(['prefix' => 'home'], function ($router) {
        Route::get('/store-index', [HomeController::class, 'index'])->name('frontend.store.home.index');
        Route::get('/logout', [HomeController::class, 'logout'])->name('frontend.store.home.logout');
        Route::get('/story', [HomeController::class, 'story'])->name('frontend.store.home.story');
        Route::post('/Payment_successfull/{storyPriceId}',  [HomeController::class, 'payment_successfull'])->name('frontend.store.home.payment_successfull');
        Route::get('/story_payment/{id}', [HomeController::class, 'story_payment'])->name('frontend.store.home.story_payment');

        Route::post('/support-query', [HomeController::class, 'storeSupportsMessage'])->name('frontend.store.home.storeSupportsMessage');
    });

    Route::group(['prefix' => 'store-dashboard'], function ($router) {
        Route::get('/', [BusinessDashboardController::class, 'index'])->name('frontend.store.store-dashboard.index');
    });

    Route::group(['prefix' => 'store-profile'], function ($router) {
        Route::get('/', [BusinessProfileController::class, 'index'])->name('frontend.store.store-profile.index');
        Route::post('/post_removed', [BusinessProfileController::class, 'post_removed'])->name('frontend.store.store-profile.post_removed');
        Route::post('add_address/', [BusinessProfileController::class, 'add_address'])->name('frontend.store.store-profile.add_address');
        Route::post('update_address/{id}', [BusinessProfileController::class, 'update_address'])->name('frontend.store.store-profile.update_address');
        Route::get('/following-list', [BusinessProfileController::class, 'following_details'])->name('frontend.store.store-profile.following_details');
        Route::get('/follower-list', [BusinessProfileController::class, 'follower_details'])->name('frontend.store.store-profile.follower_details');
        Route::get('/sold-list', [BusinessProfileController::class, 'sold_details'])->name('frontend.store.store-profile.sold_details');
        Route::get('/bought-list', [BusinessProfileController::class, 'bought_details'])->name('frontend.store.store-profile.bought_details');
        Route::get('/return-policy', [BusinessProfileController::class, 'return_policy'])->name('frontend.store.store-profile.return_policy');
        Route::post('/add-return-policy', [BusinessProfileController::class, 'add_return_policy'])->name('frontend.store.store-profile.add_return_policy');
        Route::post('/edit-return-policy', [BusinessProfileController::class, 'edit_return_policy'])->name('frontend.store.store-profile.edit_return_policy');
        Route::get('/term-condition', [BusinessProfileController::class, 'term_condition'])->name('frontend.store.store-profile.term_condition');
        Route::post('/add-term-condition', [BusinessProfileController::class, 'add_term_condition'])->name('frontend.store.store-profile.add_term_condition');
        Route::post('/edit-term-condition', [BusinessProfileController::class, 'edit_term_condition'])->name('frontend.store.store-profile.edit_term_condition');
    });

    Route::group(['prefix' => 'my-orders'], function ($router) {
        Route::get('/', [MyOrdersController::class, 'index'])->name('frontend.store.my-orders.index');
        Route::get('/filter_ajax', [MyOrdersController::class, 'filter_ajax'])->name('frontend.store.my-orders.filter_ajax');
        Route::post('/order-filter', [MyOrdersController::class, 'orderFilter'])->name('frontend.store.my-orders.orderFilter');
        Route::post('/last-30-days-order-filter', [MyOrdersController::class, 'last_30_DaysOrderFilter'])->name('frontend.store.my-orders.last_30_DaysOrderFilter');
        Route::post('/review-post-user-details', [MyOrdersController::class, 'busines_review_post_user_details'])->name('frontend.store.my-orders.busines_review_post_user_details');
        Route::post('/review-post-store', [MyOrdersController::class, 'busines_review_post_store'])->name('frontend.store.my-orders.busines_review_post_store');
        Route::post('/retrive-reviews', [MyOrdersController::class, 'busines_retrive_reviews'])->name('frontend.store.my-orders.busines_retrive_reviews');
        Route::get('/track-orders/{id}', [MyOrdersController::class, 'track_orders'])->name('frontend.store.my-orders.track_orders');
    });

    Route::group(['prefix' => 'orders-sold'], function ($router) {
        Route::get('/', [BusinessCustomerOrder::class, 'index'])->name('frontend.store.orders-sold.index');
        Route::post('/create-shipping', [BusinessCustomerOrder::class, 'create_shipping'])->name('frontend.store.orders-sold.create_shipping');
        Route::post('/order-filter', [BusinessCustomerOrder::class, 'orderFilter'])->name('frontend.store.orders-sold.orderFilter');
        Route::post('/last-30-days-order-filter', [BusinessCustomerOrder::class, 'last_30_DaysOrderFilter'])->name('frontend.store.orders-sold.last_30_DaysOrderFilter');
    });

    Route::group(['prefix' => 'order-details'], function ($router) {
        Route::get('/order/{id}', [OrderDetailsController::class, 'index'])->name('frontend.store.order-details.index');
        Route::post('/accept-order', [OrderDetailsController::class, 'accept_order'])->name('frontend.store.order-details.accept_order');
        Route::get('/checkout/{id}',  [OrderDetailsController::class, 'checkout'])->name('frontend.store.order-details.checkout');
        Route::get('/card-details/{id}',  [OrderDetailsController::class, 'card_details'])->name('frontend.store.order-details.card_details');
        Route::post('/order-placed',  [OrderDetailsController::class, 'order_placed'])->name('frontend.store.order-details.order_placed');
        Route::post('/add-to-cart', [OrderDetailsController::class, 'addToCart'])->name('frontend.store.order-details.addToCart');
        Route::post('/business-qty-add-minus', [OrderDetailsController::class, 'qtyAddMinus'])->name('frontend.store.order-details.qtyAddMinus');
        Route::post('/order-data-filter', [OrderDetailsController::class, 'orderFilter'])->name('frontend.store.order-details.orderFilter');
        Route::get('/order-payment/{id}', [OrderDetailsController::class, 'orderPaymentChoose'])->name('frontend.store.order-details.orderPaymentChoose');
        Route::get('/payment-cod', [OrderDetailsController::class, 'orderPaymentCOD'])->name('frontend.store.order-details.orderPaymentCOD');
        Route::get('/download_invoice/{id}', [OrderDetailsController::class, 'pdf_download_invoice'])->name('frontend.store.order-details.pdf_download_invoice');
    });

    Route::group(['prefix' => 'my-product'], function ($router) {
        Route::get('/', [MyItemsController::class, 'index'])->name('frontend.store.my-items.index');
        Route::post('/items-filter', [MyItemsController::class, 'itemsFilter'])->name('frontend.store.my-items.itemsFilter');
        Route::post('/business-product-category-filter', [MyItemsController::class, 'userSubCateFilter'])->name('frontend.store.my-items.userSubCateFilter');
        Route::get('/export-items/{id}', [MyItemsController::class, 'exportitems'])->name('frontend.store.my-items.exportitems');
    });

    Route::group(['prefix' => 'upload-image'], function ($router) {
        Route::get('/', [B_ImagesBulkController::class, 'index'])->name('frontend.store.pages.import_images');
        Route::post('/store', [B_ImagesBulkController::class, 'store'])->name('frontend.store.pages.store');
        Route::post('/destroy', [B_ImagesBulkController::class, 'destroy'])->name('frontend.store.pages.destroy');
    });

    Route::group(['prefix' => 'wishlist'], function ($router) {
        Route::get('/', [WishlistController::class, 'index'])->name('frontend.store.wishlist.index');
        Route::post('/add_to_wishlist', [WishlistController::class, 'add_to_wishlist'])->name('frontend.store.wishlist.add_to_wishlist');
        Route::post('/wishlist_removed', [WishlistController::class, 'wishlist_removed'])->name('frontend.store.wishlist.wishlist_removed');
    });

    Route::group(['prefix' => 'likelist'], function ($router) {
        Route::get('/', [BusinessUserLike::class, 'index'])->name('frontend.store.likelist.index');
        Route::post('/likelist_removed', [BusinessUserLike::class, 'likelist_removed'])->name('frontend.store.likelist.likelist_removed');
    });

    Route::group(['prefix' => 'wallet'], function ($router){
        Route::get('/', [BusinessWalletController::class, 'index'])->name('frontend.store.store-wallet.index');
    });

    Route::group(['prefix' => 'roles'], function ($router) {
        Route::get('/index', [AddRolesController::class, 'index'])->name('frontend.store.add-roles.index');
        Route::get('/create', [AddRolesController::class, 'create'])->name('frontend.store.add-roles.create');
        Route::post('/store', [AddRolesController::class, 'store'])->name('frontend.store.add-roles.store');
    });

    Route::group(['prefix' => 'permission'], function ($router) {
        Route::get('/', [BusinessPermissionController::class, 'permission_index'])->name('frontend.store.permission.index');
        Route::get('/create', [BusinessPermissionController::class, 'permission_create'])->name('frontend.store.permission.create');
        Route::post('/store', [BusinessPermissionController::class, 'permission_store'])->name('frontend.store.permission.store');
    });

    Route::group(['prefix' => 'business-user'], function ($router) {
        Route::get('/', [BusinessBusinessUserController::class, 'index'])->name('frontend.store.store_user.index');
        Route::post('/store', [BusinessBusinessUserController::class, 'store'])->name('frontend.store.store_user.store');
    });

    Route::group(['prefix' => 'business-report'], function ($router) {
        Route::get('/', [BusinessReportController::class, 'index'])->name('frontend.store.store-report.index');
        Route::post('/filter', [BusinessReportController::class, 'business_report_filter'])->name('frontend.store.store-report.store_report_filter');
    });

    Route::group(['prefix' => 'sales-report'], function ($router) {
        Route::get('/', [Testcontroller::class, 'index'])->name('frontend.store.sales-report.index');
    });
    // Route::get('/my-Product', [MyItemsController::class, 'index'])->name('frontend.store.my-items.index');

    Route::group(['prefix' => 'item-post'], function ($router) {

        Route::get('/', [ItemPostController::class, 'index'])->name('frontend.store.item-post.index');
        Route::post('/store', [ItemPostController::class, 'store'])->name('frontend.store.item-post.store');

        Route::post('get-sub-category', [ItemPostController::class, 'getSubCat'])->name('frontend.store.item-post.getSubCat');
        Route::post('get-brand', [ItemPostController::class, 'getBrand'])->name('frontend.store.item-post.getBrand');
        Route::post('get-attribute', [ItemPostController::class, 'getAttribute'])->name('forntend.store.item-post.getAttribute');
        Route::post('get-attribute-variants', [ItemPostController::class, 'getAttributevariants'])->name('forntend.store.item-post.getAttributevariants');

        Route::get('/items_details/{id}',  [ItemPostController::class, 'items_details'])->name('frontend.store.item-post.items_details');

        Route::get('/edit/{id}',  [ItemPostController::class, 'edit'])->name('frontend.store.item-post.edit');
        Route::post('/update', [ItemPostController::class, 'update'])->name('frontend.store.item-post.update');
    });
    Route::group(['prefix' => 'promoted-items'], function ($router) {
        Route::get('/index', [PromotedItemsController::class, 'index'])->name('frontend.store.promoted-items.index');
        Route::get('/item-details/{id}',  [PromotedItemsController::class, 'item_details'])->name('frontend.store.promoted-items.item_details');
        Route::post('/make-an-offer',  [PromotedItemsController::class, 'make_an_offer'])->name('frontend.store.promoted-items.make_an_offer');
        Route::post('/hold-an-offer',  [PromotedItemsController::class, 'hold_an_offer'])->name('frontend.store.promoted-items.hold_an_offer');
    });
    Route::group(['prefix' => 'new-items'], function ($router) {
        Route::get('/index', [NewItemsController::class, 'index'])->name('frontend.store.new-items.index');
        Route::get('/item-details/{id}',  [NewItemsController::class, 'item_details'])->name('frontend.store.new-items.item_details');
        Route::get('/my-product/{id}',  [NewItemsController::class, 'myproduct_details'])->name('frontend.store.new-items.myproduct_details');
    });

    Route::group(['prefix' => 'used-items'], function ($router) {
        Route::get('/index', [UsedItemsController::class, 'index'])->name('frontend.store.used-items.index');
        Route::get('/item-details/{id}',  [UsedItemsController::class, 'item_details'])->name('frontend.store.used-items.item_details');
        Route::get('/my-product/{id}',  [UsedItemsController::class, 'myproduct_details'])->name('frontend.store.used-items.myproduct_details');
    });

    Route::group(['prefix' => 'unused-items'], function ($router) {
        Route::get('/index', [UnusedItemsController::class, 'index'])->name('frontend.store.unused-items.index');
        Route::get('/item-details/{id}',  [UnusedItemsController::class, 'item_details'])->name('frontend.store.unused-items.item_details');
        Route::get('/my-product/{id}',  [UnusedItemsController::class, 'myproduct_details'])->name('frontend.store.unused-items.myproduct_details');
    });

    Route::group(['prefix' => 'address'], function ($router) {
        Route::get('/', [BusinessAddress::class, 'index'])->name('frontend.store.address.index');
        Route::get('/shipping-address/{id}', [BusinessAddress::class, 'shipping_address'])->name('frontend.store.address.shipping_address');
    });
});

Route::group(['prefix' => 'checkout'], function ($router) {
    Route::post('/index', [MyCheckOutController::class, 'index'])->name('mycheckout.index');
    Route::post('/getPayLoadData', [MyCheckOutController::class, 'getPayLoadData'])->name('mycheckout.getPayLoadData');
});




Route::group(['prefix' => 'import-producta'], function ($router) {
    Route::get('/', [B_ProductBulkController::class, 'index'])->name('frontend.business.pages.importproduct.index');
    Route::post('/store', [B_ProductBulkController::class, 'store'])->name('frontend.business.pages.importproduct.store');
    Route::post('/import_parse', [B_ProductBulkController::class, 'parseImport'])->name('frontend.business.pages.importproduct.import_parse');
    Route::post('/import', [B_ProductBulkController::class, 'import'])->name('frontend.business.pages.importproduct.import');
});
