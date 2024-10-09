<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function list()
    {
        $PermissionRole = PermissionRole::getPermission('role', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        $data['$PermissionAdd'] = PermissionRole::getPermission('add-role', Auth::user()->role_id);
        $data['$PermissionEdit'] = PermissionRole::getPermission('edit-role', Auth::user()->role_id);
        $data['$PermissionDelete'] = PermissionRole::getPermission('delete-role', Auth::user()->role_id);
        dd($data['$PermissionAdd']);

        $data['getRecord'] = Role::getRecord();
        return view('panel.role.list', $data);
    }

    public function add()
    {
        $getPermission = Permission::getRecord();
        $data['getPermission'] = $getPermission;
        return view('panel.role.add', $data);
    }

    public function insert(Request $request)
    {
        $save = new Role;
        $save->name = $request->name;
        $save->save();

        PermissionRole::InsertUpdateRecord($request->permission_id, $save->id);

        return redirect('panel/role')->with('success', "Role successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = Role::getSingle($id);
        $data['getPermission'] = Permission::getRecord();
        $data['getRolePermission'] = PermissionRole::getRolePermission($id);
        return view('panel.role.edit', $data);
    }

    public function update($id, Request $request)
    {
        $save = Role::getSingle($id);
        $save->name = $request->name;
        $save->status = $request->status;
        $save->save();

        PermissionRole::InsertUpdateRecord($request->permission_id, $save->id);

        return redirect('panel/role')->with('success', "Role successfully updated");
    }

    public function softDelete($id, Request $request)
    {
        $save = Role::getSingle($id);
        $save->status = "Inactive";
        $save->save();

        return redirect('panel/role')->with('success', "Role successfully removed");
    }

    public function permanentDelete($id)
    {
        $save = Role::getSingle($id);
        $save->delete();

        return redirect('panel/role')->with('success', "Role successfully deleted");
    }
}
