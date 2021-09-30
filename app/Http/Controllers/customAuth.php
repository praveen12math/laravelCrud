<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;

class customAuth extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:4'
        ]);



        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);

        $res = $user->save();

        if ($res) {
            return back()->with('success', 'register success');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }



    public function loginUser(Request $request)
    {


        $user = User::where('email', '=', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                $request->session()->put('email', $user->email);
                $request->session()->put('name', $user->name);
                $request->session()->put('userId', $user->id);
                //   $request->session()->put('role', $user->role);
                // print_r($user->role);
                // die();
                //return  print_r(Session::get('role'));

                $authPage = Role::find($user->role);

                $request->session()->put('userRole', $authPage->role);

                if ($authPage->role == "user") {
                    return redirect('/user');
                } else{
                    return redirect('/admin');
                }
            } else {
                return back()->with('fail', 'Invalid Credentials');
            }
        }
        return back()->with('fail', 'User not registered with our system');
    }



    public function dashboard()
    {
        $userData = DB::table('users')->where('id', Session::get('userId'))->get();

        return view('userDashboard', compact('userData'));
    }


    public function adminDashboard()
    {
        $userData = array();
        $roleData = array();

        $allUser = User::all();
        $allRole = Role::all();


        return view('adminDashboard', compact('allRole', 'allUser'));
    }

}
