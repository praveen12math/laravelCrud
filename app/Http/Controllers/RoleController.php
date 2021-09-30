<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //

    function addRole(Request $res)
    {

        $res->validate([
            'role' => 'required | unique:roles'
        ]);

        $role = new Role();

        $role->role = $res->role;

        $resp = $role->save();

        if ($resp) {
            return back()->with('successAddRole', 'Role add success');
        } else {
            return back()->with('failAddRole', 'Something went wrong');
        }
    }

    public function deleteRole($myId){
        $isRoleAssociate = array();
        $isRoleAssociate = DB::table('users')->where('role', $myId)->get();
        
        if(count($isRoleAssociate)<1){
        
            $data = Role::find($myId);
            if($data->delete())
                return back()->with('successDeleteRole', 'Role deleted');
            else
                return back()->with('faildeleteRole', 'Something went wrong');
        }
        else{
            return back()->with('failDeleteRole', 'With this role a user already associated.
                                You are not allowed to delete this.');
        }
    }


    public function showRole($myId){
        $data = Role::find($myId);
        return view('editRole', ['data'=>$data]);
    }

    public function seeRole($myId){
        $data = Role::find($myId);
        return view('showRole', ['data'=>$data]);
    }


    public function updateRole(Request $res){

        $myValidate = DB::table('roles')->where('role', $res->role)->get();

        if(count($myValidate)<1){
            $data = Role::find($res->id);
            $data->role = $res->role;
            if($data->save()){
                return redirect("/admin")->with('successUpdateRole', 'Role Updated');
            }
            else
                return back()->with('failUpdateRole', 'Something went wrong');
        }
        else{
            return back()->with('failUpdateRole', 'This role already exist.');
        }

        // return redirect("/admin");

    }

}
