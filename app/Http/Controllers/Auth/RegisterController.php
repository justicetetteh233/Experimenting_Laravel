<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'picture' => 'nullable|image|mimes:png,jpeg,jpg',
            'user_type' => ['required', 'in:Executive Commissioner, Deputy Commissioner,Registerer'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd("am in this function ");
        // if(Auth::check()){
        //     if(!(auth()->user()->hasPermissionTo('create Commissioner'))){
        //         abort(403);
        //     }else{


        //         $picture_path = null;
        //         if ($data['picture']) {
        //             $file = $data['picture'];
        //             $fileName = time() . '_' . $file->getClientOriginalName();
        //             $picturePath = $file->storeAs('uploads', $fileName, 'public');
        //             $picture_path = $picturePath;
        //         }

        //         return User::create([
        //             'name' => $data['name'],
        //             'email' => $data['email'],
        //             'password' => Hash::make($data['password']),
        //             'user_type'=> $data['user_type'],
        //             'picture_path'=> $picture_path
        //         ]);
        //     }
        // }
        // else{
        //     if(User::count()===0 ){
        //         if($data['user_type'] != 'Executive Commissioner'){
        //             abort(403);
        //         }else{
        //             $picture_path = null;
        //             if ($data['picture']) {
        //                 $file = $data['picture'];
        //                 $fileName = time() . '_' . $file->getClientOriginalName();
        //                 $picturePath = $file->storeAs('uploads', $fileName, 'public');
        //                 $picture_path = $picturePath;
        //             }
        //             return User::create([
        //                 'name' => $data['name'],
        //                 'email' => $data['email'],
        //                 'password' => Hash::make($data['password']),
        //                 'user_type'=> $data['user_type'],
        //                 'picture_path'=> $picture_path
        //             ])->assignRole('Executive Commissioner');
        //         }

        //     }else{
        //         abort(403);
        //     }
        // }

        $picture_path = null;
        if ($data['picture']) {
            $file = $data['picture'];
            $fileName = time() . '_' . $file->getClientOriginalName();
            $picturePath = $file->storeAs('uploads', $fileName, 'public');
            $picture_path = $picturePath;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type'=> $data['user_type'],
            'picture_path'=> $picture_path
        ]);

    }
}
