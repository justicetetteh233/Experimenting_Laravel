<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;


class UserController extends Controller
{   
    use Notifiable;
    public function index(): View
    {

        return view('vote.userList',[
            'users'=>User::all()
        ]);
    }

    public function edit($user):View

    {   
        if (! Gate::allows('update-user')) {
            abort(403);
        }

        $user  = User::find($user);
        return view('vote.userEdit',[
            'user' =>  $user
        ]);

    }

    public function update(Request $request, $user):RedirectResponse
        {   
            if (! Gate::allows('update-user')) {abort(403);}
            $user  = User::find($user);
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

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'user_type'=> $validated['user_type'],
                'picture_path'=> $picture_path
            ]);

            return redirect(route('members.index')); 
    }


    public function delete(){

    }

    public function destroy($user):RedirectResponse
    {
        if (! Gate::allows('update-user')) {abort(403);}
        $user  = User::find($user);
        $user->delete();
        return redirect(route('members.index')); 
    }
    
}
