<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class sliderController extends Controller
{
    public function slider(Request $request)
    {
        $inputData = $request->all();

        $slider = Slider::get();
        // dd($slider);
        if (empty($slider)) {
            $message = "Unused item detail not found";
            return InvalidResponse($message, 101);
        }
        $message = 'Fetch Silder successfully.';
        return SuccessResponse($message, 200, $slider);
    }
}
