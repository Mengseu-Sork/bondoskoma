<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\JobAnnouncementController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\VideoController;
use App\Models\JobAnnouncement;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource( 'homes' , HomeController::class);
Route::apiResource( 'images' , ImageController::class);
Route::apiResource( 'videos' , VideoController::class);
Route::apiResource( 'partner' , PartnersController::class);
Route::apiResource( 'contact' , ContactController::class);
Route::apiResource( 'job' , JobAnnouncementController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/create_admin', [AuthController::class, 'store']);