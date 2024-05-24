<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Position;
use App\Models\Voter;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Laravel\Sanctum\HasApiTokens;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View | Response | RedirectResponse
    {
        // if(Auth::user()->hasRole('Executive Commissioner')){

        //     return view('vote.electoralCommissionersLandingPage',[
        //         'commissioners' => User::all(),
        //         "user" => Auth::user(),
        //         'voters' => Voter::with('user')->latest()->get(),
        //         'positions'=>Position::with('user')->latest()->get(),
        //         'candidates' => Candidate::with('user','position')->latest()->get(),
        //     ]);
        // }
        // return redirect(route('members.index'));

        return view('vote.electoralCommissionersLandingPage',[
            'commissioners' => User::all(),
            "user" => Auth::user(),
            "api_token" => Auth::user()->createToken('api-token')->plainTextToken,
            'voters' => Voter::with('user')->latest()->get(),
            'positions'=>Position::with('user')->latest()->get(),
            'candidates' => Candidate::with('user','position')->latest()->get(),
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);








        // if(Auth::user()->user_type == 'electoralCommissioner'){
        //     return redirect(route('members.index'));
        // }
        // elseif(Auth::user()->user_type == 'candidate'){
        //     return redirect(route('members.index'));
        // }
        // elseif(Auth::user()->user_type == 'voter'){
        //     return response('voter');
        // }
        // return redirect(route('members.index'));
    }
}
