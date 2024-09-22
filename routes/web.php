<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\GasStationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoginController;

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

// トップ
Route::get('/car', [CarController::class, 'top']);

// ログイン機能
Route::get('/fuel/login', [LoginController::class, 'top']);
Route::post('/fuel/login', [LoginController::class, 'authenticate']);
Route::post('/fuel/logout', [LoginController::class, 'logout']);

// アカウント作成
Route::prefix('fuel/account')
->controller(AccountController::class)
->name('fuel.account.')
->group(function(){
    Route::get('/', 'top')->name('top');
    Route::post('/create', 'create')->name('create');
    Route::post('/add', 'add')->name('add');
});

// 燃費計算ツール
Route::prefix('fuel')
->controller(FuelController::class)
->name('fuel.')
->group(function(){
    Route::get('/', 'top')->name('top');
    Route::post('/', 'add')->name('add');
    Route::post('/edit', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::post('/destroy', 'destroy')->name('destroy');
});

// ガソリンスタンド情報
Route::prefix('gas_station')
->controller(GasStationController::class)
->name('gas_station.')
->group(function(){
    Route::get('/', 'top')->name('top');
    Route::get('/search', 'search')->name('search');
    Route::get('/search2', 'search2')->name('search2');
    Route::get('/detail/{id}', 'detail')->name('detail');
});

// お問い合わせ
Route::prefix('contact')
->controller(ContactController::class)
->name('contact.')
->group(function(){
    Route::get('/', 'top')->name('top');
    Route::post('/create', 'create')->name('create');
    Route::post('/add', 'add')->name('add');
});



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
