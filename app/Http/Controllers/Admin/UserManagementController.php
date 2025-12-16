<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->latest()->paginate(12);

        return view('admin.users.index', [
            'users' => $users,
            'statusOptions' => UserStatus::cases(),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'statusOptions' => UserStatus::cases(),
        ]);
    }

    public function store(AdminUserStoreRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => Hash::make($request->validated('password')),
            'status' => $request->validated('status'),
        ]);

        $user->syncRoles([$request->validated('role')]);

        return redirect()->route('admin.users.index')->with('status', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
            'statusOptions' => UserStatus::cases(),
            'currentRole' => $user->roles->pluck('name')->first(),
        ]);
    }

    public function update(AdminUserUpdateRequest $request, User $user): RedirectResponse
    {
        $data = [
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'status' => $request->validated('status'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->validated('password'));
        }

        $user->update($data);
        $user->syncRoles([$request->validated('role')]);

        return redirect()->route('admin.users.index')->with('status', 'User updated successfully.');
    }
}
