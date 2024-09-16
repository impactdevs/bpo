<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\FormSettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\Settingcontroller;
use App\Models\Entry;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

Route::post('/documents/{document}/import', [DocumentController::class, 'import'])->name('documents.import');
Route::get('registered_entities', [DashboardController::class, 'registered_entities'])->name('registered_entities');

Route::get("size_of_the_company",[DashboardController::class, 'sizeOfTheCompany'])->name('size_of_the_company');
Route::get("trends_over_time", [DashboardController::class, 'TrendsOverTime'])->name('trends_over_time');
Route::get("technology_adoption", [DashboardController::class, 'TechnologyAdoption'])->name('technology_adoption');
Route::post("update-cleaned-data", [ReportController::class, 'cleanData'])->name('update-cleaned-data');
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
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
Route::get('/aggregations/{uuid}', [ReportController::class, 'aggregate'])->name('aggregations');
Route::get('/aggregations-data/{uuid}', [ReportController::class, 'aggregateData'])->name('aggregations.data');


//document routes
Route::resource('documents', DocumentController::class)->only(['index', 'store', 'destroy', 'show']);
Route::resource('settings', Settingcontroller::class);

Route::get('documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
//document routes

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
