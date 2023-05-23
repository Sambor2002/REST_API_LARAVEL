<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students', [\App\Http\Controllers\API\StudentController::class, 'index']);
Route::post('students', [\App\Http\Controllers\API\StudentController::class, 'store']);
Route::get('students/{id}', [\App\Http\Controllers\API\StudentController::class, 'show']);
Route::get('students/{id}/edit', [\App\Http\Controllers\API\StudentController::class, 'edit']);
Route::get('students/{id}/edit', [\App\Http\Controllers\API\StudentController::class, 'update']);


