<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    //
    function login()
    {
        return view('auth.login');
    }


    function register()
    {
        return view('auth.register');
    }


    function save(AdminRequest $request)
    {
        $request->validated();
        //insert data into database
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();
        // save in users table 2nd method 
        // User::create([
        //     'name'=>$request->name,
        //     'email'=>$request->email,
        //     'password'=> \Hash::make($request->password)
        // ]);

        if ($save) {
            return back()->with('success', 'New user has been successfuly added to database');
        } else {
            return back()->with('fail', 'something went wrong , try again later');
        }
    }


    function check(LoginRequest $request)
    {
        $request->validated();
        //search in db using input email and then fetch if matched 
        //userinfo contain db store info
        $userInfo = User::where('email', '=', $request->email)->first();
        if (!$userInfo) {
            return back()->with('fail', 'We do not recognize your email address');
        } else {
            if (Hash::check($request->password, $userInfo->password)) {
                // create session loggeduser mein save krli sari info
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect('/admin/dashboard');
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }
    }


    function dashboard()
    {
        //get info of loggeeduser by id 
        //data is array 
        $data = ['LoggedUserInfo' => User::where('id', '=', session('LoggedUser'))->first()];
        return view('admin.dashboard', $data);
    }


    function logout()
    {
        if (session()->has('LoggedUser')) {
            //destroy session
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }


    function resetEmail(Request $request , $token)
    {
        $request->validate(['token' => 'required'  , 'email' => 'required|email' 
        ]);
        return view('welcome' , ['token'=> $token]);
        
    }
}
