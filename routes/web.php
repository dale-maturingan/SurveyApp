<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ForumsController;
use App\Http\Controllers\SurveyListController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\EditSurvey;
use App\Models\surveys_posted;
use App\Models\survey_questions;
use App\Models\survey_choices;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*--Route::get('/', function () {
    return view('welcome');
});
*/

/* ROUTE FOR SURVEY */
Route::get('/new_survey', function () {
    return view('new_survey');
});

Route::get('/posted_surveys', function () {
    return view('posted_surveys');
})->name('posted_surveys');

Route::get('/form', function () {
    return view('form');
});

Route::get('/survey', function () {
    return view('survey');
});

Route::get('/answer_survey/{survey_selected}', [SurveyController::class, 'fetchSurveyToBeAnswered'])->name('answer_survey');
Route::get('/edit_survey/{survey_selected}', [SurveyController::class, 'fetchSurveyToBeEdited'])->name('edit_survey');
Route::get('/delete_survey/{survey_selected}', [SurveyController::class, 'deleteSurvey'])->name('delete_survey');
/* ROUTE FOR SURVEY */

/* ROUTE FOR FORUMS */
Route::get('/new_forum', function () {
    return view('new_forum');
});

Route::get('/posted_forums', function () {
    return view('posted_forums');
})->name('posted_forums');

Route::get('/view_forum/{forum_selected}', [ForumsController::class, 'viewForum'])->name('view_forum');
Route::get('/delete_forum/{forum_selected}', [ForumsController::class, 'deleteForum'])->name('delete_forum');
/* ROUTE FOR FORUMS */

