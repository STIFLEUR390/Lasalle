<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\AdminController;
use App\Http\Livewire\Back\User\ProfileComponent;
use App\Http\Livewire\Schedule\{CreateScheduleComponent, EditScheduleComponent, ScheduleComponent};
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
    Route::middleware(['role:Admin'])->group(function () {
        Route::name('dashboard')->get('/', [AdminController::class, 'index']);
        Route::name('profile')->middleware(['password.confirm'])->get('user/profile', ProfileComponent::class);

        //teachers management
        Route::prefix("teachers")->name('teachers.')->group(function() {
            Route::name('index')->get('/', TeacherComponent::class);
            Route::name('create')->get('/create', CreateTeacherComponent::class);
            Route::name('edit')->get('/{teacher}/edit', EditTeacherComponent::class);

            //grade and status
            Route::name('grade')->get('/grade', TeacherGradeComponent::class);
            Route::name('status')->get('/status', TeacherStatusComponent::class);
        });

        // rooms managent
        Route::name('rooms')->get('rooms', ManageRoomComponent::class);

        // courses managent
        Route::name('courses')->get('courses', CourseComponent::class);

        // departments managent
        Route::name('departments')->get('departments', DepartmentComponent::class);

        // faculties managent
        Route::name('faculties')->get('faculties', FacultyComponent::class);
    });

    Route::middleware(['role:Super Admin'])->group(function(){
        //schedule management
        Route::prefix("schedules")->name('schedules.')->group(function() {
            Route::name('index')->get('/', ScheduleComponent::class);
            Route::name('create')->get('/create', CreateScheduleComponent::class);
            Route::name('edit')->get('/{teacher}/edit', EditScheduleComponent::class);
        });

        //app setting
        Route::name("settings")->get('/setting', AppSetting::class);
    });
});
