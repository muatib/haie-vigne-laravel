<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    IndexController,
    ContactController,
    FormController,
    PaymentController,
    AuthController,
    AdminController,
    UserController,
    PageController
};
use App\Http\Middleware\{
    AdminMiddleware,
    CheckReferer,
    CustomCsrfMiddleware,
    DoubleSubmitCookieMiddleware
};
use App\Models\{
    SliderImage,
    SliderImage2,
    Form
};

// Middleware group for 'web'
Route::middleware(['web', CheckReferer::class, DoubleSubmitCookieMiddleware::class])->group(function () {

    Route::get('/export-users-by-course/{course}', [AdminController::class, 'exportUsersByCourse'])
    ->name('export.users.by.course')
    ->middleware(['auth', 'admin']);

    // Home and index
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/index', function () {
        $sliderImages = SliderImage::all();
        $sliderImages2 = SliderImage2::all();
        return view('index', compact('sliderImages', 'sliderImages2'));
    })->name('index');

    // Contact routes
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

    // Authentication routes
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', fn() => view('login'))->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard route (Admin)
    Route::get('/dashboard', [AdminController::class, 'index'])->middleware('auth', 'admin')->name('dashboard');

    // User routes
    Route::get('/UserAccount', [UserController::class, 'account'])->name('UserAccount');
    Route::post('/delete-selected-users', [UserController::class, 'deleteSelected'])->name('delete.selected.users');
    Route::get('/filter-users-by-course', [AdminController::class, 'filterUsersByCourse'])->name('filter.users.by.course');
    Route::get('/export-users-by-course/{course}', [AdminController::class, 'exportUsersByCourse'])->name('export.users.by.course');

    // Form routes
    Route::get('/form', [FormController::class, 'showForm'])->name('form');
    Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');
    Route::post('/delete-selected-forms', [FormController::class, 'deleteSelected'])->name('delete.selected.forms');
    Route::get('/download-file/{form}', [FormController::class, 'downloadFile'])->name('download.file');

    // Admin-related actions (Slider, Activities, etc.)
    Route::get('/admin/edit-activities', [AdminController::class, 'editActivities'])->name('edit.activities');
    Route::post('/admin/update-activities', [AdminController::class, 'updateActivities'])->name('update.activities');
    Route::post('/update-slider-images', [AdminController::class, 'updateSliderImages'])->name('update.slider.images');
    Route::post('/update-slider-images2', [AdminController::class, 'updateSliderImages2'])->name('update.slider.images2');
    Route::post('/update-actualities', [AdminController::class, 'updateActualities'])->name('update.actualities');

    // Static pages
    Route::get('/privacy-police', [PageController::class, 'privacyPolice'])->name('privacy-police');

    // Payment pages
    Route::get('/price', fn() => view('price'));
    Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment');

    // Activity and actuality content
    Route::get('/activityContent', fn() => view('activityContent'));
    Route::get('/actualityContent', fn() => view('actualityContent'));

    // Custom action with middleware
    Route::post('/some-action', 'SomeController@action')
         ->middleware(['custom.csrf', 'check.referer', 'double.submit.cookie']);
});
