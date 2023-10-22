<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('backend.role_and_permission.role_view', compact('roles'));
    }



    // public function create()
    // {
    //     return view('admin.roles.create');
    // }



    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3', 'unique:roles']]);
        Role::create($validated);

        // return to_route('admin.roles.index')->with('message', 'Role Created successfully.');
        return redirect()->back()->with('message', 'Role Created successfully.');
    }



    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('backend.role_and_permission.role_edit', compact('role', 'permissions'));
    }



    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required', 'unique:roles']]);
        $role->update($validated);

        return to_route('roles.index')->with('message', 'Role Updated successfully.');
    }



    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('message', 'Role deleted.');
    }



    public function givePermission(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }
    


    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission not exists.');
    }


}
