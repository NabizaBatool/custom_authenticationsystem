<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

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
    function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'min:6|required_with:confirmpassword|same:confirmpassword',
            'confirmpassword' => 'min:6'
        ]);
        //insert data into database
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $save = $admin->save();
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

    function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);
        //search in db using input email and then fetch if matched 
        //userinfo contain db store info
        $userInfo = Admin::where('email', '=', $request->email)->first();
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
    function dashboard(){
        //get info of loggeeduser by id 
        //data is array 
        $data = ['LoggedUserInfo'=>Admin::where('id','=', session('LoggedUser'))->first()];
        return view('admin.dashboard', $data);
    }

    function logout(){
        if(session()->has('LoggedUser')){
            //destroy session
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }
}
