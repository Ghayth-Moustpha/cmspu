<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NeedsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActorsController;
use App\Http\Controllers\RTMController;
use App\Http\Controllers\RCRController;

use App\Http\Controllers\FileController;

use App\Http\Controllers\AnalyticsController;

use App\Http\Controllers\RequirementController;






Route::post ("/users" , [UserController::class , 'store']) ; 
Route::get ("/users" , [UserController::class , 'index']) ; 
Route::get ("/users/{id}" , [UserController::class , 'show']) ; 
Route::post("/login/{type}" , [AuthController::class , 'login']) ; 

Route::get("/Team/{project}/{role}" , [TeamsController::class , "show"]) ; 
Route::get("/N-Team/{project}/{role}" , [TeamsController::class , "shownot"]) ; 

Route::post("/Team/attach/{project}/{user}" , [TeamsController::class , 'attach'] ) ; 
Route::post("/Team/detach/{project}/{user}" , [TeamsController::class , 'detach'] ) ; 



require __DIR__.'/customer.php';

Route::prefix('rcr')->middleware(['TokenAuth', 'auth:sanctum'] )->group(function () {
    Route::get('/index/{statusID}/{projectID}', [RCRController::class, 'index']);
    Route::post('/store', [RCRController::class, 'store']);

    Route::post("/result/{id}" , [RCRController::class , 'result']) ; 
    Route::get("/Accepted/{id}" , [RCRController::class , 'Accepted']) ; 
    Route::get("/Declined/{id}" , [RCRController::class , 'Declined']) ; 


    Route::get('/show/{id}', [RCRController::class, 'show']);
    Route::put('/{id}', [RCRController::class, 'update']);
    Route::delete('/{id}', [RCRController::class, 'destroy']);
});


Route::prefix('projects')->middleware(['TokenAuth', 'auth:sanctum'] )->group(function () {
    Route::get('/', [ProjectsController::class, 'index']);
    Route::post('/', [ProjectsController::class, 'store']);
    Route::get('/{id}', [ProjectsController::class, 'show']);
    Route::put('/{id}', [ProjectsController::class, 'update']);
    Route::delete('/{id}', [ProjectsController::class, 'destroy']);
}); 
Route::prefix('reports')->middleware(['TokenAuth', 'auth:sanctum'] )->group(function () {
    Route::get('/', [ReportController::class, 'index']);
    Route::post('/', [ReportController::class, 'store']);
    Route::get('/{id}', [ReportController::class, 'show']);
    Route::put('/{id}', [ReportController::class, 'update']);
    Route::delete('/{id}', [ReportController::class, 'destroy']);
}); 
Route::prefix('actors')->middleware(['TokenAuth', 'auth:sanctum'] )->group(function () {
    Route::get('/{id}', [ActorsController::class, 'index']);
    Route::post('/', [ActorsController::class, 'store']);
    Route::get('/view/{id}', [ActorsController::class, 'show']);
    Route::put('/{id}', [ActorsController::class, 'update']);
    Route::delete('/{id}', [ActorsController::class, 'destroy']);
}); 
Route::prefix("requirements")->middleware(['TokenAuth', 'auth:sanctum'])->group(function () {
    Route::get('{project_id}/', [RequirementController::class, 'index']);
    Route::get('view/{id}/', [RequirementController::class, 'view']);
    Route::get("needs/{need}" , [RequirementController::class , 'need_Requirement']); 
    Route::post('/', [RequirementController::class, 'store']);
    
    Route::put('/{requirement}', [RequirementController::class, 'update']);
    Route::delete('/{requirement}', [RequirementController::class, 'destroy']);
});
Route::prefix("RTM")->middleware(['TokenAuth', 'auth:sanctum'])->group(function () {
    Route::get('{project_id}/', [RTMController::class, 'index']);
    Route::get('view/{id}/', [RTMController::class, 'view']);
    
});
Route::prefix("analytics")->middleware(['TokenAuth', 'auth:sanctum'])->group(function () {
    Route::get('{req_id}', [AnalyticsController::class, 'index']);
    Route::post('', [AnalyticsController::class, 'store']);
    Route::put('', [AnalyticsController::class, 'update']);
    Route::delete('{id}', [AnalyticsController::class, 'destroy']);


    
});
Route::get('storage/{folderpath}/{filePath}', [FileController::class, 'download']);

Route::get('/', function () {
    return view('welcome');
});
