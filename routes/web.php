<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PaymentController;


Route::get('/', [IndexController::class, 'index']);

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/price', function () {
    return view('price');
});

Route::get('/form', [FormController::class, 'showForm'])->name('form');
Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/payment', function () {
    return view('payment');
})->name('payment');


Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment');

Route::get('/activityContent', function () {
    return view('activityContent');
});



