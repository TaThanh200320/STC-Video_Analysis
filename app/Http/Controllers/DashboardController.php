<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $cameras = Cache::remember('streaming', Carbon::now()->addMinutes(30), function () {
            return Camera::all();
        });
        $layout = Auth::user()->camera_layout;
        return view('dashboard', compact(['cameras', 'layout']));
    }

    public function updateLayout(Request $request)
    {
        // dd($request);
        $request->validate([
            'layout' => 'required|integer|in:4,6,8'
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'camera_layout' => $request->layout
        ]);

        return redirect(route('dashboard'))->with('status', 'Layout Updated Successfully');
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
