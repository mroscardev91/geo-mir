<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', $message);
    return view('welcome');
});

/*Per enviar mails*/
Route::get('mail/test', [MailController::class, 'test']);

/*Per generar rutes CRUD de files*/
Route::resource('files', FileController::class)
->middleware(['auth', 'role.any:1,2,3']);


/*Per generar rutes CRUD de places*/
Route::resource('places', PlaceController::class)
->middleware(['auth', 'role.any:1,2,3']);
/*Per generar rutes CRUD de favorites*/
Route::resource('favorites', FavoriteController::class);
/*Per generar rutes CRUD de reviews*/
Route::resource('reviews', ReviewController::class);



Route::get('/dashboard', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', "$message");
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class)
    ->only(['index', 'store', 'edit', 'show', 'update', 'destroy', 'likes'])
    ->middleware(['auth', 'verified']);
require __DIR__.'/auth.php';
