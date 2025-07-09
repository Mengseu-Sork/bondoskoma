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
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\LifeSkillController;
use App\Http\Controllers\EnhancementController;
use App\Http\Controllers\StrategyController;
use App\Http\Controllers\ProgramController;

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
Route::apiResource( 'lifeskills' , LifeSkillController::class);
Route::apiResource( 'images' , ImageController::class);
Route::apiResource( 'videos' , VideoController::class);
Route::apiResource( 'partner' , PartnersController::class);
Route::apiResource( 'contact' , ContactController::class);
Route::apiResource( 'job' , JobAnnouncementController::class);
Route::get('/admin', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/create_admin', [AuthController::class, 'store']);
Route::put('/admin/{id}', [AuthController::class, 'update']);
Route::post('/admin/verify', [AuthController::class, 'verifyCredentials']);


// use App\Http\Controllers\NotificationController;
// Route::middleware('auth:sanctum')->get('/admin', [AuthController::class, 'index']);
Route::apiResource( 'jobs' , JobAnnouncementController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/create_admin', [AuthController::class, 'store']);
Route::apiResource('applies', ApplyController::class);
Route::resource('notifications', NotificationController::class); 
Route::apiResource('reports', ReportsController::class);
Route::apiResource('volunteers', VolunteerController::class);
Route::apiResource('enhancements', EnhancementController::class);
Route::apiResource('strategies', StrategyController::class);
Route::apiResource('programs', ProgramController::class);