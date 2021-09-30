<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function showUserData($id)
    {

        $data = User::find($id);

        return view('edit', ['data' => $data]);
    }

    function seeUserData($id){
        $data = User::find($id);

        return view('showUser', ['data' => $data]);
    }


    function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required | email'
        ]);

        $data = User::find($request->id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->role = $request->role;

        $data->save();

        return redirect('/admin');
    }

    function deleteUser($userId)
    {

        $data = User::find($userId);

        $data->delete();

        return redirect('/user');
    }

    function addUser(Request $res)
    {
        $res->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:4'
        ]);



        $user = new User();
        $user->name = $res->name;
        $user->email = $res->email;
        $user->phone = $res->phone;
        $user->role = $res->role;
        $user->password = Hash::make($res->password);

        $resp = $user->save();

        if ($resp) {
            return back()->with('successAddUser', 'User add success');
        } else {
            return back()->with('failAddUser', 'Something went wrong');
        }
    }
}
