<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManageRolesController extends Controller
{
    public function manageRoles()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('manage-roles', compact('roles', 'permissions'));
    }

    public function updateRolePermissions(Request $request)
    {
        $roles = Role::all();

        foreach ($roles as $role) {
            $role->permissions()->detach();

            if ($request->has("permissions.{$role->id}")) {
                $role->givePermissionTo($request->input("permissions.{$role->id}"));
            }
        }

        return redirect()->route('roles.permissions.manage')->with('success', 'Permissions updated successfully.');
    }
}
