<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return view('vote.positionList',[
            'positions'=>Position::with('user')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {   
        if (! Gate::allows('update-user')) {
            abort(403);
        }
        $validated = $request->validate([
            'name' =>'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);        

        $request->user()->positions()->create($validated);
        return redirect(route('positions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        if (! Gate::allows('update-user')) {
            abort(403);
            }
        return view('vote.positionEdit',[
            'position' => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        if (! Gate::allows('update-user')) {
            abort(403);
        }

        $validated = $request->validate([
            'name' =>'required|string|max:255',
            'description' => 'required|string|max:255'  
        ]);
        $position->update($validated);
        return redirect(route('positions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {   if (! Gate::allows('update-user')) {
        abort(403);
        }
        $position->delete();
        return redirect(route('positions.index')); 
    }
}
