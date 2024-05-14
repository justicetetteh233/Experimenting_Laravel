<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return  view('vote.candidateList',[
            'positions'=>Position::with('user')->latest()->get(),
            'candidates' => Candidate::with('user','position')->latest()->get(),
        ]);
    }

    public function getCandidatesByPosition($position_id)
    {
        $candidates = Candidate::with('position')->where('positions_id', $position_id)->get();
        return response()->json(['candidates' => $candidates]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'picture' => 'nullable|image|mimes:png,jpeg,jpg',
            'user_type' => ['required', 'in:electoralCommissioner,candidate,voter'],
            'positions_id' => ['required', 'string'],
        ]);  
        
        $picture_path = null;

        if ($validated['picture']) {
            $file = $validated['picture'];
            $fileName = time() . '_' . $file->getClientOriginalName();
            $picturePath = $file->storeAs('uploads', $fileName, 'public'); 
            $picture_path = $picturePath; 
        }

        $request->user()->candidates()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_type'=> $validated['user_type'],
            'picture_path'=> $picture_path,
            'positions_id'=> $validated['positions_id'],
        ]);

        return redirect(route('candidates.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        if (! Gate::allows('update-user')) {
            abort(403);
        }

        return view('vote.candidateEdit',[
            'positions'=>Position::with('user')->latest()->get(),
            'candidate' =>  $candidate
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        if (! Gate::allows('update-user')) {abort(403);}
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'picture' => 'nullable|image|mimes:png,jpeg,jpg',
            'user_type' => ['required', 'in:candidate'],
            'positions_id' => ['required', 'string'],

        ]);

        $picture_path = null;
        if ($validated['picture']) {
            $file = $validated['picture'];
            $fileName = time() . '_' . $file->getClientOriginalName();
            $picturePath = $file->storeAs('uploads', $fileName, 'public'); 
            $picture_path = $picturePath; }

        $candidate->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_type'=> $validated['user_type'],
            'positions_id'=> $validated['positions_id'],
            'picture_path'=> $picture_path
        ]);

        return redirect(route('candidates.index')); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        if (! Gate::allows('update-user')) {abort(403);}
        $candidate->delete();
        return redirect(route('candidates.index')); 
    }
}
