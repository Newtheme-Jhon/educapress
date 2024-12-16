<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles      = Role::all();
        $role_user  = $user->getRoleNames()->first();
        //dd($role_user);

        $permissions            = Permission::all();
        $permissionsAssigned    = $user->getAllPermissions()->pluck('id')->toArray();
        //return $permissionsAssigned;

        return view('admin.users.edit', compact('user', 'roles', 'role_user', 'permissions', 'permissionsAssigned'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //return $request->all();
        $request->validate([
            'name' => 'required',
            'roles' => 'required',
        ]);

        $role = $request->input('roles');
        $user->syncRoles($role);

        $permissions = $request->input('permissions', []);
        $user->syncPermissions($permissions);

        $user->update($request->all());
        return redirect()->route('admin.users.edit', compact('user'))->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
