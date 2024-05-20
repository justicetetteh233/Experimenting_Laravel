<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display the form to create a new permission.
     */
    public function create()
    {
        return view('create-permission');
    }

    /**
     * Store a new permission in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.create')->with('success', 'Permission created successfully.');
    }



}
