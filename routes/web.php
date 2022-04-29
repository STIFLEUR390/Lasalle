<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\AdminController;
use App\Http\Livewire\Back\User\ProfileComponent;
use App\Http\Livewire\Schedule\{CreateScheduleComponent, EditScheduleComponent, ScheduleComponent, UpdateStatusScheduleComponent};
use App\Http\Livewire\Teacher\{CreateTeacherComponent, EditTeacherComponent, TeacherComponent};
use App\Http\Livewire\{AppSetting, CourseComponent, DepartmentComponent, FacultyComponent, ManageRoomComponent, TeacherGradeComponent, TeacherStatusComponent};

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(['auth:sanctum', 'verified', 'permission:base'])->group(function () {

    // Route::get("/", [AdminController::class, 'index'])->name('home');

    Route::name('dashboard')->get('/', [AdminController::class, 'index']);
    Route::name('profile')->middleware(['password.confirm'])->get('user/profile', ProfileComponent::class);

    //teachers management
    Route::prefix("teachers")->name('teachers.')->group(function () {
        Route::name('index')->get('/', TeacherComponent::class)->middleware(['permission:show teacher|manage teacher']);
        Route::name('create')->get('/create', CreateTeacherComponent::class)->middleware(['permission:manage teacher']);
        Route::name('edit')->get('/{teacher}/edit', EditTeacherComponent::class)->middleware(['permission:manage teacher']);

        //grade and status
        Route::name('grade')->get('/grade', TeacherGradeComponent::class)->middleware(['permission:manage teacher grade']);
        Route::name('status')->get('/status', TeacherStatusComponent::class)->middleware(['permission:manage teacher status']);
    });

    // rooms managent
    Route::name('rooms')->get('rooms', ManageRoomComponent::class)->middleware(['permission:manage room']);

    // courses managent
    Route::name('courses')->get('courses', CourseComponent::class)->middleware(['permission:manage course']);

    // departments managent
    Route::name('departments')->get('departments', DepartmentComponent::class)->middleware(['permission:manage department']);

    // faculties managent
    Route::name('faculties')->get('faculties', FacultyComponent::class)->middleware(['permission:manage faculty']);

    //schedule management
    Route::prefix("schedules")->name('schedules.')->group(function () {
        Route::name('index')->get('/', ScheduleComponent::class)->middleware(['permission:show schedule|manage schedule']);
        Route::name('create')->get('/create', CreateScheduleComponent::class)->middleware(['permission:manage schedule']);
        Route::name('edit')->get('/{id}/edit', EditScheduleComponent::class)->middleware(['permission:manage schedule']);

        //Update status
        Route::name('status')->get('/status', UpdateStatusScheduleComponent::class)->middleware(['permission:manage schedule status']);
    });

    //user management
    /* Route::prefix("schedules")->name('schedules.')->group(function () {
        Route::name('index')->get('/', ScheduleComponent::class)->middleware(['permission:show user|manage user']);
        Route::name('create')->get('/create', CreateScheduleComponent::class)->middleware(['permission:manage user']);
        Route::name('edit')->get('/{id}/edit', EditScheduleComponent::class)->middleware(['permission:manage user']);
    }); */

    //app setting
    Route::name("settings")->get('/setting', AppSetting::class)->middleware(['permission:manage setting']);
});
