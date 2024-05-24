<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Exceptions\UnauthorizedException;


class UserRoleController extends Controller
{

    public function manageUserRoles()
    {
        if(auth()->user()->hasRole('Executive Commissioner')){
            $commissioners = User::all();
            $roles = Role::all();

        return view('manage-user-roles', compact('commissioners', 'roles'));

        }
        throw UnauthorizedException::forPermissions(['create Commissioner']);

        // $commissioners = User::all();
        // $roles = Role::all();

        // return view('manage-user-roles', compact('commissioners', 'roles'));
    }


    public function updateUserRoles(Request $request)
    {
        if(auth()->user()->hasRole('Executive Commissioner')){

            foreach ($request->roles as $userId => $selectedRoles) {
                $user = User::findOrFail($userId);
                $user->syncRoles($selectedRoles);
                }
                return redirect()->back()->with('success', 'User roles updated successfully.');

        }
        throw UnauthorizedException::forPermissions(['create Commissioner']);


    }
}
