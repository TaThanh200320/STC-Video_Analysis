<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StreamingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login']);

Route::group(['middleware' => ['role:super-admin|admin|editor']], function () {
    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

    Route::get('locations/areas', [AreaController::class, 'index'])->name('locations.areas');
    Route::get('locations/areas/create', [AreaController::class, 'create'])->name('locations.areas.create');
    Route::post('locations/areas/store', [AreaController::class, 'store'])->name('locations.areas.store');
    Route::get('locations/areas/{areaId}/edit', [AreaController::class, 'edit'])->name('locations.areas.edit');
    Route::put('locations/areas/{areaId}', [AreaController::class, 'update'])->name('locations.areas.update');
    Route::get('locations/areas/{areaId}/delete', [AreaController::class, 'destroy']);

    Route::get('locations/positions', [PositionController::class, 'index'])->name('locations.positions');
    Route::get('locations/positions/create', [PositionController::class, 'create'])->name('locations.positions.create');
    Route::post('locations/positions/store', [PositionController::class, 'store'])->name('locations.positions.store');
    Route::get('locations/positions/{positionId}/edit', [PositionController::class, 'edit'])->name('locations.positions.edit');
    Route::put('locations/positions/{positionId}', [PositionController::class, 'update'])->name('locations.positions.update');
    Route::get('locations/positions/{areaId}/delete', [PositionController::class, 'destroy']);

    Route::get('cameras/groups', [GroupController::class, 'index'])->name('cameras.groups');
    Route::get('cameras/groups/create', [GroupController::class, 'create'])->name('cameras.groups.create');
    Route::post('cameras/groups/store', [GroupController::class, 'store'])->name('cameras.groups.store');
    Route::get('cameras/groups/{areaId}/edit', [GroupController::class, 'edit'])->name('cameras.groups.edit');
    Route::put('cameras/groups/{areaId}', [GroupController::class, 'update'])->name('cameras.groups.update');
    Route::get('cameras/groups/{areaId}/delete', [GroupController::class, 'destroy']);

    Route::get('cameras/tasks', [GroupController::class, 'index'])->name('cameras.tasks');
    Route::get('cameras/tasks/create', [GroupController::class, 'create'])->name('cameras.tasks.create');
    Route::post('cameras/tasks/store', [GroupController::class, 'store'])->name('cameras.tasks.store');
    Route::get('cameras/tasks/{areaId}/edit', [GroupController::class, 'edit'])->name('cameras.tasks.edit');
    Route::put('cameras/tasks/{areaId}', [GroupController::class, 'update'])->name('cameras.tasks.update');
    Route::get('cameras/tasks/{areaId}/delete', [GroupController::class, 'destroy']);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('cameras', CameraController::class);
    Route::get('/cameras', [CameraController::class, 'index'])->name('camera.show');

    Route::get('/dashboard', [StreamingController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/stream/{cameraId}', [StreamingController::class, 'stream']);

    Route::get('/user/profile', function () {
        return view('profile.show');
    })->name('profile.show');

    Route::get('/user/profile/authentication', function () {
        return view('profile.authentication');
    })->name('profile.authentication');

    Route::get('/user/profile/update-password', function () {
        return view('profile.update-password');
    })->name('profile.update-password');
});
