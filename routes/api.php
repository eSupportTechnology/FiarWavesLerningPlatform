<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::post('/payment/notify', [BookingController::class, 'getPaymentInfo'])->name('payment.notify');
