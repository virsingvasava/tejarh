<?php

namespace App\Http\Controllers\Api\BusinessUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Branch;
use App\Models\User;
use Validator;
use JWTAuth;
use Response;
use JWTFactory;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Mail; 

class BranchController extends Controller
{
    public function getBranchList(Request $request)
    {
        $branch_list = Branch::all();  
        if(empty($branch_list)){
            $message = "Branch not found";
            return InvalidResponse($message,101);
        }
        $message = 'Fetch branch successfully.';
        return SuccessResponse($message,200,$branch_list);
    }
}