<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Permission::getRecord();
        return view('panel.permission.list', $data);
    }

    public function add()
    {
        return view('panel.permission.add');
    }

    public function insert(Request $request)
    {
        $save = new Permission;
        $save->name = $request->name;
        $save->slug = $request->slug;
        $save->groupBy = $request->groupby;
        $save->save();

        return redirect('panel/permission')->with('success', "Permission successfully created");
    }
}