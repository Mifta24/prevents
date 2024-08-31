<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('front.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function (){
        // events
        Route::resource('event',EventController::class)->middleware('role:admin|organizer');

        // tickets
        Route::resource('ticket',TicketController::class)->middleware('role:admin|organizer');
        // organizer
        Route::get('/organizer',[UserController::class,'organizerIndex'])->middleware('role:admin')->name('organizer.index');
        Route::get('/organizer/detail',[UserController::class,'organizerShow'])->middleware('role:admin')->name('organizer.show');
        Route::get('/organizer/create',[UserController::class,'organizerCreate'])->middleware('role:admin')->name('organizer.create');
        Route::put('/organizer/role',[UserController::class,'organizerStore'])->middleware('role:admin')->name('organizer.store');
        Route::delete('/organizer/destory/{user:id}',[UserController::class,'organizerDestroy'])->middleware('role:admin')->name('organizer.destroy');

        // registrtion
        Route::resource('registration',RegistrationController::class)->middleware('role:admin');

        // payment
        Route::resource('payment',PaymentController::class)->middleware('role:admin');
    });
});

require __DIR__.'/auth.php';
