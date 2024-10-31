<?php

namespace App\Livewire;

use App\Models\Camera;
use App\Models\Group;
use App\Models\Position;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CameraList extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';
    #[Url()]
    public $groupId = '';
    #[Url()]
    public $positionId = '';
    #[Url()]
    public $taskId = '';
    #[Url()]
    public $sort = 'desc';

    public $page = 1;

    // protected $queryString = [
    //     'search' => ['except' => ''],
    //     'groupId' => ['except' => ''],
    //     'positionId' => ['except' => ''],
    //     'taskId' => ['except' => ''],
    //     'sort' => ['except' => 'desc'],
    //     'page' => ['except' => 1],
    // ];

    public function setSort($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc';
    }

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }
    public function clearFilters()
    {
        $this->reset(['search', 'groupId', 'positionId', 'taskId', 'sort']);
        $this->resetPage();
    }

    #[Computed]
    public function cameras()
    {
        $cacheKey = 'cameras_' . $this->search . '_' . $this->groupId . '_' . $this->positionId . $this->taskId . $this->sort;
        return Cache::remember($cacheKey, Carbon::now()->addMinutes(30), function () {
            return Camera::published()
                ->with(['group', 'position', 'cameraTasks'])
                ->when($this->search, function ($query) {
                    $query->where('ten', 'like', '%' . $this->search . '%');
                })
                ->when($this->groupId, function ($query) {
                    $query->where('nhomid', $this->groupId);
                })
                ->when($this->positionId, function ($query) {
                    $query->where('vitriid', $this->positionId);
                })
                ->when($this->taskId, function ($query) {
                    $query->whereHas('cameraTasks', function ($q) {
                        $q->where('tacvuid', $this->taskId);
                    });
                })
                ->orderBy('created_at', $this->sort)
                ->paginate(6);
        });
    }

    #[Computed]
    public function groups()
    {
        return Cache::remember('groups', Carbon::now()->addMinutes(10), fn() => Group::all());
    }

    #[Computed]
    public function positions()
    {
        return Cache::remember('positions', Carbon::now()->addMinutes(10), fn() => Position::all());
    }

    #[Computed]
    public function tasks()
    {
        return Cache::remember('tasks', Carbon::now()->addMinutes(10), fn() => Task::all());
    }

    public function render()
    {
        return view('livewire.camera-list');
    }
}