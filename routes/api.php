<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GuardTrackingApiController;

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
Route::post('login', [App\Http\Controllers\API\GuardController::class, 'login']);
Route::get('login', [App\Http\Controllers\API\GuardController::class, 'login'])->name('api.login');
Route::put("forgot-password", [App\Http\Controllers\API\GuardController::class, 'forgotpassword']);
Route::get("otp-verification/{otp}/{email}", [App\Http\Controllers\API\GuardController::class, 'otp_verification']);
Route::put("reset-password", [App\Http\Controllers\API\GuardController::class, 'reset_password']);
Route::get("job-scheduler/{guardId}", [App\Http\Controllers\API\GuardController::class, 'job_scheduler'])->middleware('auth:api');
Route::put("attend-job", [App\Http\Controllers\API\GuardController::class, 'attend_job'])->middleware('auth:api');
Route::put("leave-job", [App\Http\Controllers\API\GuardController::class, 'leave_job'])->middleware('auth:api');
Route::post("start-break", [App\Http\Controllers\API\GuardController::class, 'start_break'])->middleware('auth:api');
Route::put("end-break", [App\Http\Controllers\API\GuardController::class, 'end_break'])->middleware('auth:api');
Route::get("jobsheduler/{scheduleId}", [App\Http\Controllers\API\GuardController::class, 'jobschedulebyid']);
Route::get("wages/{scheduleId}", [App\Http\Controllers\API\GuardController::class, 'calculatebreak']);

// for notification

Route::get('job-notification', [App\Http\Controllers\API\GuardController::class, 'job_notification'])->middleware('auth:api');

// for guard tracking
Route::post('guard/tracking/history/add', [GuardTrackingApiController::class, 'tracking_add'])->middleware('auth:api');
Route::get('guard/tracking/history/fetch/{job_id}/{security_id}', [GuardTrackingApiController::class, 'tracking_fetch'])->middleware('auth:api');
