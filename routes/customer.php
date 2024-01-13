<?php

use App\Http\Controllers\NeedsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['TokenAuth', 'auth:sanctum'] )->group(function () {
    Route::prefix('needs')->group(function () {
        Route::get('', [NeedsController::class, 'index']);
        Route::get('/{id}', [NeedsController::class, 'show']);
        Route::post('', [NeedsController::class, 'store']);
        Route::post('updatestatus/{id}/{status}', [NeedsController::class, 'updatestatus']);

        Route::put('/{id}', [NeedsController::class, 'update']);
        Route::delete('{id}', [NeedsController::class, 'destroy']);
    });

});


