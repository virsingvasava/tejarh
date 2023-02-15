<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    EmailLog,
    User,
};

class EmailLogsController extends Controller
{

    public function index() 
    { 
        $emailLogsArr = EmailLog::all();
        return view('admin.email_logs.index',compact('emailLogsArr'));
    }
}
