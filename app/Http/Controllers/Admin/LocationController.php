<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

use Lang;

class LocationController extends Controller
{
    public function index() 
    {
        $country = Country::get();
        return view('admin.location.country.index',compact('country'));
    }

    public function create()
    {
        return view('admin.location.country.create');
    }

    public function store(Request $request)
    { 

        $validatedRequestData = $request->validate([

            'name' => 'required',
            'code' => 'required',
            'status' => 'required', 

        ], [
            'name.required' => Lang::get('messages.location.country.create.validation.please_enter_name'),
            'code.required' => Lang::get('messages.location.country.create.validation.please_enter_code'),
            'status.required' => Lang::get('messages.location.country.create.validation.please_select_status'),
        ]);


        $country = new Country;
        $country->name = $request->name;
        $country->code = $request->code;
        $country->status = $request->status;
        $country->save();
        return redirect()->route('admin.location.country.index')->with('success', __('messages.location.country.success.country_added_successfully'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_country = Country::where('id',$id)->first();
        return view('admin.location.country.view',compact('view_country'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_country = Country::where('id',$id)->first();
        return view('admin.location.country.edit',compact('edit_country'));

    }

    public function update(Request $request)
    {

        $validatedRequestData = $request->validate([

            'name' => 'required',
            'code' => 'required',
            'status' => 'required', 

        ], [
            'name.required' => Lang::get('messages.location.country.create.validation.please_enter_name'),
            'code.required' => Lang::get('messages.location.country.create.validation.please_enter_code'),
            'status.required' => Lang::get('messages.location.country.create.validation.please_select_status'),
        ]);

        $country_update = Country::where('id',$request->id)->first();
        $country_update->name = $request->name;
        $country_update->code = $request->code;
        $country_update->status = $request->status;
        $country_update->save();

        return redirect()->route('admin.location.country.index')->with('success', __('messages.location.country.success.country_added_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->country_id;
        Country::where('id',$id)->delete();
        return redirect()->route('admin.location.country.index')->with('error', __('messages.location.country.success.country_added_successfully'));

    }

    public function country_status_update(Request $request)
    {
        $status_update = Country::where('id',$request->country_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.location.country.index')->with('success', __('messages.location.country.success.country_added_successfully'));
    }

    /* States */
    public function state() 
    {
        $states = State::get();
        return view('admin.location.state.index',compact('states'));
    }

    public function create_state()
    {
        $country = Country::get();
        return view('admin.location.state.create', compact('country'));
    }

     public function store_state(Request $request)
    { 

        $validatedRequestData = $request->validate([

            'country_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required', 

        ], [

            'country_id.required' => Lang::get('messages.location.city.create.validation.please_select_country'),
            'name.required' => Lang::get('messages.location.city.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.location.city.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.location.city.create.validation.please_select_status'),
        ]);


        $state = new State;
        $state->country_id = $request->country_id;
        $state->name = $request->name;
        $state->slug = $request->slug;
        $state->status = $request->status;
        $state->save();
        return redirect()->route('admin.location.state.index')->with('success', __('messages.location.state.success.state_added_successfully'));
    }

    public function edit_state($id)
    {
        $id = base64_decode($id);
        $edit_state = State::where('id',$id)->first();
        $countries = Country::get();
        return view('admin.location.state.edit',compact('edit_state', 'countries'));

    }

    public function view_state($id)
    {
        $id = base64_decode($id);
        $view_state = State::where('id',$id)->first();
        return view('admin.location.state.view',compact('view_state'));
    }

    public function update_state(Request $request)
    {

         $validatedRequestData = $request->validate([

            'country_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required', 

        ], [

            'country_id.required' => Lang::get('messages.location.city.create.validation.please_select_country'),
            'name.required' => Lang::get('messages.location.city.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.location.city.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.location.city.create.validation.please_select_status'),
        ]);

        $state_update = State::where('id',$request->id)->first();
        $state_update->country_id = $request->country_id;
        $state_update->name = $request->name;
        $state_update->slug = $request->slug;
        $state_update->status = $request->status;
        $state_update->save();

        return redirect()->route('admin.location.state.index')->with('success', __('messages.location.state.success.state_updated_successfully'));
    }

    public function destroy_state(Request $request)
    {
        $id = $request->state_id;
        State::where('id',$id)->delete();
        return redirect()->route('admin.location.state.index')->with('error',  __('messages.location.state.success.state_deleted_successfully'));

    }
    public function state_status_update(Request $request)
    {
        $status_update = State::where('id',$request->state_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.location.state.index')->with('success', __('messages.location.state.success.status_updated_successfully'));
    }


    /* Cities */
    public function city() 
    {
        $cities = City::get();
        return view('admin.location.city.index',compact('cities'));
    }

    public function create_city()
    {
        $countries = Country::get();
        $states = State::get();
        return view('admin.location.city.create', compact('countries', 'states'));
    }

    public function store_city(Request $request)
    { 
        $validatedRequestData = $request->validate([

            'country_id' => 'required',
            'state_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required', 

        ], [

            'country_id.required' => Lang::get('messages.location.city.create.validation.please_select_country'),
            'state_id.required' => Lang::get('messages.location.city.create.validation.please_select_state'),
            'name.required' => Lang::get('messages.location.city.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.location.city.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.location.city.create.validation.please_select_status'),
        ]);

        $state = new City;
        $state->country_id = $request->country_id;
        $state->state_id = $request->state_id;
        $state->name = $request->name;
        $state->slug = $request->slug;
        $state->status = $request->status;
        $state->save();
        return redirect()->route('admin.location.city.index')->with('success', __('messages.location.city.success.city_added_successfully'));
    }

    public function edit_city($id)
    {
        $id = base64_decode($id);
        $edit_city = City::where('id',$id)->first();
        $countries = Country::get();
        $states = State::get();
        return view('admin.location.city.edit',compact('edit_city', 'countries', 'states'));

    }

    public function view_city($id)
    {
        $id = base64_decode($id);
        $view_city = City::where('id',$id)->first();
        return view('admin.location.city.view',compact('view_city'));
    }

    public function update_city(Request $request)
    {

        $validatedRequestData = $request->validate([

            'country_id' => 'required',
            'state_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required', 

        ], [

            'country_id.required' => Lang::get('messages.location.city.create.validation.please_select_country'),
            'state_id.required' => Lang::get('messages.location.city.create.validation.please_select_state'),
            'name.required' => Lang::get('messages.location.city.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.location.city.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.location.city.create.validation.please_select_status'),
        ]);


        $city_update = City::where('id',$request->id)->first();
        $city_update->country_id = $request->country_id;
        $city_update->state_id = $request->state_id;
        $city_update->name = $request->name;
        $city_update->slug = $request->slug;
        $city_update->status = $request->status;
        $city_update->save();

        return redirect()->route('admin.location.city.index')->with('success', __('messages.location.city.success.city_updated_successfully'));
    }

    public function destroy_city(Request $request)
    {
        $id = $request->city_id;
        City::where('id',$id)->delete();
        return redirect()->route('admin.location.city.index')->with('error', __('messages.location.city.success.city_deleted_successfully'));

    }
    public function city_status_update(Request $request)
    {
        $status_update = City::where('id',$request->city_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.location.city.index')->with('success', __('messages.location.city.success.status_updated_successfully'));
    }

    public function state_listing(Request $request)
    {
        $states = State::where('country_id',$request->country_id)->get();
        return $states;
    }
}
