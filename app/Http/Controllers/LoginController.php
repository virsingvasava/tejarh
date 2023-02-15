<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        try {
            \DB::connection()->getPdo();

            if(\DB::connection()->getDatabaseName()){
              
            }else{

                $data  = "Could not find the database.";
                return view('frontend.users.layouts.db_connect_fail', compact('data'));


            }
        } catch (\Exception $e) {

             $data  = "Could not open connection to database server.";
            return view('frontend.users.layouts.db_connect_fail', compact('data'));
        }

        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_post(Request $request)
    {
        
        $checkEmail = User::where('email',$request->email)->count();

        if($checkEmail > 0){

            return redirect()->back()->with('danger','Entered Email already used by another User');
        }

        $new_user = new User;
        $new_user->first_name = $request->name;
        $new_user->last_name = null;
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);
        $new_user->phone_number = $request->phone_number;
        $new_user->status = true;
        $new_user->role = USER_ROLE;
        $new_user->save();

        return redirect()->route('login')->with('success','Your Registration Successfully!');
    }

    public function submit(Request $request)
    {

        try {
            \DB::connection()->getPdo();

            if(\DB::connection()->getDatabaseName()){

            }else{
                $data  = "Could not find the database.";
                return view('frontend.users.layouts.db_connect_fail', compact('data'));
            }
        } catch (\Exception $e) {

            $data  = "Could not open connection to database server.";
            return view('frontend.users.layouts.db_connect_fail', compact('data'));
        }

        $email = $request->email;

        $password = $request->password;

        $user = User::where('email',$email)->first();

        if(!empty($user)){
            
            $check_password = Hash::check($password, $user->password);

            if($check_password){
                if($user->role_user == 'admin'){

                    Auth::attempt(array('email' => $email, 'password' => $password));

                    return redirect()->route('admin.dashboard');

                } 
                /*
                else if($user->role == USER_ROLE){

                    Auth::attempt(array('email' => $email, 'password' => $password));

                    // As per your require set the redirect here.. like fronted///
                    return redirect()->route('admin.dashboard');

                } else if($user->role == BUSINESS_ROLE){

                    Auth::attempt(array('email' => $email, 'password' => $password));

                    // As per your require set the redirect here..///
                    return redirect('admin/about.php');

                } 
                */
                else {

                    return redirect()->back()->with('danger','Please enter valid credentials');
                }
            } else {

                return redirect()->back()->with('danger','Please enter valid credentials');
            }
        } else {

            return redirect()->back()->with('danger','Entered details not found');
        }
    }
    
}
