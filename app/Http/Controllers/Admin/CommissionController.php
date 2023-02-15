<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoostPrice;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Commission;
use App\Models\StoryPrice;
use App\Models\VatPrice;
use Illuminate\Support\Str;
use File;
use Lang;

class CommissionController extends Controller
{

    public function index()
    {
        $commission_data = Commission::where('type','commission_user')->first();

        $commission_user = '';
        $commission_business_user = '';
        
        if(!empty($commission_data)){
            $commission_user = $commission_data->name;            
        }

        $commission_business_user_data = Commission::where('type','commission_business_user')->first();
        if(!empty($commission_business_user_data)){
            $commission_business_user = $commission_business_user_data->name;            
        }

        $story_price_data = StoryPrice::select('story_price')->pluck('story_price');
        $story_price = '';
        if(!empty($story_price_data[0])){
            
            $story_price = $story_price_data[0];            
        }

        $boost_price_data = BoostPrice::select('boost_price')->pluck('boost_price');
        $boost_price = '';
        if(!empty($boost_price_data[0])){
            
            $boost_price = $boost_price_data[0];            
        }

        $vat_price_data = VatPrice::select('vat_price')->pluck('vat_price');
        $vat_price = '';
        if(!empty($vat_price_data[0])){
            
            $vat_price = $vat_price_data[0];            
        }

        return view('admin.commission.index',compact('commission_user','commission_business_user','story_price','boost_price','vat_price'));

    }
    
    public function commission_update(Request $request)
    {
      
        $commission_user = Commission::where('type','commission_user')->first();
        if(empty($commission_user)){

            $commission_user = new Commission;
            $commission_user->type = "commission_user";
            $commission_user->name = $request->commission_user;
            $commission_user->save();

        } else {
            $commission_user->type = "commission_user";
            $commission_user->name = $request->commission_user;
            $commission_user->save();
        }

        $commission_business_user = Commission::where('type','commission_business_user')->first();
        if(empty($commission_business_user)){

            $commission_business_user = new Commission;
            $commission_business_user->name = $request->commission_business_user;
            $commission_business_user->type = "commission_business_user";
            $commission_business_user->save();

        } else {
            $commission_business_user->type = "commission_business_user";
            $commission_business_user->name = $request->commission_business_user;
            $commission_business_user->save();

        }

        $story_price = StoryPrice::where('status','1')->first();
        if(empty($story_price)){

            $story_price = new StoryPrice;
            $story_price->story_price = $request->story_price;
            $story_price->status = "1";
            $story_price->save();

        } else {
            $story_price->story_price = $request->story_price;
            $story_price->status = "1";
            $story_price->save();
        }

        $boost_price = BoostPrice::first();
        if(empty($boost_price)){

            $boost_price = new BoostPrice;
            $boost_price->boost_price = $request->boost_price;
            $boost_price->save();

        } else {
            $boost_price->boost_price = $request->boost_price;
            $boost_price->save();
        }

        $vat_price = VatPrice::first();
        if(empty($vat_price)){

            $vat_price = new VatPrice;
            $vat_price->vat_price = $request->vat_price;
            $vat_price->save();

        } else {
            $vat_price->vat_price = $request->vat_price;
            $vat_price->save();
        }
      
        return redirect()->route('admin.commission.index')->with('success', __('messages.commission.success.commission_added_successfully'));

    }

    public function create()
    {
        $sub_category = SubCategory::get();
        return view('admin.brand.create',compact('sub_category'));
    }


    public function view($id)
    {
        $id = base64_decode($id);
        $view_brand = Brand::where('id',$id)->first();
        return view('admin.brand.view',compact('view_brand'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_brand = Brand::where('id',$id)->first();
        $subCategory = SubCategory::get();
        return view('admin.brand.edit',compact('edit_brand', 'subCategory'));

    }

    public function update(Request $request)
    {

        $validatedRequestData = $request->validate([
            'sub_category_id' => 'required',
            'name' => 'required',
            'model' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'sub_category_id.required' => Lang::get('messages.brand.create.validation.please_select_sub_category'),
            'name.required' => Lang::get('messages.brand.create.validation.please_enter_name'),
            'model.required' => Lang::get('messages.brand.create.validation.please_enter_model'),
            'slug.required' => Lang::get('messages.brand.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.brand.create.validation.please_select_status'),
        ]);

        $brand_update = Brand::where('id',$request->id)->first();
        $brand_update->sub_category_id = $request->sub_category_id;
        $brand_update->name = $request->name;
        $brand->model = $request->model;
        $brand_update->slug = Str::slug($request->slug);
        $brand_update->status = $request->status;
        $brand_update->save();
        return redirect()->route('admin.commission.index')->with('success', __('messages.commission.success.commission_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->commission_id;
        Commission::where('id',$id)->delete();
        return redirect()->route('admin.commission.index')->with('error',__('messages.commission.success.commission_deleted_successfully'));

    }

    public function commission_status_update(Request $request)
    {
        $status_update = Commission::where('id',$request->commission_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.commission.index')->with('success',__('messages.commission.success.status_updated_successfully'));
    }
}


