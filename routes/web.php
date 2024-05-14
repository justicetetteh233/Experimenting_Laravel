<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteCastController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoterAuthController;
use App\Http\Controllers\CandidateAuthController;
use App\Models\Candidate;
use App\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    // return DB::raw('select * from failed_jobs');
    $jobs = DB::table('failed_jobs')->select(DB::raw('*'))->get();

    // foreach($jobs as $job) {
    //     print_r($job);
    // }
    // return view('welcome');

    return $jobs;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/members',[App\Http\Controllers\UserController::class, 'index'])->name('members');
Route::resource('members',UserController::class)
    ->only(['index','edit','update','destroy'])
    ->middleware(['auth','verified']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
Route::post('/voterLogin',[VoterAuthController::class, 'login'])->name('voterLogin');
Route::post('/voterLogout',[VoterAuthController::class, 'logout'])->name('voterLogout');

Route::post('/candidateLogin',[CandidateAuthController::class, 'login'])->name('candidateLogin');


// Route::get('/members/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('members.edit');  
Route::group(['middleware'=>['auth','verified']], function(){
    Route::resource('members',UserController::class)
    ->only(['index','update','destroy', 'edit','update','destroy']);
});




Route::resource('positions',PositionController::class)
    ->only(['index','update','destroy', 'edit','update','destroy','store'])
    ->middleware(['auth','verified']);

Route::resource('voters',VoterController::class)
    ->only(['index','update','destroy', 'edit','update','destroy','store'])
    ->middleware(['auth','verified']);

Route::resource('candidates',CandidateController::class)
    ->only(['index','update','destroy', 'edit','update','destroy','store'])
    ->middleware(['auth','verified']);

Route::get('/getCandidatesByPosition/{position_id}', [CandidateController::class, 'getCandidatesByPosition'])->name('getCandidatesByPosition');

Route::resource('votecasts',VoteCastController::class)
    ->only(['index','update','destroy', 'edit','update','destroy','store'])
    ->middleware(['voterIsAuthenticated']);


Route::get('/testroute', function() {
    $user_name='Justice';
    $user_email= 'jus@gmail.com';
    $user_password= '123456789';
    Mail::to('lord.justice.tetteh@gmail.com')->send(new ConfirmationEmail($user_name,$user_email ,$user_password));
    });

Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');


