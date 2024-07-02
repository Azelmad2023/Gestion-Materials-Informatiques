<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Commune\CommuneController;
use App\Http\Controllers\Etablissement\EtablissementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AdminController::class, 'login'])->name('login_form')->middleware('adminguest');



// everything related to Etablissement Actions
Route::prefix('etablissement')->group(function () {
    Route::get('/loginForm', [EtablissementController::class, 'login'])->name('etablissement_login_form');
    Route::post('/loginSubmit', [EtablissementController::class, 'loginSubmit'])->name('etablissement_login_submit');
    Route::get('/forget-password', [EtablissementController::class, 'forget_password'])->name('etablissement_forget_password');
    Route::post('/forget-password-submit', [EtablissementController::class, 'forget_password_submit'])->name('etablissement_forget_password_submit');
    Route::get('/reset-password/{token}', [EtablissementController::class, 'reset_password_form'])->name('etablissement_password_reset');
    Route::post('/reset-password-submit', [EtablissementController::class, 'reset_password_submit'])->name('etablissement_reset_password_submit');
    Route::get('/dashboard', [EtablissementController::class, 'dashboard'])->name('etablissement_dashboard');
});


Route::middleware('etablissement')->prefix('etablissement')->group(function () {
    Route::get('/dashboard', [EtablissementController::class, 'dashboard'])->name('etablissement_dashboard');
    Route::get('/logout', [EtablissementController::class, 'logout'])->name('etablissement_logout');
});
// END Etablissement


// everything related to the ADMIN

Route::middleware('adminguest')->prefix('admin')->group(function () {
    Route::get('/loginForm', [AdminController::class, 'login'])->name('login_form');
    Route::post('/loginSubmit', [AdminController::class, 'loginSubmit'])->name('admin_login_submit');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password-submit', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}', [AdminController::class, 'reset_password_form'])->name('admin_password_reset');
    Route::post('/reset-password-submit', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
});

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
    Route::get('/fetch-etablissements/{communeId}', [AdminController::class, 'fetchEtablissements']);
    Route::get('/show-material-informatique/{etablissementId}', [AdminController::class, 'showMaterialInformatique'])->name('admin.show_material_informatique');
    Route::get('/download-pdf', [AdminController::class, 'downloadPdf'])->name('admin.download_pdf');
    Route::get('/add-material/{etablissementId}', [AdminController::class, 'showAddMaterialForm'])->name('admin.add_material');
    Route::post('/add-material-submit', [AdminController::class, 'addMaterialSubmit'])->name('admin.add_material.submit');
    Route::delete('/material-informatique/{id}', [AdminController::class, 'destroyMaterial'])->name('material-informatique.destroyMaterial');
    Route::get('/material-informatique/{Num_Inv}/edit/{code_Gresa}', [AdminController::class, 'editMaterial'])->name('material-informatique.edit');
    Route::put('/material-informatique/{Num_Inv}', [AdminController::class, 'updateMaterialSubmit'])->name('material-informatique.updateSubmit');
    Route::get('/previous-page', [AdminController::class, 'back'])->name('admin.previous-page');

    // Communes Management
    Route::get('/add-commune-form', [CommuneController::class, 'add_cummune_form'])->name('admin_add_commune_form');
    Route::post('/add-commune-submit', [CommuneController::class, 'add_cummune_submit'])->name('admin.add_commune.submit');
    Route::get('/add-commune-show_communes', [CommuneController::class, 'show_communes'])->name('admin.show_communes');
    Route::get('/communes-edit/{code_Commune}', [CommuneController::class, 'editCommune'])->name('commune-edit');
    Route::put('/communes-edit-submit/{code_Commune}', [CommuneController::class, 'editCommuneSubmit'])->name('update-commune-submit');
    Route::delete('/delete-commune/{code_Commune}', [CommuneController::class, 'destroyCommune'])->name('delete-commune.destroyCommune');

    // Etablissements Management
    Route::get('/add-etablissement-form', [EtablissementController::class, 'add_etablissement_form'])->name('admin_add_etablissement_form');
    Route::post('/add-etablissement-submit', [EtablissementController::class, 'add_etablissement_submit'])->name('admin.add_etablissement.submit');
    Route::get('/show-etablissements', [EtablissementController::class, 'show_etablissements'])->name('admin.show_etablissements');
    Route::get('/edit-etablissement/{code_Gresa}', [EtablissementController::class, 'edit_etablissement'])->name('etablissement-edit');
    Route::put('/edit-etablissement-submit/{code_Gresa}', [EtablissementController::class, 'edit_etablissement_submit'])->name('update-etablissement-submit');
    Route::delete('/delete-etablissement/{code_Gresa}', [EtablissementController::class, 'destroy_etablissement'])->name('delete-etablissement.destroy_etablissement');
});
// END ADMIN


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
