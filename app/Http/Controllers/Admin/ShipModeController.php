<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipMode;
use Lang;

class ShipModeController extends Controller
{
    public function index() 
    {
        $shipMode = ShipMode::get();
        return view('admin.ship_mode.index',compact('shipMode'));
    }

    public function create()
    {
        return view('admin.ship_mode.create');
    }

    public function store(Request $request)
    { 
        $validatedRequestData = $request->validate([

            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'name.required' => Lang::get('messages.ship_mode.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.ship_mode.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.ship_mode.create.validation.please_select_status'),
        ]);

        $ship_mode = new ShipMode;
        $ship_mode->name = $request->name;
        $ship_mode->slug = $request->slug;
        $ship_mode->status = $request->status;
        $ship_mode->save();
        return redirect()->route('admin.ship_mode.index')->with('success', __('messages.ship_mode.success.ship_mode_added_successfully'));
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $view_ship_mode = ShipMode::where('id',$id)->first();
        return view('admin.ship_mode.view',compact('view_ship_mode'));
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $edit_ship_mode = ShipMode::where('id',$id)->first();
        return view('admin.ship_mode.edit',compact('edit_ship_mode'));

    }

    public function update(Request $request)
    {

        $validatedRequestData = $request->validate([

            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',

        ], [
            'name.required' => Lang::get('messages.ship_mode.create.validation.please_enter_name'),
            'slug.required' => Lang::get('messages.ship_mode.create.validation.please_enter_slug'),
            'status.required' => Lang::get('messages.ship_mode.create.validation.please_select_status'),
        ]);

        $ship_mode_update = ShipMode::where('id',$request->id)->first();
        $ship_mode_update->name = $request->name;
        $ship_mode_update->slug = $request->slug;
        $ship_mode_update->status = $request->status;
        $ship_mode_update->save();
        return redirect()->route('admin.ship_mode.index')->with('success', __('messages.ship_mode.success.ship_mode_updated_successfully'));
    }

    public function destroy(Request $request)
    {
        $id = $request->ship_mode_id;
        ShipMode::where('id',$id)->delete();
        return redirect()->route('admin.ship_mode.index')->with('error',  __('messages.ship_mode.success.ship_mode_deleted_successfully'));

    }

    public function ship_mode_status_update(Request $request)
    {
        $status_update = ShipMode::where('id',$request->ship_mode_id)->first();
        $status_update->status = $request->status;
        $status_update->save();
        return redirect()->route('admin.ship_mode.index')->with('success', __('messages.ship_mode.success.status_updated_successfully'));
    }
}
