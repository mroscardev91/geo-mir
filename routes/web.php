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
use App\Http\Controllers\LanguageController;

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

// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*Per enviar mails*/
Route::get('mail/test', [MailController::class, 'test']);

Route::get('/language/{locale}', [LanguageController::class, 'language'])->name('language');

/*Per generar rutes CRUD de files*/
Route::resource('files', FileController::class)
->middleware(['auth']);


/*Per generar rutes CRUD de places*/
Route::resource('places', PlaceController::class)
->middleware(['auth']);

// Favorite i unFavorite per a PlaceController
Route::post('/places/{place}/favs', [PlaceController::class, 'favorite'])->name('places.favorite')
->middleware('can:Favorite,place');


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

Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');

Route::resource('posts', PostController::class)
    ->only(['index', 'store', 'edit', 'show', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);
require __DIR__.'/auth.php';
