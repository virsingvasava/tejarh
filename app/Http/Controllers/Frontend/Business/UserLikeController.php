<?php

namespace App\Http\Controllers\Frontend\Business;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemsImages;
use App\Models\UserLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class UserLikeController extends Controller
{
    public function add_to_like(Request $request)
    {
        $userId = Auth::user()->id;
        $checkLike = DB::select('select * from user_likes where user_id=? && item_id=?', [$userId, $request->item_id]);

        if (!empty($checkLike)) {

            $like_update = UserLike::where(['item_id' => $request->item_id])->first();
            $like_update->user_id = Auth::user()->id;
            $like_update->item_id = $request->item_id;
            $like_update->customer_id =  true;
            $like_update->like_status = $request->like_status;
            $like_update->save();


            if ($like_update->like_status == 0) {
                return response()->json(['status' => 0, 'code' => 200, 'success' => Lang::get('Like updated success')], 200);
            }
            else {
                return response()->json(['status' => 1, 'code' => 200, 'success' => Lang::get('Like added Successfully')], 200);
            }
        } else {

            $like = new UserLike;
            $like->user_id = Auth::user()->id;
            $like->item_id = $request->item_id;
            $like->customer_id = true;
            $like->like_status = $request->like_status;
            $like->save();
            return response()->json(['status' => $like->like_status, 'code' => 200, 'success' => Lang::get('Like added Successfully')], 200);
        }
    }

    public function index(){
        $user = Auth::user();
        $likelists = UserLike::with('items')
            ->where('user_id', $user->id)
            ->where('like_status', 1)
            ->orderby('id', 'desc')
            ->get()
            ->toArray();

        $itemArray = [];
        foreach ($likelists as $key => $value) {
            $itemArray[$key] = $value;
            $items = Item::where('id', $value['item_id'])->where('status','=','1')->first();
            $itemArray[$key]['items'] = $items;
            
            $itemsImage = ItemsImages::where('id', $value['item_id'])->first();
            $itemArray[$key]['item_pictures'] = $itemsImage;
        }
        return view('frontend.business.pages.like', compact('user', 'itemArray'));
    }

    public function likelist_removed(Request $request)
    {
        $id = $request->likelist_id;
        UserLike::where('id', $id)->delete();
        return response()->json(['code' => 200, 'success' => Lang::get('Likelist removed Successfully')], 200);
    }
}
