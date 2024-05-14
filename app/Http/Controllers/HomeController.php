<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()->user_type == 'electoralCommissioner'){
            return redirect(route('members.index'));          
        }
        elseif(Auth::user()->user_type == 'candidate'){
            return redirect(route('members.index'));
        }
        elseif(Auth::user()->user_type == 'voter'){
            return response('voter');
        }
    }
}
