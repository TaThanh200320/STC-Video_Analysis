<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Middleware\PermissionMiddleware;


class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(PermissionMiddleware::using('view user'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create user'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('update user'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete user'), only: ['destroy']),
        ];
    }

    public function index()
    {
        $users = Cache::remember('users', Carbon::now()->addMinutes(30), function () {
            return User::get();
        });
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Cache::remember('roles_in_users', Carbon::now()->addMinutes(30), function () {
            return Role::pluck('name', 'name')->all();
        });

        return view('users.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'status' => 'required|in:0,1',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect(url('/users'))->with('status', 'User created successfully with roles');
    }

    public function edit(User $user)
    {
        $roles = Cache::remember('roles_in_users', Carbon::now()->addMinutes(30), function () {
            return Role::pluck('name', 'name')->all();
        });

        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'status' => 'required|in:0,1',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect(url('/users'))->with('status', 'User Updated Successfully with roles');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status', 'User Delete Successfully');
    }
}
