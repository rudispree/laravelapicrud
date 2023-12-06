<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SclassController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/class',[SclassController::class, 'Index']);
Route::post('/class/store',[SclassController::class, 'Store']);
Route::get('/class/edit/{id}',[SclassController::class, 'Edit']);
Route::post('/class/update/{id}',[SclassController::class, 'Update']);
Route::get('/class/delete/{id}',[SclassController::class,'Delete']);


// subject Class Route
Route::get('/subject',[SubjectController::class, 'Index']);
Route::post('/subject/store',[SubjectController::class, 'Store']);
Route::get('/subject/edit/{id}',[SubjectController::class, 'Edit']);
Route::post('/subject/update/{id}',[SubjectController::class, 'Update']);
Route::get('/subject/delete/{id}',[SubjectController::class,'Delete']);


// section Class Route
Route::get('/section',[SectionController::class, 'Index']);
Route::post('/section/store',[SectionController::class, 'Store']);
Route::get('/section/edit/{id}',[SectionController::class, 'Edit']);
Route::post('/section/update/{id}',[SectionController::class, 'Update']);
Route::get('/section/delete/{id}',[SectionController::class,'Delete']);

// student Class Route
Route::get('/student',[StudentController::class, 'Index']);
Route::post('/student/store',[StudentController::class, 'Store']);
Route::get('/student/edit/{id}',[StudentController::class, 'Edit']);
Route::post('/student/update/{id}',[StudentController::class, 'Update']);
Route::get('/student/delete/{id}',[StudentController::class,'Delete']);