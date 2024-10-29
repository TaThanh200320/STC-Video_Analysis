<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Camera;
use App\Models\Group;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class CameraController extends Controller
{
    public function index()
    {
        $cameras = Cache::remember('cameras_index', Carbon::now()->addMinutes(30), function () {
            return Camera::select('ten', 'id')->get();
        });
        return view('cameras.index', compact('cameras'));
    }

    public function create()
    {
        $areas = Cache::remember('areas_in_cameras', Carbon::now()->addMinutes(30), function () {
            return Area::with(['positions'])->get();
        });

        $groups = Cache::remember('groups_in_cameras', Carbon::now()->addMinutes(30), function () {
            return Group::all();
        });

        $tasks = Cache::remember('tasks_in_cameras', Carbon::now()->addMinutes(30), function () {
            return Task::all();
        });
        return view('cameras.create', ['areas' => $areas, 'groups' => $groups, 'tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'taskId' => 'nullable|exists:tacvu,id',
            'parameters' => 'nullable|json|',
            'name' => 'required|string|max:255',
            'locationId' => 'nullable|exists:vitri,id',
            'path' => 'required|string|max:255',
            'ipAddress' => 'required|ip',
            'port' => 'required|integer',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'groupId' => 'nullable|exists:nhom,id',
            'status' => 'required|in:hoatdong,ngunghoatdong,dacauhinh,chuacauhinh',
        ]);

        $cameraData = [
            'ten' => $validatedData['name'],
            'duongdan' => $validatedData['path'],
            'diachiip' => $validatedData['ipAddress'],
            'cong' => $validatedData['port'],
            'tendangnhap' => $validatedData['username'],
            'matkhau' => Crypt::encryptString($validatedData['password']),
            'trangthai' => $validatedData['status'],
            'nhomid' => $validatedData['groupId'] ?? null,
            'vitriid' => $validatedData['locationId'] ?? null,
        ];


        $camera = Camera::create($cameraData);

        if (!empty($validatedData['taskId']) && !empty($validatedData['parameters'])) {
            $camera->cameraTasks()->attach($validatedData['taskId'], [
                'cauhinh' => $validatedData['parameters'],
            ]);
        }

        return redirect()->back()->with('status', 'Camera Created Successfully');
    }

    public function edit($cameraId)
    {
        $camera = Camera::with('position', 'group', 'cameraTasks')->findOrFail($cameraId);
        $areas = Cache::remember('areas_in_cameras', Carbon::now()->addMinutes(30), function () {
            return Area::with(['positions'])->get();
        });
        $groups = Cache::remember('groups_in_cameras', Carbon::now()->addMinutes(30), function () {
            return Group::all();
        });
        $tasks = Cache::remember('tasks_in_cameras', Carbon::now()->addMinutes(30), function () {
            return Task::all();
        });
        return view('cameras.edit', ['camera' => $camera, 'areas' => $areas, 'groups' => $groups, 'tasks' => $tasks]);
    }

    public function update(Request $request, $cameraId)
    {
        $camera = Camera::findOrFail($cameraId);

        $validatedData = $request->validate([
            'taskId' => 'nullable|exists:tacvu,id',
            'parameters' => 'nullable|json|',
            'name' => 'nullable|string|max:255',
            'locationId' => 'nullable|exists:vitri,id',
            'path' => 'nullable|string|max:255',
            'ipAddress' => 'nullable|ip',
            'port' => 'nullable|integer',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'groupId' => 'nullable|exists:nhom,id',
            'status' => 'nullable|in:hoatdong,ngunghoatdong,dacauhinh,chuacauhinh',
        ]);

        $cameraData = [
            'ten' => $validatedData['name'],
            'duongdan' => $validatedData['path'],
            'diachiip' => $validatedData['ipAddress'],
            'cong' => $validatedData['port'],
            'tendangnhap' => $validatedData['username'],
            'trangthai' => $validatedData['status'],
            'nhomid' => $validatedData['groupId'] ?? null,
            'vitriid' => $validatedData['locationId'] ?? null,
        ];

        if (!empty($request->password)) {
            $cameraData += [
                'matkhau' => Crypt::encryptString($validatedData['password']),
            ];
        }

        $camera->update($cameraData);
        return redirect()->back()->with('status', 'Camera Updated Successfully');
    }

    public function getRtspUrl($id)
    {
        $url = Cache::remember("camera_url_{$id}", Carbon::now()->addMinutes(30), function () use ($id) {
            $camera = Camera::find($id);
            return $camera ? $camera->getRtspUrl() : null;
        });

        if (!$url) {
            return response()->json([
                'error' => 'Camera not found or inactive'
            ], 404);
        }

        return response()->json([
            'rtspUrl' => $url
        ]);
    }

    public function destroy($cameraId)
    {
        $camera = Camera::findOrFail($cameraId);
        $camera->delete();

        return redirect('/cameras')->with('status', 'Role Delete Successfully');
    }

    public function getActiveCameras()
    {
        $cameras = Cache::remember('active_cameras', Carbon::now()->addMinutes(30), function () {
            return Camera::where('trangthai', '=', 'hoatdong')->get();
        });

        return response()->json([
            'cameras' => $cameras
        ]);
    }
}
