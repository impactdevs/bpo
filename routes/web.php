<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\FormSettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

Route::post('/documents/{document}/import', [DocumentController::class, 'import'])->name('documents.import');


Route::get('/', function () {
    $email = auth()?->user()?->email;
    if ($email == "admin@bpo.com") {
        return redirect()->route('dashboard');
    }
    return redirect()->route('entries.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Route::get('/dashboard', [ChartController::class, 'dashboard'])->name('dashboard');

Route::resource('form-builder', FormController::class);
Route::resource('fields', FormFieldController::class);
Route::post('add-condition', [FormFieldController::class, 'addConditionalVisibilityField'])->name('fields.add-condition');
Route::resource('entries', EntryController::class);
Route::resource('reports', ReportController::class);
Route::resource('forms', FormController::class);
Route::get('/forms/{form}', [FormController::class, 'display_questionnaire'])->name('forms.show');
Route::get('/forms/{form}/entries', [EntryController::class, 'entries'])->name('forms.entries');
Route::get('/forms/{form}/reports', [ReportController::class, 'reports'])->name('forms.reports');
Route::get('/forms/{form}/settings', [FormSettingController::class, 'index'])->name('forms.settings');
Route::put('/update-settings', [FormSettingController::class, 'update'])->name('form-settings.update');
Route::post('entry-update/{id}', [EntryController::class, 'entry_update'])->name('entry.update-up');
Route::resource('sections', SectionController::class);
Route::get('/get-condition/{field_id}', [FormFieldController::class, 'getConditionalVisibilityField'])->name('fields.get-condition');
Route::post('/save-draft', [EntryController::class, 'store'])->middleware('auth')->name('save-draft');
Route::get('/forms/survey/{form}/{user}', [EntryController::class, 'survey'])->name('form.survey');
Route::get('get-entries/{uuid}', [ReportController::class, 'getEntries'])->name('get-entries');
Route::post('/reports/data/{uuid}', [ReportController::class, 'getReportsData'])->name('reports.data');


//document routes
Route::resource('documents', DocumentController::class)->only(['index', 'store', 'destroy', 'show']);
Route::get('documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
//document routes

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
