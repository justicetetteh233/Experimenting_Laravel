<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;


class CandidateAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request): View | RedirectResponse
    {
            try {
                $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                ]);
               

                if (Auth::guard('candidate')->attempt($credentials)) {
                    return view('vote.candidateProfilePage', [
                        'candidate' => Auth::guard('candidate')->user()
                    ]);
                }
                throw ValidationException::withMessages(['email' => 'Invalid credentials']);
            }

            catch (ValidationException $e) {
                    // Validation exception occurred (invalid input data)
                    return back()->withErrors($e->validator->errors()->all())->withInput();
            }
        

    }

}  
