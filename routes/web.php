<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController as AdminController;
use App\Http\Controllers\Customer\PageController as CustomerController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\SocialController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('admin/login',[AdminController::class,'postLogin'])->name('admin.post-login');
Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'auth'], function(){
    Route::get('', [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('questions/load-data',[QuestionsController::class,'loadData'])->name('questions.load-data');
    Route::get('list-question',[QuestionsController::class,'listQuestion'])->name('questions.list-question');
    Route::get('list-question/unit/{id}',[QuestionsController::class,'listQuestionUnit'])->name('questions.list-question-unit');
    Route::resource('questions',QuestionsController::class);

    // Route load view
    Route::get('load-view', [AdminController::class,'loadView'])->name('load-view');
    // text to speech
    Route::get('text-to-speech',[AdminController::class,'textToSpeech'])->name('text-to-speech');
});

Route::get('login',[CustomerController::class,'login'])->name('customer.login');
Route::post('login',[CustomerController::class,'postLogin'])->name('customer.post-login');
// ,'middleware'=>'auth:customer'
Route::group(['prefix'=>'','as'=>'customer.','middleware'=>'auth:customer'], function(){
    Route::get('',[CustomerController::class,'home'])->name('home');
    Route::get('question/unit/{id}', [CustomerController::class,'question'])->name('question');
    Route::post('answer/{id}',[CustomerController::class,'answer'])->name('answer');
    Route::get('unit/answer/{id}',[CustomerController::class,'unitAnswer'])->name('unit-answer');
});

Route::get('/auth/redirect/{provider}', [SocialController::class,'redirect'])->name('social.redirect');
Route::get('/login/callback/{provider}', [SocialController::class,'callback'])->name('social.callback');
