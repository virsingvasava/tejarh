<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Menus;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Condition;
use App\Models\Branch;
use App\Models\StoreType;
use App\Models\Slider;
use App\Models\Role;
use App\Models\ShipMode;
use Auth;
use App\config;
use App\Models\BoostPrice;
use App\Models\Commission;
use App\Models\DeliveryType;
use App\Models\General;
use App\Models\modelHasRoles;
use App\Models\permission;
use App\Models\roleHasPermissions;
use App\Models\ShortBanner;
use App\Models\StoryPrice;
use App\Models\VatPrice;
use App\Models\WholesaleGeneral;
use App\Models\WhyUse;
use Illuminate\Support\Facades\Storage;

use Faker\Generator as Faker;

class Users extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(Faker $faker)
  {
    $admin = new User;
    $admin->first_name = 'Super';
    $admin->last_name = 'Admin';
    $admin->name = 'Super Admin';
    $admin->phone_code = '+966';
    $admin->phone_number = '9176736730';
    $admin->email = 'admin@tejarh.co';
    $admin->password = Hash::make('Test@123');
    $admin->role = ADMIN_ROLE;
    $admin->admin_role = 1;
    $admin->role_user = 'admin';
    $admin->save();


    $api_user = new User;
    $api_user->first_name = 'Jone';
    $api_user->last_name = 'joe';
    $api_user->name = 'Jone';
    $api_user->phone_code = '+966';
    $api_user->phone_number = '9632574190';
    $api_user->email = 'users@gmail.com';
    $api_user->password = Hash::make('Test@123');
    $api_user->role = USER_ROLE;
    $api_user->country_id = 1;
    $api_user->state_id = 1;
    $api_user->city_id = 1;
    $api_user->save();

    $api_user = new StoryPrice;
    $api_user->story_price = 10;
    $api_user->status = FALSE;
    $api_user->save();

    $slider = new Slider;
    $slider->banner_heading_title = 'Sell & Buy - anything, anytime, anywhere !';
    $slider->banner_sub_heading_title = 'Search over 510,000+ local listings across India';
    $slider->banner_description = 'Search over 510,000+ local listings across India';
    $slider->ar_banner_heading_title = 'بيع وشراء - أي شيء في أي وقت وفي أي مكان!';
    $slider->ar_banner_sub_heading_title = 'ابحث في أكثر من 510.000+ قائمة محلية عبر الهند';
    $slider->ar_banner_description = 'ابحث في أكثر من 510.000+ قائمة محلية عبر الهند';
    $slider->banner_picture = '';
    $slider->status = TRUE;
    $slider->ar_status = TRUE;
    $slider->save();

    $slider1 = new Slider;
    $slider1->banner_heading_title = 'Sell & Buy - anything, anytime, anywhere !';
    $slider1->banner_sub_heading_title = 'Search over 510,000+ local listings across India';
    $slider1->banner_description = 'Search over 510,000+ local listings across India';
    $slider1->ar_banner_heading_title = 'بيع وشراء - أي شيء في أي وقت وفي أي مكان!';
    $slider1->ar_banner_sub_heading_title = 'ابحث في أكثر من 510.000+ قائمة محلية عبر الهند';
    $slider1->ar_banner_description = 'ابحث في أكثر من 510.000+ قائمة محلية عبر الهند';
    $slider1->banner_picture = '';
    $slider1->status = TRUE;
    $slider1->ar_status = TRUE;
    $slider1->save();

    $wholeSale = new WholesaleGeneral;
    $wholeSale->title        = 'Expertly curated brands';
    $wholeSale->ar_title        = 'العلامات التجارية المنسقة بخبرة';
    $wholeSale->description  = 'Behind every handpicked brand on Handshake is a story as unique as yours. Because, like you, we know quality is in the detail.';
    $wholeSale->ar_description  = 'وراء كل علامة تجارية منتقاة بعناية على Handshake قصة فريدة من نوعها مثل قصتك. لأننا ، مثلك ، نعلم أن الجودة في التفاصيل.';
    $wholeSale->wholesale_general_image  = '1664263225.png';
    $wholeSale->status  = TRUE;
    $wholeSale->ar_status = TRUE;
    $wholeSale->save();

    $wholeSale = new WholesaleGeneral;
    $wholeSale->title        = 'Less search, more sales';
    $wholeSale->ar_title        = 'بحث أقل ، المزيد من المبيعات';
    $wholeSale->description  = 'Discover your store’s next bestseller from hundreds of independent creators. Free sign-up, free rein. We’re here to help you grow.';
    $wholeSale->ar_description  = 'اكتشف أكثر الكتب مبيعًا في متجرك من بين مئات المبدعين المستقلين. تسجيل مجاني ، حرية العنان. نحن هنا لمساعدتك على النمو.';
    $wholeSale->wholesale_general_image  = '1664263246.png';
    $wholeSale->status     = TRUE;
    $wholeSale->ar_status = TRUE;
    $wholeSale->save();

    $wholeSale = new WholesaleGeneral;
    $wholeSale->title        = 'Connect with creators';
    $wholeSale->ar_title        = 'تواصل مع المبدعين';
    $wholeSale->description  = 'Behind every handpicked brand on Handshake is a story as unique as yours. Because, like you, we know quality is in the detail.';
    $wholeSale->ar_description  = 'وراء كل علامة تجارية منتقاة بعناية على Handshake قصة فريدة من نوعها مثل قصتك. لأننا ، مثلك ، نعلم أن الجودة في التفاصيل.';
    $wholeSale->wholesale_general_image  = '1664263263.png';
    $wholeSale->status     = TRUE;
    $wholeSale->ar_status = TRUE;
    $wholeSale->save();

    $shortBanner = new ShortBanner;
    $shortBanner->title        = 'Find your next bestseller';
    $shortBanner->ar_title     = 'اعثر على أكثر الكتب مبيعًا التالية';
    $shortBanner->short_banners_image  = 'images1664263170.png';
    $shortBanner->status     = TRUE;
    $shortBanner->ar_status = TRUE;
    $shortBanner->save();

    $shortBanner = new ShortBanner;
    $shortBanner->title        = 'Are you ready for posting your ads?';
    $shortBanner->ar_title     = 'هل انت جاهز لنشر اعلاناتك؟';
    $shortBanner->short_banners_image  = '1664263190.png';
    $shortBanner->status     = TRUE;
    $shortBanner->ar_status = TRUE;
    $shortBanner->save();

    $general = new WhyUse;
    $general->title        = 'Free to List';
    $general->ar_title     = 'حر في القائمة';
    $general->description  = 'Its absolutely free to list on Tejarh';
    $general->ar_description  = 'إنه مجاني تمامًا للإدراج على موقع تجارة';
    $general->general_image  = '1664262621.png';
    $general->status     = TRUE;
    $general->ar_status = TRUE;
    $general->save();

    $general = new WhyUse;
    $general->title        = 'No Selling Fees';
    $general->ar_title        = 'لا توجد رسوم بيع';
    $general->description  = 'No hidden fees charged when you sell your products or services';
    $general->ar_description  = 'لا توجد رسوم خفية يتم فرضها عند بيع منتجاتك أو خدماتك';
    $general->general_image  = '1664262645.png';
    $general->status     = TRUE;
    $general->ar_status = TRUE;
    $general->save();

    $general = new WhyUse;
    $general->title        = 'Upload upto 5 photos';
    $general->ar_title        = 'تحميل ما يصل إلى 5 صور';
    $general->description  = 'Ads with photos have 4x more chances to sell';
    $general->ar_description  = 'الإعلانات التي تحتوي على صور لديها فرص بيع أكثر بـ 4 مرات';
    $general->general_image  = '1664262666.png';
    $general->status     = TRUE;
    $general->ar_status = TRUE;
    $general->save();

    $general = new WhyUse;
    $general->title        = 'Free Ad Renewal';
    $general->ar_title    = 'تجديد مجاني للإعلان';
    $general->description  = 'No ad renewal fees, Post your ad until sold';
    $general->ar_description  = 'لا توجد رسوم تجديد إعلان ، انشر إعلانك حتى يتم بيعه';
    $general->general_image  = '1664262688.png';
    $general->status     = TRUE;
    $general->ar_status = TRUE;
    $general->save();

    $general = new WhyUse;
    $general->title        = 'Upload a story';
    $general->ar_title        = 'تحميل قصة';
    $general->description  = 'Upload a story and increase your sales 100X';
    $general->ar_description  = 'قم بتحميل قصة وزيادة مبيعاتك 100X';
    $general->general_image  = '1664262708.png';
    $general->status     = TRUE;
    $general->ar_status = TRUE;
    $general->save();

    $general = new WhyUse;
    $general->title        = 'Ship any where';
    $general->ar_title        = 'شحن في أي مكان';
    $general->description  = 'No ad renewal fees, Post your ad until sold';
    $general->ar_description  = 'لا توجد رسوم تجديد إعلان ، انشر إعلانك حتى يتم بيعه';
    $general->general_image  = '1664262727.png';
    $general->status     = TRUE;
    $general->ar_status = TRUE;
    $general->save();

    $general = new WhyUse;
    $general->title        = 'Increase market reach';
    $general->ar_title        = 'زيادة الوصول إلى السوق';
    $general->description  = 'Increase your market reach with Tejarh';
    $general->ar_description  = 'زد من وصولك إلى السوق مع تجارة';
    $general->general_image  = '1664262747.png';
    $general->status     = TRUE;
    $general->ar_status = TRUE;
    $general->save();

    $general = new WhyUse;
    $general->title        = 'Chat';
    $general->ar_title        = 'دردشة';
    $general->description  = 'chat directly with your store and get a great deal';
    $general->ar_description  = 'تحدث مباشرة مع متجرك واحصل على صفقة رائعة';
    $general->general_image  = '1664262762.png';
    $general->status     = TRUE;
    $general->ar_status = TRUE;
    $general->save();

    $role = new Role;
    $role->name = 'Super Admin';
    $role->guard_name  = 'web';
    $role->role_picture = NULL;
    $role->role = ADMIN_ROLE;
    $role->role_status = 'admin';
    $role->status = 0;
    $role->save();

    $role = new Role;
    $role->name = 'business';
    $role->guard_name  = 'web';
    $role->role_picture = NULL;
    $role->role = BUSINESS_ROLE;
    $role->role_status = 'business_user';
    $role->status = 0;
    $role->save();

    $role = new Role;
    $role->name = 'store';
    $role->guard_name  = 'web';
    $role->role_picture = NULL;
    $role->role = STORE_ROLE;
    $role->role_status = 'business_store_user';
    $role->status = 0;
    $role->save();

    $permissions = new permission;
    $permissions->name = 'users access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Stories access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Products access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Master access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Locations access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'FAQs access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Orders access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Payment History access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Customer Support access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'CMS Pages access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Subscription Users access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Blogs access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Account Settings access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Reports access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Role Setting access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'admin';
    $permissions->save();


    $permission = permission::get()->toArray();
    if (!empty($permission) && count($permission) > 0) {
      foreach ($permission as $permissionrkey => $permission) {
        $permissionId = $permission['id'];
        $rolePermission = new roleHasPermissions;
        $rolePermission->permission_id = $permissionId;
        $rolePermission->role_id = 1;
        $rolePermission->save();
      }
    }

    $permissions = new permission;
    $permissions->name = 'dashboard access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    // $permissions = new permission;
    // $permissions->name = 'profile access';
    // $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    // $permissions->guard_name = 'web';
    // $permissions->permissions_status = 'business_user';
    // $permissions->save();

    $permissions = new permission;
    $permissions->name = 'my orders access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Order Management access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'My Product access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'My Images access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'My Basket access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'MakeAnOffer access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'wishlist access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Likelist access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'wallet access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'store access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'role access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'shipping access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'business_reports access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'sales_report access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'settings access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_user';
    $permissions->save();

    $permission = permission::get()->toArray();
    if (!empty($permission) && count($permission) > 0) {
      foreach ($permission as $permissionrkey => $permission) {
        $permissionId = $permission['id'];
        $rolePermission = new roleHasPermissions;
        $rolePermission->permission_id = $permissionId;
        $rolePermission->role_id = 2;
        $rolePermission->save();
      }
    }

    $permissions = new permission;
    $permissions->name = 'Dashboard-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    // $permissions = new permission;
    // $permissions->name = 'profile access';
    // $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    // $permissions->guard_name = 'web';
    // $permissions->permissions_status = 'business_user';
    // $permissions->save();

    $permissions = new permission;
    $permissions->name = 'MyOrders-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'OrderManagement-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'MyProduct-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'MyImages-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'MyBasket-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'MakeAnOffer-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Wishlist-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Likelist-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Wallet-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Role-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Shipping-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'BusinessReports-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'SalesReport-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permissions = new permission;
    $permissions->name = 'Settings-Access';
    $permissions->slug = str_replace(' ', '_', strtolower($permissions->name));
    $permissions->guard_name = 'web';
    $permissions->permissions_status = 'business_store_user';
    $permissions->save();

    $permission = permission::get()->toArray();
    if (!empty($permission) && count($permission) > 0) {
      foreach ($permission as $permissionrkey => $permission) {
        $permissionId = $permission['id'];
        $rolePermission = new roleHasPermissions;
        $rolePermission->permission_id = $permissionId;
        $rolePermission->role_id = 3;
        $rolePermission->save();
      }
    }

     /////////////////////////////////////////////

    $modelPermission = new modelHasRoles;
    $modelPermission->role_id = 1;
    $modelPermission->model_type = 'App\Models\User';
    $modelPermission->model_id = 1;
    $modelPermission->save();

    $user_comission = new Commission;
    $user_comission->type = 'commission_user';
    $user_comission->name = 0;
    $user_comission->save();

    $business_user_comission = new Commission;
    $business_user_comission->type = 'commission_business_user';
    $business_user_comission->name = 0;
    $business_user_comission->save();

    $boostPrice = new BoostPrice;
    $boostPrice->boost_price = 0;
    $boostPrice->save();

    $vatPrice = new VatPrice;
    $vatPrice->vat_price = 0;
    $vatPrice->save();

    // $role = new Role;
    // $role->name = 'API User';
    // $role->role_picture = NULL; 
    // $role->role = API_ROLE;
    // $role->status = 1;
    // $role->save();

    // $role = new Role;
    // $role->name = 'User';
    // $role->role_picture = NULL; 
    // $role->role = USER_ROLE;
    // $role->status = 1;
    // $role->save();

    // $role = new Role;
    // $role->name = 'Business';
    // $role->role_picture = NULL; 
    // $role->role = BUSINESS_ROLE;
    // $role->status = 1;
    // $role->save();

    // $role = new Role;
    // $role->name = 'Manager';
    // $role->role_picture = NULL; 
    // $role->role = MANAGER_ROLE;
    // $role->status = 1;
    // $role->save();

    // $role = new Role;
    // $role->name = 'Store Boy';
    // $role->role_picture = NULL; 
    // $role->role = STORE_BOYS_ROLE;
    // $role->status = 1;
    // $role->save();

    // $role = new Role;
    // $role->name = 'Delivery Boy';
    // $role->role_picture = NULL; 
    // $role->role = DELIVERY_BOY_ROLE;
    // $role->status = 1;
    // $role->save();

    /* Site Links Menu  */
    $site_links = config('setting.site_links');
    foreach ($site_links as $val) {
      Menus::create([
        'name' => $val,
        'url' => '#',
        'type' => '1',
        'status' => 1
      ]);
    }

    /* Popular Cities Menu */
    $popularcities = config('setting.popular_cities');
    foreach ($popularcities as $val) {
      Menus::create([
        'name' => $val,
        'url' => '#',
        'type' => '2',
        'status' => 1
      ]);
    }

    /* Useful Links Menu */
    $useful_links = config('setting.useful_links');
    foreach ($useful_links as $val) {
      Menus::create([
        'name' => $val,
        'url' => '#',
        'type' => '3',
        'status' => 1
      ]);
    }

    /* Countries */
    $state = config('setting.country');
    foreach ($state as $key => $val) {
      Country::create([
        'name' => $val,
        'slug' => $val,
        'status' => 1
      ]);
    }

    /* States */
    $state = config('setting.state');
    foreach ($state as $key => $val) {
      State::create([
        'name' => $val,
        'slug' => $val,
        'country_id' => $key,
        'status' => 1
      ]);
    }

    /* Cities */
    $city = config('setting.city');
    foreach ($city as $key => $val) {
      City::create([
        'name' => $val,
        'slug' => $val,
        'country_id' => $key,
        'state_id' => $key,
        'status' => 1
      ]);
    }

    /* Categories */
    $categories = config('setting.categories');
    foreach ($categories as $key => $val) {
      Category::create([
        'category_name' => $val,
        'slug' => $val,
        'cate_picture' => '',
        'status' => 1
      ]);
    }

    /* Sub Categories   */
    $sub_categories = config('setting.sub_categories');
    foreach ($sub_categories as $key => $val) {
      SubCategory::create([
        'category_id' => $key,
        'sub_cate_name' => $val,
        'slug' => $val,
        'sub_cate_picture' => '',
        'status' => 1
      ]);
    }

    /* Brand */
    $brands = config('setting.brand');
    foreach ($brands as $key => $val) {
      Brand::create([
        'sub_category_id' => $key,
        'name' => $val,
        'model' => '',
        'slug' => $val,
        'status' => 1
      ]);
    }

    /* Condition   */
    $conditions = config('setting.condition');
    foreach ($conditions as $key => $val) {
      Condition::create([
        'name' => $val,
        'status' => 1
      ]);
    }

    /* Branch */
    $branches = config('setting.branch');
    foreach ($branches as $key => $val) {
      Branch::create([
        'name' => $val,
        'slug' => $val,
        'status' => 1
      ]);
    }

    /* Store Type  */
    $storeType = config('setting.storeType');
    foreach ($storeType as $key => $val) {
      StoreType::create([
        'name' => $val,
        'slug' => $val,
        'status' => 1
      ]);
    }

    /* Ship Modes Type  */
    $storeType = config('setting.shipModes');
    foreach ($storeType as $key => $val) {
      ShipMode::create([
        'name' => $val,
        'slug' => $val,
        'status' => 1,
      ]);
    }

    /* Delivery Type  */
    $deliveryType = config('setting.deliveryType');
    foreach ($deliveryType as $key => $val) {
      DeliveryType::create([
        'name' => $val,
        'slug' => $val,
        'status' => 1,
      ]);
    }
  }
}
