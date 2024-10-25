<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Camera;
use App\Models\Group;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function index()
    {
        return view('cameras.index');
    }

    public function create()
    {
        $areas = Area::with(['positions'])->get();
        $groups = Group::all();
        return view('cameras.create', ['areas' => $areas, 'groups' => $groups]);
    }

    public function store(Request $request)
    {
        dd($request);
        $validatedData = $request->validate([
            'taskId' => 'nullable|exists:tasks,id',
            'taskName' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'location' => 'nullable|exists:locations,id',
            'path' => 'required|string|max:255',
            'ipAddress' => 'required|ip',
            'port' => 'required|integer',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'status' => 'required|in:hoatdong,ngunghoatdong,dacauhinh,chuacauhinh',
        ]);


        Camera::create($validatedData);

        return redirect('cameras')->with('status', 'Camera Created Successfully');;
    }
}
