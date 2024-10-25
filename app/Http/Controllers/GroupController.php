<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::get();
        return view('cameras.groups.index', ['groups' => $groups]);
    }

    public function create()
    {
        return view('cameras.groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:khuvuc,chucnang'
        ]);

        $data = [
            'ten' => $request->name,
            'mota' => $request->description,
            'loainhom' => $request->type
        ];

        Group::create($data);

        return redirect('/cameras/groups')->with('status', 'Group created successfully');
    }

    public function edit($groupId)
    {
        $group = Group::findOrFail($groupId);

        return view('cameras.groups.edit', [
            'group' => $group,
        ]);
    }

    public function update(Request $request, $groupId)
    {
        $group = Group::findOrFail($groupId);
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:khuvuc,chucnang'
        ]);
        $data = [
            'ten' => $request->name,
            'mota' => $request->description,
            'loainhom' => $request->type
        ];

        $group->update($data);

        return redirect('/cameras/groups')->with('status', 'Group Updated Successfully');
    }

    public function destroy($groupId)
    {
        $group = Group::findOrFail($groupId);
        $group->delete();

        return redirect('/cameras/groups')->with('status', 'Group Delete Successfully');
    }
}
