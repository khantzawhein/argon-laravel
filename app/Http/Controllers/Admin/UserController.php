<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->paginate(10);
        return Inertia::render('Users/Index', [
            'users' => UserResource::collection($users)
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create', [
            'roles' => Role::select('id', 'display_name', 'name')->orderBy('name')->get()
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->assignRole($data['role_id']);
        return redirect()->route('admin.users.index')->with(['message' => 'User Created Successfully', 'type' => 'success']);
    }

    public function edit($userId)
    {
        $user = User::withTrashed()->findOrFail($userId);
        return Inertia::render('Users/Edit', [
            'roles' => Role::select('id', 'display_name', 'name')->orderBy('name')->get(),
            'user' => new UserResource($user)
        ]);
    }

    public function update($userId, UserUpdateRequest $request)
    {
        $user = User::withTrashed()->findOrFail($userId);
        $data = $request->validated();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        $user->syncRoles($data['role_id']);
        return redirect()->route('admin.users.index')->with(['message' => 'User Updated Successfully', 'type' => 'success']);
    }

    public function destroy(User $user)
    {
        $user = $user->delete();
        return redirect()->route('admin.users.index')->with(['message' => 'User Deactivated Successfully', 'type' => 'success']);
    }
    public function restore($userId)
    {
        $user = User::withTrashed()->findOrFail($userId);
        $user->restore();
        return redirect()->route('admin.users.index')->with(['message' => 'User Activated Successfully', 'type' => 'success']);
    }
}
