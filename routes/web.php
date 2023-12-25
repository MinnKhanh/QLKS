<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookRoomController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StatiscalController;
use App\Models\User;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\RoomController as UserRoomController;
use App\Http\Controllers\User\UserController;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'test'])->name('dashboard');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'test'])->name('dashboard');
Route::group([
    'as'     => 'admin.',
    'prefix' => 'admin',
], static function () {

Route::get('/print-payment', [BookRoomController::class, 'print'])->name('print');

    Route::group([
        'as'     => 'auth.',
        'prefix' => 'auth',
    ], static function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/sigin', [AuthController::class, 'signIn'])->name('sigin');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
    Route::group([
        'as'     => 'room.',
        'prefix' => 'room',
        'middleware' => 'checkAdminLogin'
    ], static function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::get('/create', [RoomController::class, 'create'])->name('create');
        Route::get('/create-room', [RoomController::class, 'createRoom'])->name('create_room');
        Route::get('/update', [RoomController::class, 'update'])->name('update');
        Route::get('/type-room', [RoomController::class, 'typeRoom'])->name('type_room');
        Route::get('/room-capacity', [RoomController::class, 'roomCapacity'])->name('room_capacity');
    });
    Route::group([
        'as'     => 'employee.',
        'prefix' => 'employee',
        'middleware' => 'checkAdminLogin'
    ], static function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
    });
    Route::group([
        'as'     => 'bookroom.',
        'prefix' => 'book-room',
        'middleware' => 'checkAdminLogin'
    ], static function () {
        Route::get('{id}/create-info', [BookRoomController::class, 'createInfo'])->name('create_info');
        Route::get('/create', [BookRoomController::class, 'create'])->name('create');
        Route::get('/list-room', [BookRoomController::class, 'listRoom'])->name('list_room');
        Route::get('{id}/{bookingid}/custom-room-booking', [BookRoomController::class, 'customRoomBooking'])->name('custom_room_booking');
        Route::post('checkout', [BookRoomController::class, 'checkout'])->name('checkout');
        Route::get('{id}/user-order', [BookRoomController::class, 'orderByUser'])->name('user_order');
    });
    Route::group([
        'as'     => 'customer.',
        'prefix' => 'customer',
        'middleware' => 'checkAdminLogin'
    ], static function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('{id}', [CustomerController::class, 'detail'])->name('detail');
    });
    Route::group([
        'as'     => 'product.',
        'prefix' => 'product',
        'middleware' => 'checkAdminLogin'
    ], static function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/product-room', [ProductController::class, 'productRoom'])->name('product_room');
    });
    Route::group([
        'as'     => 'service.',
        'prefix' => 'service',
        'middleware' => 'checkAdminLogin'
    ], static function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
    });
    Route::group([
        'as'     => 'statiscal.',
        'prefix' => 'statiscal',
        'middleware' => 'checkAdminLogin'
    ], static function () {
        Route::get('/', [StatiscalController::class, 'index'])->name('index');
        Route::get('/payment', [StatiscalController::class, 'payment'])->name('payment');
    });
});
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/test', function () {
    $a = Booking::whereIn('id', [30, 31])->get();
    $b = Booking::whereIn('id', [30, 32])->get();
    dd($a->toArray(), $b->toArray(), $a->merge($b)->toArray());
});
Route::group([
    'as'     => 'room.',
    'prefix' => 'room',
], static function () {
    Route::get('/', [UserRoomController::class, 'index'])->name('index');
    Route::get('{type_id}/list-room', [UserRoomController::class, 'listRoom'])->name('list_room');
    Route::get('/{room}', [UserRoomController::class, 'detail'])->name('detail');
});
Route::group([
    'as'     => 'booking.',
    'prefix' => 'booking',
], static function () {
    Route::get('/{roomType}', [BookingController::class, 'checkOut'])->name('check_out');
    // Route::get('/li', [BookingController::class, 'checkOut'])->name('check_out');
});
Route::group([
    'as'     => 'information.',
    'prefix' => 'information',
], static function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/booking', [UserController::class, 'booking'])->name('booking');
});
Route::get('/test', function () {
    Admin::create(['email' => 'Admin@gmail.com', 'password' => Hash::make('12345678'), 'name' => 'admin']);
});
Route::get('/info-booking', [BookingController::class, 'infoBooking'])->name('info_booking');
Route::get('/print-payment', [BookingController::class, 'print'])->name('print');
Route::get('/kk', function(){
    dd(Room::where('floor_id', 3)->first());
});

