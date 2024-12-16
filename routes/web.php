<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

use App\Livewire\CourseStatus;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('courses/my-courses', [CourseController::class, 'myCourses'])->name('courses.myCourses')->middleware('auth');
Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
Route::get('courses/{course}/buy', [CourseController::class, 'buy'])->name('courses.buy');

Route::get('courses-status/{course}/{lesson?}', CourseStatus::class)->name('courses.status')->middleware('auth');

//categories courses in seo
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

//Posts routes in seo
Route::get('blog', [PostController::class, 'index'])->name('posts.index');
Route::get('blog/{post}', [PostController::class, 'show'])->name('posts.show');

//no seo
Route::get('cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');

//Paypal routes no seo
Route::get('cart/paypalCreateOrder/{amount}', [CartController::class, 'paypalCreateOrder'])->name('cart.paypalCreateOrder');
Route::post('cart/paypalCompleteOrder', [CartController::class, 'paypalCompleteOrder'])->name('cart.paypalCompleteOrder');
Route::get('cart/paypal/success', [CartController::class, 'paypalSuccess'])->name('cart.paypal.success');

//Stripe routes no seo
Route::post('cart/stripe/checkout', [CartController::class, 'stripeCheckoutPayment'])->name('cart.stripeCheckoutPayment');
Route::get('cart/stripe/success', [CartController::class, 'stripeSuccessPayment'])->name('cart.stripeSuccessPayment');
Route::get('cart/stripe/cancel', [CartController::class, 'stripeCancelPayment'])->name('cart.stripeCancelPayment');

//Pages in seo
Route::get('quiero-ser-instructor', [WelcomeController::class, 'infoInstructor'])->name('pages.instructor');
Route::get('politica-de-privacidad', [WelcomeController::class, 'politicaPrivacidad'])->name('pages.privacidad');
Route::get('politica-de-cookies', [WelcomeController::class, 'politicaCookies'])->name('pages.cookies');
Route::get('terminos-y-condiciones', [WelcomeController::class, 'terminosCondiciones'])->name('pages.condiciones');
Route::get('formulario-instructor', [WelcomeController::class, 'formInstructor'])->name('pages.formInstructor')->middleware('auth');

Route::post('/send/formulario-instructor', [WelcomeController::class, 'sendFormInstructor'])->name('pages.sendFormInstructor');
//con esta ruta puedo ver el email, solo para editar
Route::get('index/email/response/form-instructor', [WelcomeController::class, 'indexFormInstructor'])->name('email.indexFormInstructor')->middleware('auth');

