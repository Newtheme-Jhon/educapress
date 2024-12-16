<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CkeditorController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\Post\CategoryController as PostCategoryController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Post\PostRequestController;
use App\Http\Controllers\Admin\Post\TagController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\TeacherApprovedController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TeacherPaymentController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    $users = User::all();
    return view('admin.dashboard', compact('users'));
})->name('dashboard')->middleware('can:admin.home');

//CRUDs
Route::resource('roles', RoleController::class)->names('roles')->middleware('can:admin.home');
Route::resource('users', UserController::class)->names('users')->middleware('can:admin.home');
Route::resource('categories', CategoryController::class)->names('categories')->middleware('can:admin.home');
Route::resource('subcategories', SubcategoryController::class)->names('subcategories')->middleware('can:admin.home');
Route::resource('levels', LevelController::class)->names('levels')->middleware('can:admin.home');
Route::resource('prices', PriceController::class)->names('prices')->middleware('can:admin.home');
Route::resource('posts', PostController::class)->names('posts')->middleware('can:admin.home');



//post_categories: es bueno si ponemos el nombre de la tabla, si no, no funciona
Route::resource('post_categories', PostCategoryController::class)->names('post_categories')->middleware('can:admin.home');
Route::resource('tags', TagController::class)->names('tags')->middleware('can:admin.home');

Route::get('courses', [CourseController::class, 'index'])->name('courses.index')->middleware('can:admin.home');

//Ver curso para revisar
Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show')->middleware('can:admin.home');

//Aprobar curso
Route::post('courses/{course}/approve', [CourseController::class, 'approve'])->name('courses.approve')->middleware('can:admin.home');
Route::get('courses/{course}/observation', [CourseController::class, 'observation'])->name('courses.observation')->middleware('can:admin.home');
Route::post('courses/{course}/reject', [CourseController::class, 'reject'])->name('courses.reject');

//teachers
Route::get('teachers/approved', [TeacherApprovedController::class, 'index'])->name('teachers.approved.index')->middleware('can:admin.home');
Route::get('teachers/approved/{id}/show', [TeacherApprovedController::class, 'show'])->name('teachers.approved.show')->middleware('can:admin.home');
Route::delete('teachers/approved/{id}/delete', [TeacherApprovedController::class, 'destroy'])->name('teachers.approved.destroy')->middleware('can:admin.home');
Route::post('teachers/approved/{id}/email-approved', [TeacherApprovedController::class, 'emailApproved'])->name('teachers.approved.emailApproved');

//teachers-payments
Route::get('teachers-payments', [TeacherPaymentController::class, 'index'])->name('teachers-payments.index')->middleware('can:admin.home');

//upload images ckeditor
Route::post('ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');

//get posts api
Route::get('api/posts/index', [PostRequestController::class, 'index'])->name('api.posts.index')->middleware('can:admin.home');
Route::get('api/posts/get', [PostRequestController::class, 'get'])->name('api.posts.get')->middleware('can:admin.home');
