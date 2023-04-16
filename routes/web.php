<?php

use App\Http\Controllers\Admin\BookRoomController;
use App\Http\Controllers\Admin\RoomController;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'test'])->name('dashboard');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'test'])->name('dashboard');
Route::group([
    'as'     => 'admin.',
    'prefix' => 'admin',
], static function () {
    Route::group([
        'as'     => 'room.',
        'prefix' => 'room',
    ], static function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::get('/create', [RoomController::class, 'create'])->name('create');
        Route::get('/update', [RoomController::class, 'update'])->name('update');
    });
    Route::group([
        'as'     => 'bookroom.',
        'prefix' => 'book-room',
    ], static function () {
        Route::get('{id}/create-info', [BookRoomController::class, 'createInfo'])->name('create_info');
        Route::get('/create', [BookRoomController::class, 'create'])->name('create');
        Route::get('/list-room', [BookRoomController::class, 'listRoom'])->name('list_room');
        Route::get('{id}/custom-room-booking', [BookRoomController::class, 'customRoomBooking'])->name('custom_room_booking');
    });
});
Route::get('/test', function () {
    Room::where('id', 3)->update(['status' => 2]);
});
