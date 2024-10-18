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

    // Home and index
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/index', function () {
        $sliderImages = SliderImage::all();
        $sliderImages2 = SliderImage2::all();
        return view('index', compact('sliderImages', 'sliderImages2'));
    })->name('index');

    // Contact routes
    Route::get('/contactez-nous', [ContactController::class, 'show'])->name('contact.show'); // Nouveau chemin pour "contact"
    Route::redirect('/contact', '/contactez-nous'); // Redirection de l'ancien chemin vers le nouveau
    Route::post('/contactez-nous', [ContactController::class, 'submit'])->name('contact.submit');

    // Authentication routes
    Route::get('/inscription', [AuthController::class, 'showRegistrationForm'])->name('register'); // Nouveau chemin pour "register"
    Route::redirect('/register', '/inscription'); // Redirection de l'ancien chemin vers le nouveau
    Route::post('/inscription', [AuthController::class, 'register']);

    Route::get('/connexion', fn() => view('login'))->name('login'); // Nouveau chemin pour "login"
    Route::redirect('/login', '/connexion'); // Redirection de l'ancien chemin vers le nouveau
    Route::post('/connexion', [AuthController::class, 'login']);
    Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout'); // Nouveau chemin pour "logout"
    Route::redirect('/logout', '/deconnexion'); // Redirection de l'ancien chemin vers le nouveau

    // Dashboard route (Admin)
    Route::get('/admin/tableau-de-bord', [AdminController::class, 'index'])->middleware('auth', 'admin')->name('dashboard'); // Nouveau chemin pour "dashboard"
    Route::redirect('/dashboard', '/admin/tableau-de-bord'); // Redirection de l'ancien chemin vers le nouveau

    // User routes
    Route::get('/compte-utilisateur', [UserController::class, 'account'])->name('UserAccount'); // Nouveau chemin pour le compte utilisateur
    Route::redirect('/UserAccount', '/compte-utilisateur'); // Redirection de l'ancien chemin vers le nouveau

    Route::post('/supprimer-utilisateurs-selectionnes', [UserController::class, 'deleteSelected'])->name('delete.selected.users'); // Nouveau chemin pour la suppression d'utilisateurs
    Route::redirect('/delete-selected-users', '/supprimer-utilisateurs-selectionnes'); // Redirection de l'ancien chemin

    Route::get('/filtrer-utilisateurs-par-cours', [AdminController::class, 'filterUsersByCourse'])->name('filter.users.by.course'); // Nouveau chemin pour le filtrage par cours
    Route::redirect('/filter-users-by-course', '/filtrer-utilisateurs-par-cours'); // Redirection de l'ancien chemin

    Route::get('/exporter-utilisateurs-par-cours/{course}', [AdminController::class, 'exportUsersByCourse'])->name('export.users.by.course'); // Nouveau chemin pour l'exportation
    Route::redirect('/export-users-by-course/{course}', '/exporter-utilisateurs-par-cours/{course}'); // Redirection de l'ancien chemin

    // Form routes
    Route::get('/formulaire', [FormController::class, 'showForm'])->name('form'); // Nouveau chemin pour les formulaires
    Route::redirect('/form', '/formulaire'); // Redirection de l'ancien chemin

    Route::post('/formulaire', [FormController::class, 'submitForm'])->name('form.submit');
    Route::post('/supprimer-formulaires-selectionnes', [FormController::class, 'deleteSelected'])->name('delete.selected.forms');
    Route::redirect('/delete-selected-forms', '/supprimer-formulaires-selectionnes'); // Redirection

    Route::get('/telecharger-fichier/{form}', [FormController::class, 'downloadFile'])->name('download.file'); // Nouveau chemin pour le téléchargement de fichier
    Route::redirect('/download-file/{form}', '/telecharger-fichier/{form}'); // Redirection

    // Admin-related actions (Slider, Activities, etc.)
    Route::get('/admin/modifier-activites', [AdminController::class, 'editActivities'])->name('edit.activities'); // Nouveau chemin pour la modification des activités
    Route::redirect('/admin/edit-activities', '/admin/modifier-activites'); // Redirection

    Route::post('/admin/mettre-a-jour-activites', [AdminController::class, 'updateActivities'])->name('update.activities');
    Route::post('/mettre-a-jour-slider-images', [AdminController::class, 'updateSliderImages'])->name('update.slider.images');
    Route::post('/mettre-a-jour-slider-images2', [AdminController::class, 'updateSliderImages2'])->name('update.slider.images2');
    Route::post('/mettre-a-jour-actualites', [AdminController::class, 'updateActualities'])->name('update.actualities');

    // Static pages
    Route::get('/politique-de-confidentialite', [PageController::class, 'privacyPolice'])->name('privacy-police'); // Nouveau chemin pour la politique de confidentialité
    Route::redirect('/privacy-police', '/politique-de-confidentialite'); // Redirection

    // Payment pages
    Route::get('/tarifs', fn() => view('price')); // Nouveau chemin pour la page des tarifs
    Route::redirect('/price', '/tarifs'); // Redirection

    Route::get('/paiement', [PaymentController::class, 'showPaymentPage'])->name('payment'); // Nouveau chemin pour la page de paiement
    Route::redirect('/payment', '/paiement'); // Redirection

    // Activity and actuality content
    Route::get('/nos-activites', fn() => view('activityContent'));
    Route::redirect('/activityContent', '/nos-activites');

    Route::get('/notre-actualite', fn() => view('actualityContent'));
    Route::redirect('/actualityContent', '/notre-actualite');

    // Custom action with middleware
    Route::post('/une-action', 'SomeController@action')
        ->middleware(['custom.csrf', 'check.referer', 'double.submit.cookie']);
    Route::redirect('/some-action', '/une-action'); // Redirection de l'action personnalisée
});
