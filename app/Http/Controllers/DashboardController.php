<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Camera;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $locations = $this->getLocationGroups();
        $cameras = Cache::remember('streaming', Carbon::now()->addMinutes(30), function () {
            return Camera::all();
        });
        return view('dashboard', compact('locations', 'cameras'));
    }

    public function getCameras(Request $request)
    {
        $locationId = $request->input('locationId');

        $cameras = Camera::published()
            ->with(['group', 'position', 'cameraTasks'])
            ->when($locationId, function ($query) use ($locationId) {
                $query->whereHas('position', function ($q) use ($locationId) {
                    $q->where('khuvucid', $locationId);
                });
            })
            ->get();

        return response()->json($cameras);
    }

    private function getLocationGroups()
    {
        return Cache::remember('location_groups', now()->addMinutes(30), function () {
            return Area::with(['positions' => function ($query) {
                $query->with(['cameras' => function ($q) {
                    $q->select('id', 'ten', 'vitriid');
                }])->withCount('cameras');
            }])->get()->map(function ($area) {
                return [
                    'label' => $area->ten,
                    'id' => $area->id,
                    'positions' => $area->positions->map(function ($position) {
                        return [
                            'label' => $position->ten,
                            'id' => $position->id,
                            'camera_count' => $position->cameras_count,
                            'cameras' => $position->cameras->map(function ($camera) {
                                return [
                                    'id' => $camera->id,
                                    'label' => $camera->ten
                                ];
                            })
                        ];
                    })
                ];
            });
        });
    }

    public function stream(Request $request, $cameraId)
    {
        $camera = $this->getCameraById($cameraId);

        if (!$camera) {
            return response()->json(['error' => 'Camera not found'], 404);
        }

        $nodeServerUrl = env('NODE_SERVER_URL', 'http://localhost:3000');
        $response = Http::get("{$nodeServerUrl}/api/stream/{$cameraId}");

        return $response->body();
    }

    private function getCameraById($id)
    {
        $cameras = Camera::findOrFail($id)->select('ten', 'id');

        return $cameras[$id] ?? null;
    }
}
