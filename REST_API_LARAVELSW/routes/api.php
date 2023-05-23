<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('woronowicz/50300/people', [\App\Http\Controllers\API\StudentController::class, 'index']);
Route::post('woronowicz/50300/people', [\App\Http\Controllers\API\StudentController::class, 'store']);
Route::get('woronowicz/50300/people/{id}', [\App\Http\Controllers\API\StudentController::class, 'show']);
Route::get('woronowicz/50300/people/{id}/edit', [\App\Http\Controllers\API\StudentController::class, 'edit']);
Route::put('woronowicz/50300/people/{id}/edit', [\App\Http\Controllers\API\StudentController::class, 'update']);
Route::delete('woronowicz/50300/people/{id}/delete', [\App\Http\Controllers\API\StudentController::class, 'delete']);



