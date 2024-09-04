<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;

Route::get('/', [FrontController::class, 'index'])->name('index');


Route::get('/about', [FrontController::class, 'about'])->name('about');

Route::get('/event', [FrontController::class, 'event'])->name('event');

Route::get('/detail-event/{event:slug}', [FrontController::class, 'detailEvent'])->name('detail.event');



Route::get('/ticket', [FrontController::class, 'ticket'])->name('ticket');

Route::get('/team', [FrontController::class, 'team'])->name('team');

Route::get('/contact', [FrontController::class, 'contact'])->name('contact');









Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard')->middleware('role:admin|organizer');

Route::middleware('auth')->group(function () {

    // transaction
    Route::get('/registration/{event:slug}', [FrontController::class, 'registration'])->name('registration');

    Route::post('/buy/{event:slug}', [FrontController::class, 'registrationStore'])->name('register.ticket');

    Route::get('/payment/{participant}/buy', [FrontController::class, 'payment'])->name('payment');
    Route::post('/payment/{participant}/payment', [FrontController::class, 'paymentStore'])->name('process.payment');

    Route::get('/receipt/{idReg}', [FrontController::class, 'receipt'])->name('receipt');
    Route::get('/download/receipt/pdf', [FrontController::class, 'receiptPdf'])->name('download.receipt');

    // profile page
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile-user', [ProfileController::class, 'editUser'])->name('my.profile.edit');
    Route::get('/my-tickets', [FrontController::class, 'myTickets'])->name('my.tickets');
    Route::get('/my-transactions', [FrontController::class, 'myTransactions'])->name('my.transactions');
    Route::get('/event-details', [FrontController::class, 'myTransactions'])->name('event.details');
    Route::get('/my-receipts', [FrontController::class, 'myReceipts'])->name('my.receipts');

    // admin page
    Route::prefix('admin')->name('admin.')->group(function () {
        // events
        Route::resource('event', EventController::class)->middleware('role:admin|organizer');

        // tickets
        Route::resource('ticket', TicketController::class)->middleware('role:admin|organizer');
        // organizer
        Route::resource('user', UserController::class)->middleware('role:admin');

        Route::get('/organizer', [UserController::class, 'organizerIndex'])->middleware('role:admin')->name('organizer.index');
        Route::get('/organizer/detail', [UserController::class, 'organizerShow'])->middleware('role:admin')->name('organizer.show');
        Route::get('/organizer/create', [UserController::class, 'organizerCreate'])->middleware('role:admin')->name('organizer.create');
        Route::put('/organizer/role', [UserController::class, 'organizerStore'])->middleware('role:admin')->name('organizer.store');
        Route::delete('/organizer/destory/{user:id}', [UserController::class, 'organizerDestroy'])->middleware('role:admin')->name('organizer.destroy');

        // registrtion
        Route::resource('registration', RegistrationController::class)->middleware('role:admin|organizer');
        // Route khusus untuk aksi approve
        Route::post('registrations/{registration}/approve', [RegistrationController::class, 'approve'])->name('registration.approve');

        // Route khusus untuk aksi reject
        Route::post('registrations/{registration}/reject', [RegistrationController::class, 'reject'])->name('registration.reject');



        // payment
        Route::resource('payment', PaymentController::class)->middleware('role:admin');
    });
});

require __DIR__ . '/auth.php';
