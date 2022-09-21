<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/scholars/{code}', [App\Http\Controllers\Api\ScholarController::class, 'index']);
Route::get('/qualifiers/{code}', [App\Http\Controllers\Api\QualifierController::class, 'index']);
Route::get('/endorsements/{code}', [App\Http\Controllers\Api\EndorsementController::class, 'index']);
Route::post('/endorsement/store', [App\Http\Controllers\Api\EndorsementController::class, 'store']);
Route::post('/endorsement/update', [App\Http\Controllers\Api\EndorsementController::class, 'update']);

Route::prefix('01101011 01110010 01100001 01100100')->group(function(){
    Route::get('/dropdowns', [App\Http\Controllers\DropdownController::class, 'api']);
    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'api']);
    Route::get('/schools', [App\Http\Controllers\SchoolController::class, 'api']);
    Route::get('/location/{type}', [App\Http\Controllers\LocationController::class, 'api']);
    Route::get('/agencies', [App\Http\Controllers\AgencyController::class, 'api']);
    Route::get('/expenses', [App\Http\Controllers\ExpenseController::class, 'api']);
    Route::get('/programs', [App\Http\Controllers\ProgramController::class, 'api']);
    Route::get('/privileges', [App\Http\Controllers\PrivilegeController::class, 'api']);
});