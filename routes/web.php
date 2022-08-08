<?php

use App\Http\Controllers\HomeController;
use App\Models\Registration;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ HomeController::class, 'index' ])->name('home');

Route::get('/registration', [ HomeController::class, 'registration' ]);
Route::post('/registration', [ HomeController::class, 'registrationPost']);
Route::get('/mark-lists', [ HomeController::class, 'markList' ]);

Route::get('/student-registration', function () {
    $registrations = Registration::all();
    return view('student-registration', compact('registrations'));
})->middleware(['auth'])->name('registration');

require __DIR__.'/auth.php';
