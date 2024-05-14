<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\View\View;use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationEmail;
use App\Notifications\SuccessfulEmailNotification;
use App\Notifications\UnsuccessfulEmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Mail\Swift_TransportException;





class VoterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(): View
    {
       return  view('vote.voterList',[
        'voters' => Voter::with('user')->latest()->get(),
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

        // making sure the person is permitted using gates
        if (! Gate::allows('update-user')) {
            abort(403);
        }else{

            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'picture' => 'nullable|image|mimes:png,jpeg,jpg',
                'user_type' => ['required', 'in:electoralCommissioner,candidate,voter'],
            ]);

            $picture_path = null;

            if ($validated['picture']) {
                $file = $validated['picture'];
                $fileName = time() . '_' . $file->getClientOriginalName();
                $picturePath = $file->storeAs('uploads', $fileName, 'public');
                $picture_path = $picturePath;
            }


            try{
                $voter_created =  $request->user()->voters()->create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'user_type'=> $validated['user_type'],
                    'picture_path'=> $picture_path
                ]);

                if($voter_created){
                    try{
                        Mail::to($validated['email'])->send(new ConfirmationEmail($validated['name'],$validated['email'] ,$validated['password']));
                        $user=Auth::user();

                        $data =[
                            'subject'=>'A new voter has been created',
                            'body'=>'you can now vote',
                            'text'=>'login',
                            'url'=>url('/'),
                            'thankyou'=>'thank you for registering this user'
                        ];

                        Notification::send($user, new SuccessfulEmailNotification($data));
                        return redirect(route('voters.index'))->with('success', 'Voter created successfully With Mail Sent');
                    }
                    catch (Swift_TransportException $e) {
                        $user = auth()->user();
                        Notification::send($user, new UnsuccessfulEmailNotification());

                        return redirect(route('voters.index'))->with('error', 'Failed to send email. Voter created successfully without Mail.');
                    }
                    catch (\Exception $e) {
                        $user=auth()->user();
                        Notification::send($user, new UnsuccessfulEmailNotification());

                        return redirect(route('voters.index'))->with('warning', 'Failed to Send Mail. Voter created successfully');
                    }
                }

            }
            catch(QueryException $e){

                if($e->errorInfo[1] === 1062){
                return redirect()->back()->with('error', 'Email already exists.');
                }

                return redirect()->back()->with('error', 'Database error.');
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Voter $voter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voter $voter)
    {
        if (! Gate::allows('update-user')) {
            abort(403);
        }

        return view('vote.voterEdit',[
            'voter' =>  $voter
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voter $voter)
    {
        if (! Gate::allows('update-user')) {abort(403);}

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'picture' => 'nullable|image|mimes:png,jpeg,jpg',
            'user_type' => ['required', 'in:electoralCommissioner,candidate,voter'],
        ]);

        $picture_path = null;
        if ($validated['picture']) {
            $file = $validated['picture'];
            $fileName = time() . '_' . $file->getClientOriginalName();
            $picturePath = $file->storeAs('uploads', $fileName, 'public');
            $picture_path = $picturePath; }

        $voter->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_type'=> $validated['user_type'],
            'picture_path'=> $picture_path
        ]);

        return redirect(route('voters.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voter $voter)
    {
        if (! Gate::allows('update-user')) {abort(403);}
        $voter->delete();
        return redirect(route('voters.index'));
    }

}

