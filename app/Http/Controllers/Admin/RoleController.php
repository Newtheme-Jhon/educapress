<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        //dd($roles);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array'
        ]);

        $role = Role::create([
            'name' => strtolower($request->name),
        ]);

        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.roles.index')->with('success', 'Rol creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $permissionsAssigned = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'permissionsAssigned'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array'
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.roles.index')->with('success', 'Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {

        if ($role->name === 'admin' || $role->name === 'instructor') {
            return response()->json(['error' => 'No se puede eliminar este rol'], 400);
        }

        if ($role->name === 'editor_post') {
            // return redirect()->route('admin.roles.index')->with('error', 'No se puede eliminar este rol');
            return response()->json(['error' => 'No se puede eliminar este rol'], 400);
        }

        if($role->users()->count() > 0){
            return response()->json(['error' => 'No se puede eliminar el rol porque tiene usuarios asignados'], 400);
        }else{

            $role = $role->delete();
            return response()->json($role);
        }

    }
}
