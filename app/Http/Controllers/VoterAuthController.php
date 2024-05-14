<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Voter;
use App\Models\Position;
use App\Models\Candidate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;


class VoterAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request): View | RedirectResponse
    {
            try {
                // dd($request);

                $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                ]);
                // dd('valid Input');

                if (Auth::guard('voter')->attempt($credentials)) {
                    return redirect(route('votecasts.index'));
                }
                throw ValidationException::withMessages(['email' => 'Invalid credentials']);
            }

            catch (ValidationException $e) {
                    // Validation exception occurred (invalid input data)
                    return back()->withErrors($e->validator->errors()->all())->withInput();
            }
        

    }

    public function logout(Request $request): RedirectResponse
    {
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
    }

}  
