<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// course
Route::get('/course/all', 'User\CourseController@index')->name('course.all');

Route::get('/course/course-search', 'User\CourseController@search')->name('course.search');

Route::get('/teacher/all', 'User\CourseController@teacher')->name('teacher.all');

Route::get('/teacher/teacher-search', 'User\CourseController@searchTeacher')->name('teacher.search');

Route::get('/course/{id}', 'User\CourseController@show')->name('course.detail');

Route::get('/teacher/{id}', 'User\CourseController@showTeacher')->name('teacher.detail');

//checkout
Route::post('/take-user-course', 'User\CourseUserController@store')->name('course.user.store');

//cart
Route::get('/cart', 'User\CourseController@cart')->name('cart');

Route::get('/add-to-cart/{id}', 'User\CourseController@addToCart')->name('add.to.cart');

Route::patch('/update-cart', 'User\CourseController@updateCart')->name('update.cart');

Route::post('remove-from-cart/{id}', 'User\CourseController@removeCart')->name('cart.user.destroy');


Route::get('/leave-user-course/{id}', 'User\CourseUserController@destroy')->name('course.user.destroy');

Route::post('/review', 'User\CourseController@store')->name('review.store.course');

Route::get('/review/{id}', 'User\CourseController@destroy')->name('review.destroy.course');

Route::post('/review/{id}', 'User\CourseController@update')->name('review.update.course');

Route::get('/course/search-tag/{id}', 'User\CourseController@searchByTag')->name('tag.search');

Route::get('/course/{course_id}/test/{test_id}', 'User\TestController@index')->name('test');

Route::post('/course/{course_id}/test/{test_id}', 'User\TestController@store')->name('test.store');

Route::get('/results/{result_id}', 'User\ResultController@show')->name('results.show');

Route::get('/course/{id}/your-result', 'User\ResultController@resultUser')->name('test.result');

//lesson
Route::get('/course/lesson-detail/{id}', 'User\LessonController@show')->name('lesson.detail');

Route::post('/take-user-lesson/{id}', 'User\LessonUserController@store')->name('lesson.user.store');

Route::get('/leave-u-lesson/{id}/{idCourse}', 'User\LessonUserController@destroy')->name('lesson.user.destroy');

Route::post('/lesson/review', 'User\LessonController@store')->name('review.store.lesson');

Route::get('/lesson/review/{id}', 'User\LessonController@destroy')->name('review.destroy.lessson');

Route::post('/lesson/review/{id}', 'User\LessonController@update')->name('review.update.lesson');

//user
Route::get('/user/profile', 'User\UserController@index')->name('user.profile');

Route::post('/users/profile/{id}', 'User\UserController@update')->name('user.profile.update');

Route::post('/users/profile/avartar/{id}', 'User\UserController@updateAvatar')->name('user.profile.avatar');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin_dasboard');
    Route::resource('users', 'Admin\UserController');
    Route::resource('courses', 'Admin\CourseController');
    Route::resource('tags', 'Admin\TagController');

    Route::get('courses/search-tag/{id}', 'Admin\CourseController@searchByTag')->name('course.search.tag');
    
    Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
        Route::get('/courses/payment-index', 'Admin\PaymentController@paymentIndex')->name('index');
        Route::post('/courses/payment', 'Admin\PaymentController@payment')->name('payment');
    });

    Route::group(['prefix' => 'lesson', 'as' => 'lesson.'], function () {
        Route::get('/{course}/index', 'Admin\LessonController@index')->name('index');
        Route::get('/{course}/create', 'Admin\LessonController@create')->name('create');
        Route::post('/{course}', 'Admin\LessonController@store')->name('store');
        Route::get('/{course}/{lesson}/edit', 'Admin\LessonController@edit')->name('edit');
        Route::put('/{course}/{lesson}', 'Admin\LessonController@update')->name('update');
        Route::delete('/{course}/{lesson}', 'Admin\LessonController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'test', 'as' => 'test.'], function () {
        Route::get('/course/{id}', 'Admin\TestController@index')->name('index');
        Route::get('/course/{id}/create', 'Admin\TestController@create')->name('create');
        Route::post('/course', 'Admin\TestController@store')->name('store');
        Route::get('/course/{course_id}/test/{test_id}', 'Admin\TestController@edit')->name('edit');
        Route::post('/course/{course_id}/test/{test_id}/update', 'Admin\TestController@update')->name('update');
        Route::delete('/course/{course_id}/test/{test_id}/delete', 'Admin\TestController@destroy')->name('delete');
    });
});
