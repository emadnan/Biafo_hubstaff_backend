<?php

namespace App\Http\Controllers;
use App\Models\Permission;

use App\Models\PermissionsRole;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    function add_permissions(){
        $permission = new Permission();
        $permission->name = \Request::input('name');
        $permission->guard_name = 'APi11';
        $permission->save();
        return response()->json(['message'=>'Add Permission successfully']);
    }

    function updatepermission(){
        $id = \Request::input('id');
        $permission = Permission::where('id',$id)
        ->update([
            'name' => \Request::input('name'),
            'guard_name' => 'API'
        ]);

        return response()->json(['Message' => 'Permission Updated']);
    }

    public function get_permissions()
    {
        $permission = Permission::get();
        return response()->json(['permissions' => $permission]);
    }

    function delete_permission(){
        $id = \Request::input('id');
        $permission = Permission::where('id',$id)->delete();

        return response()->json(['message'=>'delete permission successfully']);
    }

    public function get_permissions_by_id($id)  {

        $permission = Permission::where('id',$id)->get();
        return response()->json(['permissions' => $permission]);
    }

    public function get_permission_by_id($role){

        $permission = PermissionsRole::where('role_id',$role)->get();

        return response()->json(['Permission' => $permission]);
    }

}
