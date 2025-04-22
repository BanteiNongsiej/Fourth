<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(StudentController::class)->group(function () {
    Route::post('/savestudent', 'saveStudent')->name('student.save');
    Route::get('/studentform', 'showStudentForm');
    Route::get('/students', 'showStudentList');
});