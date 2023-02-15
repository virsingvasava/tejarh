<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menus;
use Lang;

class PopularCityController extends Controller
{
    public function index()
    {
        $menus = Menus::where('type', POPULAR_CITIES)->get();
        return view('admin.menus.popular_city.index',compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.popular_city.create');
    }

    public function store(Request $request) 
    {
        $validatedRequestData = $request->validate([
            'name' => 'required',
            'url' => 'required',
            'status' => 'required', 
        ], [ 
            'name.required' => Lang::get('messages.menus.popular_city.create.validation.please_enter_name'),
            'url.required' => Lang::get('messages.menus.popular_city.create.validation.please_enter_url'),
            'status.required' => Lang::get('messages.menus.popular_city.create.validation.please_select_status'),

        ]);

        $menus = new Menus;
        $menus->name = $request->name;
        $menus->url = $request->url;
        $menus->type = $request->type;
        $menus->status = $request->status;
        $menus->save();

        return redirect()->route('admin.menus.popular_city.index')->with('success', __('messages.menus.popular_city.success.popular_city_added_successfully'));

    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_menu = Menus::where('id',$id)->first();
        return view('admin.menus.popular_city.view',compact('view_menu'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_menu = Menus::where('id',$id)->first();
        return view('admin.menus.popular_city.edit',compact('edit_menu'));

    }

    public function update(Request $request)
    {

        $validatedRequestData = $request->validate([
            'name' => 'required',
            'url' => 'required',
            'status' => 'required', 
        ], [ 
            'name.required' => Lang::get('messages.menus.popular_city.create.validation.please_enter_name'),
            'url.required' => Lang::get('messages.menus.popular_city.create.validation.please_enter_url'),
            'status.required' => Lang::get('messages.menus.popular_city.create.validation.please_select_status'),

        ]);

        $menu_update = Menus::where('id',$request->id)->first();
        $menu_update->name = $request->name;
        $menu_update->url = $request->url;
        $menu_update->type = $request->type;
        $menu_update->status = $request->status;
        $menu_update->save();

        return redirect()->route('admin.menus.popular_city.index')->with('success', __('messages.menus.popular_city.success.popular_city_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->popular_city_menu_id;
        Menus::where('id',$id)->delete();
        return redirect()->route('admin.menus.popular_city.index')->with('error', __('messages.menus.popular_city.success.popular_city_deleted_successfully'));

    }

    public function menu_status_update(Request $request)
    {   
        $status_update = Menus::where('id',$request->menu_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.menus.popular_city.index')->with('success', __('messages.menus.popular_city.success.status_updated_successfully'));
    }
}
