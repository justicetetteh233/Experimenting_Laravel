<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function manageUserRoles()
    {
        $commissioners = User::all();
        $roles = Role::all();

        return view('manage-user-roles', compact('users', 'roles'));
    }

    public function updateUserRoles(Request $request)
    {
        foreach ($request->roles as $userId => $selectedRoles) {
        $user = User::findOrFail($userId);
        $user->syncRoles($selectedRoles);
        }
        return redirect()->back()->with('success', 'User roles updated successfully.');
    }
}
