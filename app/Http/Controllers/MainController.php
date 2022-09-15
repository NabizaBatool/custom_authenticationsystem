<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests\{
    AdminRequest,
    LoginRequest
};
use Illuminate\Support\{
    Facades\DB,
    Facades\Hash,
    Facades\Mail,
    Str
};

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
        $input = $request->all();
        $input['password'] =  Hash::make($input['password']);
        $user = User::create($input);
        if ($user) {
            return redirect('/auth/login')->with('success', 'New user has been successfuly added to database');
        } else {
            return back()->with('fail', 'something went wrong , try again later');
        }
    }


    function check(LoginRequest $request)
    {
        $request->validated();
        //search in db using input email and then fetch if matched 
        //userinfo contain db store info
        $userInfo = User::where('email', $request->email)->first();
        if (!$userInfo) {
            return back()->with('fail', 'We do not recognize your email address');
        } else {
            if (Hash::check($request->password, $userInfo->password)) {
                // create session loggeduser mein save krli sari info
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect('/admin/dashboard')->with('success', 'you are logged In');;
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }
    }


    function dashboard()
    {
        //get info of loggeeduser by id 
        //data is array 
        $sessionUserId = session('LoggedUser');
        $user = User::where('id', $sessionUserId)->first();
        return view('admin.dashboard', [
            'LoggedUserInfo' => $user
        ]);

        //Format 2

        // $sessionUserId = session('LoggedUser');
        // $user = User::getById($sessionUserId);
        // return view('admin.dashboard', [
        //     'LoggedUserInfo' => $user
        // ]);
    }


    function logout()
    {
        if (session()->has('LoggedUser')) {
            //destroy session
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }


    function resetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $details = [
            'title' => 'Mail from Auth_system',
            'body' => 'This is for testing email using smtp',
            'token' => $token
        ];
        Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
        // helper function / Traits
        // php multi inheritance allowed or not ????
        // template formatting
        dd("Email is Sent, check it");
    }


    function resetpasswordform($token)
    {
        return view('auth.resetpassform', ['token' => $token]);
    }


    function submitresetpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'newpassword' => 'min:6|required_with:newpasswordconfirm|same:newpasswordconfirm',
            'newpasswordconfirm' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where([
            'token' => $request->token
        ])->first();
        if (!$updatePassword) {
            return back()->withInput()->with('fail', 'Reset Link has expired !');
        }
        User::where('email', $request->email)->first()->update(['password' => Hash::make($request->newpassword)]);
        DB::table('password_resets')->where(['token' => $request->token])->delete();
        return redirect('/auth/login')->with('success', 'your password is updated');
    }
}
