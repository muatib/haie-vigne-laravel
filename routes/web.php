<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PaymentController;
use App\Models\SliderImage;
use App\Models\SliderImage2;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Models\Form;
use App\Http\Controllers\UserController;




Route::get('/', function () {
    $sliderImages = SliderImage::all();
    $sliderImages2 = SliderImage2::all();
    return view('index', compact('sliderImages', 'sliderImages2'));
})->name('index');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/dashboard', [AdminController::class, 'index'])->middleware('admin')->name('dashboard');
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::get('UserAccount', [UserController::class, 'account'])->name('UserAccount');
Route::post('/delete-selected-forms', [FormController::class, 'deleteSelected'])->name('delete.selected.forms');
Route::post('/delete-selected-users', [UserController::class, 'deleteSelected'])->name('delete.selected.users');
Route::get('/download-file/{form}', [FormController::class, 'downloadFile'])->name('download.file');
Route::post('/delete-selected-forms', [FormController::class, 'deleteSelected'])->name('delete.selected.forms');
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

Route::get('/actualityContent', function () {
    return view('actualityContent');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/index', [IndexController::class, 'index'])->name('home');
Route::get('/filter-users-by-course', [AdminController::class, 'filterUsersByCourse'])->name('filter.users.by.course');
Route::get('/export-users-by-course/{course}', [AdminController::class, 'exportUsersByCourse'])->name('export.users.by.course');
Route::get('/admin/edit-activities', [AdminController::class, 'editActivities'])->name('edit.activities');
Route::post('/admin/update-activities', [AdminController::class, 'updateActivities'])->name('update.activities');

Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
