<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function index($lang)
    {
        if(!App::isLocale($lang)){
            \Session::put('applocale', $lang);
            App::setLocale($lang);
        }

        return redirect()->back();
    }

    public function post(Request $request)
    {
       
    	$lang = $request->lang;
    	if(!App::isLocale($lang)){
            \Session::put('applocale', $lang);
            App::setLocale($lang);
        }
    	echo 'true';
    }
}
