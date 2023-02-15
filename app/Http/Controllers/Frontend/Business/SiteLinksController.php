<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;

class SiteLinksController extends Controller
{
    public function aboutUs(){
        $about_us_title = CmsPage::where('slug','=','about_us')->first();
        $about_us_des = CmsPage::where('slug','=','about_us')->where('status',1)->first();
        return view('frontend.business.site_links.about_us',compact('about_us_title','about_us_des'));
    }

    public function location(){
        return view('frontend.business.site_links.location');
    }

    public function couponsOffers(){
        return view('frontend.business.site_links.couponsOffers');
    }

    public function contactUs(){
        $contact_us_title = CmsPage::where('slug','=','contact_us')->first();
        $contact_us_des = CmsPage::where('slug','=','contact_us')->where('status',1)->first();
        return view('frontend.business.site_links.contactUs',compact('contact_us_title','contact_us_des'));
    }

    public function careers(){
        $careers_title = CmsPage::where('slug','=','careers')->first();
        $careers_des = CmsPage::where('slug','=','careers')->where('status',1)->first();
        return view('frontend.business.site_links.careers',compact('careers_title','careers_des'));
    }

    public function faq(){
        return view('frontend.business.site_links.faq');
    }

    public function termsCondition(){
        $termsCondition_title = CmsPage::where('slug','=','terms-condition')->first();
        $termsCondition_des = CmsPage::where('slug','=','terms-condition')->where('status',1)->first();
        return view('frontend.business.site_links.termsCondition',compact('termsCondition_title','termsCondition_des'));
    }

    public function termsOfUse(){
        $termsOfUse_title = CmsPage::where('slug','=','term_of_use')->first();
        $termsOfUse_des = CmsPage::where('slug','=','term_of_use')->where('status',1)->first();
        return view('frontend.business.site_links.terms_of_use',compact('termsOfUse_title','termsOfUse_des'));
    }

    public function trackOrder(){
        $track_Order_tital = CmsPage::where('slug','=','track_order')->first();
        $trackOrder_des = CmsPage::where('slug','=','track_order')->where('status',1)->first();
        return view('frontend.business.site_links.trackOrder',compact('track_Order_tital','trackOrder_des'));
    }

    public function shipping(){
        $shipping_title = CmsPage::where('slug','=','shipping')->first();
        $shipping_des = CmsPage::where('slug','=','shipping')->where('status',1)->first();
        return view('frontend.business.site_links.shipping',compact('shipping_title','shipping_des'));
    }

    public function cancellation(){
        $cancellation_title = CmsPage::where('slug','=','cancellation')->first();
        $cancellation_des = CmsPage::where('slug','=','cancellation')->where('status',1)->first();
        return view('frontend.business.site_links.cancellation',compact('cancellation_title','cancellation_des'));
    }

    public function returnOrder(){
        $returnorder_title = CmsPage::where('slug','=','return_order')->first();
        $returnorder_des = CmsPage::where('slug','=','return_order')->where('status',1)->first();
        return view('frontend.business.site_links.returnOrder',compact('returnorder_title','returnorder_des'));
    }

    public function whitehat(){
        return view('frontend.business.site_links.whitehat');
    }

    public function blog(){
        return view('frontend.business.site_links.blog');
    }

    public function privacyPolicy(){
        $privacyPolicy_title = CmsPage::where('slug','=','privacy_policy')->first();
        $privacyPolicy_des = CmsPage::where('slug','=','privacy_policy')->where('status',1)->first();
        return view('frontend.business.site_links.privacyPolicy',compact('privacyPolicy_title','privacyPolicy_des'));
    }

    public function siteMap(){
        $sitemap_title = CmsPage::where('slug','=','site_map')->first();
        $sitemap_des = CmsPage::where('slug','=','site_map')->where('status',1)->first();
        return view('frontend.business.site_links.siteMap',compact('sitemap_title','sitemap_des'));
    }

    public function supportPage(){
        return view('frontend.business.site_links.support');
    }
}
