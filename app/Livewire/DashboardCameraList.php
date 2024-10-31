<?php

namespace App\Livewire;

use App\Models\Camera;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DashboardCameraList extends Component
{
    public $search = '';

    #[Computed()]
    public function cameras()
    {
        $cacheKey = 'dash_board_cameras_' . $this->search . '_';
        return Cache::remember($cacheKey, Carbon::now()->addMinutes(30), function () {
            return Camera::published()
                ->with(['group', 'position', 'cameraTasks'])
                ->when($this->search, function ($query) {
                    $query->where('ten', 'like', '%' . $this->search . '%');
                })
                ->take(value: Auth::user()->camera_layout)->get();
        });
    }

    #[Computed()]
    public function layout()
    {
        return Auth::user()->camera_layout;
    }

    public function render()
    {
        return view('livewire.dashboard-camera-list');
    }
}