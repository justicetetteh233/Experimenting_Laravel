<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    public function create()
    {
        return view('create-role');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('roles.create')->with('success', 'Permission created successfully.');
    }
}
