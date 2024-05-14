<?php

namespace App\Http\Controllers;

use App\Models\VoteCast;
use App\Models\Position;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Template\Template;

class VoteCastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        // return view('vote.castVotePage', [
        //     'voter' => Auth::guard('voter')->user(),
        //     'positions'=>Position::all(),
        //     'candidates' => Candidate::all(),
        // ]);
        return view('vote.Templates.voterPageTemplate', [
                'voter' => Auth::guard('voter')->user(),
                'positions'=>Position::all(),
                'candidates' => Candidate::all(),
                'totalVotesCasts'=>VoteCast::where('voters_id',Auth::guard('voter')->user()->id)->count(),
                'pendingVotes' => Position::all()->count()- VoteCast::where('voters_id',Auth::guard('voter')->user()->id)->count()

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
        // Validate the request data as needed
       
        
        $validatedData = $request->validate([
            'positions_id' => 'required|exists:positions,id', 
            'candidates_id' => 'required|exists:candidates,id', 
        ]);
        $validatedData['voters_id'] = Auth::guard('voter')->user()->id;
        VoteCast::create($validatedData);
        return redirect(route('votecasts.index'));   
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(VoteCast $voteCast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VoteCast $voteCast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VoteCast $voteCast)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VoteCast $voteCast)
    {
        //
    }
}
