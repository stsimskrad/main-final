<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return inertia('Welcome');});
Route::get('/home', function () {  return inertia('Home/Index'); });

Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('addresses', App\Http\Controllers\AddressController::class);
Route::resource('agencies', App\Http\Controllers\AgencyController::class);
Route::resource('programs', App\Http\Controllers\ProgramController::class);
Route::resource('privileges', App\Http\Controllers\PrivilegeController::class);
Route::resource('expenses', App\Http\Controllers\ExpenseController::class);
Route::resource('courses', App\Http\Controllers\CourseController::class);
Route::resource('schools', App\Http\Controllers\SchoolController::class);
Route::resource('scholars', App\Http\Controllers\ScholarController::class);

Route::prefix('lists')->group(function(){
    Route::controller(App\Http\Controllers\ListController::class)->group(function(){
        Route::get('/provinces/{code}', 'provinces');
        Route::get('/municipalities/{code}', 'municipalities');
        Route::get('/barangays/{code}', 'barangays');
        Route::prefix('search')->group(function(){
            Route::post('/schools', 'schools');
            Route::post('/campuses', 'campuses');
            Route::post('/courses', 'courses');
        });
    });
});

Route::prefix('search')->group(function(){
    Route::controller(App\Http\Controllers\SchoolController::class)->group(function(){
        Route::get('/{type}', 'search');
    });
});

require __DIR__.'/auth.php';