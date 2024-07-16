<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\FormSettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('form-builder', FormController::class);
Route::resource('fields', FormFieldController::class);
Route::resource('entries', EntryController::class);
Route::resource('reports', ReportController::class);
Route::resource('forms', FormController::class);
Route::get('/forms/{form}', [FormController::class, 'display_questionnaire'])->name('forms.show');
Route::get('/forms/{form}/entries', [EntryController::class, 'entries'])->name('forms.entries');
Route::get('/forms/{form}/settings', [FormSettingController::class, 'index'])->name('forms.settings');
Route::put('/update-settings', [FormSettingController::class, 'update'])->name('form-settings.update');

Route::get('/form', function(){
    return view('form.index');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
