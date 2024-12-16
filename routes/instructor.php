<?php

use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\Instructor\PaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authorize;

// Route::get('/', function () {
//     return view('instructor.dashboard');
// });

Route::redirect('/', '/instructor/courses')->middleware('can:Crear cursos')->name('home');

/**Courses* */
Route::resource('courses', CourseController::class)->middleware('can:Crear cursos');
Route::get('courses/{course}/video', [CourseController::class, 'video'])->name('courses.video');
Route::get('courses/{course}/goals', [CourseController::class, 'goals'])->name('courses.goals');
Route::get('courses/{course}/requirements', [CourseController::class, 'requirements'])->name('courses.requirements');
Route::get('courses/{course}/curriculum', [CourseController::class, 'curriculum'])->name('courses.curriculum');
Route::get('courses/{course}/students', [CourseController::class, 'students'])->name('courses.students');
Route::post('courses/{category}/selected', [CourseController::class, 'selected'])->name('courses.selected');

Route::post('courses/{course}/status', [CourseController::class, 'status'])->name('courses.status');

//observationstext
Route::get('courses/{course}/observations', [CourseController::class, 'observations'])->name('courses.observations');

//Metodos de pago para el instructor
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index')->middleware('can:Crear cursos');