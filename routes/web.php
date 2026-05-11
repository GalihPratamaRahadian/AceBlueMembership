<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GiftController as AdminGiftController;
use App\Http\Controllers\Admin\PacketController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PrizePoolController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\SolarLogController;
use App\Http\Controllers\Admin\SolarMapController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Customer\CallCenterController;
use App\Http\Controllers\Customer\FaqController;
use App\Http\Controllers\Customer\GiftController;
use App\Http\Controllers\Customer\PaymentCustomerController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\RequireStatusController;
use App\Http\Controllers\Customer\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Resume\ResumeController;
use App\Http\Controllers\SolarTaskController;
use App\Http\Controllers\Teknisi\InfoInstallController;
use App\Http\Controllers\Teknisi\NotificationController;
use App\Http\Controllers\Teknisi\TecnicianController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke halaman utama
Route::redirect('/', '/login');

// Halaman utama (public)
Route::get('/home', [WebController::class, 'mainIndex'])->name('home');

// Halaman paket
Route::get('/paket', [WebController::class, 'packetIndex'])->name('packet');

//Halaman tentang
Route::get('/tentang-kami', [WebController::class, 'profileIndex'])->name('profile');

// Halaman persyaratan
Route::prefix('agreement')->group(function () {
    Route::get('/', [WebController::class, 'agreementIndex'])->name('agreement');
});

// Form registrasi
Route::prefix('access-register')->group(function () {
    Route::get('/', [RegisterController::class, 'accessRegisterIndex'])->name('access_register');
    Route::post('save', [RegisterController::class, 'saveRegister'])->name('access_register.save');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Custom Login & Logout)
|--------------------------------------------------------------------------
*/

// Menonaktifkan route default login/logout dari Auth::routes
Auth::routes([
    'login' => false,
    'logout' => false,
]);

// Login custom (POST)
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');


// Logout custom (POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('isAdmin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::prefix('user')->group(function () {
        Route::get('/', [AdminController::class, 'userIndex'])->name('admin.user');
        Route::get('{user}/get', [AdminController::class, 'userGet'])->name('admin.user.get');
        Route::post('store', [AdminController::class, 'userStore'])->name('admin.user.store');
        Route::put('{user}/update', [AdminController::class, 'userUpdate'])->name('admin.user.update');
        Route::delete('{user}/destroy', [AdminController::class, 'userDestroy'])->name('admin.user.destroy');
    });

    Route::prefix('people')->group(function () {
        Route::get('/', [AdminController::class, 'peopleIndex'])->name('admin.people');
        Route::get('{customer}/get', [AdminController::class, 'peopleGet'])->name('admin.people.get');
        Route::post('store', [AdminController::class, 'peopleStore'])->name('admin.people.store');
        Route::put('{people}/update', [AdminController::class, 'peopleUpdate'])->name('admin.people.update');
        Route::delete('{people}/destroy', [AdminController::class, 'peopleDestroy'])->name('admin.people.destroy');
        Route::post('{customer}/approve', [AdminController::class, 'approve'])->name('admin.people.approve');
        Route::post('{customer}/reject', [AdminController::class, 'reject'])->name('admin.people.reject');
    });

    Route::prefix('promotion')->group(function () {
        Route::get('/', [PromotionController::class, 'promotionIndex'])->name('admin.promotion');
        Route::get('{promotion}/get', [PromotionController::class, 'getPromotion'])->name('admin.promotion.get');
        Route::post('store', [PromotionController::class, 'promotionStore'])->name('admin.promotion.store');
        Route::put('{promotion}/update', [PromotionController::class, 'promotionUpdate'])->name('admin.promotion.update');
        Route::delete('{promotion}/destroy', [PromotionController::class, 'promotionDestroy'])->name('admin.promotion.destroy');
    });

    Route::prefix('prize-pool')->group(function () {
        Route::get('/', [PrizePoolController::class, 'prizePoolIndex'])->name('admin.prize_pool');
        Route::get('{prizePool}/get', [PrizePoolController::class, 'prizePoolGet'])->name('admin.prize_pool.get');
        Route::post('store', [PrizePoolController::class, 'prizePoolStore'])->name('admin.prize_pool.store');
        Route::put('{prizePool}/update', [PrizePoolController::class, 'prizePoolUpdate'])->name('admin.prize_pool.update');
        Route::delete('{prizePool}/destroy', [PrizePoolController::class, 'prizePoolDestroy'])->name('admin.prize_pool.destroy');
    });

    Route::prefix('gift')->group(function () {
        Route::get('/', [AdminGiftController::class, 'giftIndex'])->name('admin.gift');
        Route::get('{gift}/get', [AdminGiftController::class, 'getGift'])->name('admin.gift.get');
        Route::post('store', [AdminGiftController::class, 'giftStore'])->name('admin.gift.store');
        Route::put('{gift}/update', [AdminGiftController::class, 'giftUpdate'])->name('admin.gift.update');
        Route::delete('{gift}/destroy', [AdminGiftController::class, 'giftDestroy'])->name('admin.gift.destroy');
    });

    Route::prefix('resume')->group(function () {
        Route::get('/', [ResumeController::class, 'resumeIndex'])->name('admin.resume');
    });
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::prefix('customer')->middleware('isCustomer')->group(function () {
    Route::get('/', [UserController::class, 'userIndex'])->name('customer');

    Route::prefix('gift')->group(function () {
        Route::get('/', [GiftController::class, 'giftIndex'])->name('customer.gift');
        Route::get('{gift}/get', [GiftController::class, 'getGift'])->name('customer.gift.get');
        Route::post('store', [GiftController::class, 'giftStore'])->name('customer.gift.store');
        Route::put('{gift}/update', [GiftController::class, 'giftUpdate'])->name('customer.gift.update');
        Route::delete('{gift}/destroy', [GiftController::class, 'giftDestroy'])->name('customer.gift.destroy');
    });
});

// /*
// |--------------------------------------------------------------------------
// | Tecnician Routes
// |--------------------------------------------------------------------------
// */

// Route::prefix('teknisi')->middleware('isTechnician')->group(function () {
//     Route::get('/', [TecnicianController::class, 'index'])->name('teknisi');

//     Route::prefix('solar-task')->group(function () {
//         Route::get('/', [SolarTaskController::class, 'indexTechnician'])->name('tecnician.solar_task.index');
//         Route::post('/{id}/approve', [SolarTaskController::class, 'approve'])->name('tecnician.solar_task.approve');
//         Route::post('/{id}/complete', [SolarTaskController::class, 'complete'])->name('tecnician.solar_task.complete');
//     });
// });

