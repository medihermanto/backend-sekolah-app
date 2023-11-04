<?php

use App\Http\Controllers\Admin\StudentController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'ShowLoginForm']);

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->group(function () {

    Route::group(['middleware' => 'auth'], function () {
        // dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');
        // permissions
        Route::resource('/permission', App\Http\Controllers\Admin\PermissionController::class, ['except' => ['show', 'create', 'edit', 'update', 'delete'], 'as' => 'admin']);
        // roles
        Route::resource('/role', App\Http\Controllers\Admin\RoleController::class, ['except' => ['show'], 'as' => 'admin']);
        // users
        Route::resource('/user', App\Http\Controllers\Admin\UserController::class, ['except' => ['show'], 'as' => 'admin']);
        //tags
        Route::resource('/tag', App\Http\Controllers\Admin\TagController::class, ['except' => ['show'], 'as' => 'admin']);
        //categories
        Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class, ['except' => ['show'], 'as' => 'admin']);
        // posts
        Route::resource('/post', App\Http\Controllers\Admin\PostController::class, ['except' => ['show'], 'as' => 'admin']);
        // events
        Route::resource('/event', App\Http\Controllers\Admin\EventController::class, ['except' => ['show'], 'as' => 'admin']);
        // students
        Route::resource('/student', App\Http\Controllers\Admin\StudentController::class, ['except' => ['show'], 'as' => 'admin']);
        // slider
        Route::resource('/slider', App\Http\Controllers\Admin\SliderController::class, ['except' => ['show'], 'as' => 'admin']);
        // Photos
        Route::resource('/photo', App\Http\Controllers\Admin\PhotoController::class, ['except' => ['show'], 'as' => 'admin']);
        // Videos
        Route::resource('/video', App\Http\Controllers\Admin\VideoController::class, ['except' => ['show'], 'as' => 'admin']);
        // Classes
        Route::resource('/class', App\Http\Controllers\Admin\ClassController::class, ['except' => ['show'], 'as' => 'admin']);
        // Teachers
        Route::resource('/teacher', App\Http\Controllers\Admin\TeacherController::class, ['except' => ['show'], 'as' => 'admin']);
        // Profiles
        Route::resource('/profile', App\Http\Controllers\Admin\ProfileController::class, ['except' => ['show'], 'as' => 'admin']);
        // Subjects
        Route::resource('/subject', App\Http\Controllers\Admin\SubjectController::class, ['except' => ['show'], 'as' => 'admin']);
        Route::controller(StudentController::class)->group(function () {
            Route::get('student-export', 'export')->name('students.export');
            Route::post('student-import', 'import')->name('students.import');
            Route::get('student-export-pdf', 'exportPDF')->name('students.exportpdf');
        });
    });
});