<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\AdminController;
use App\Http\Livewire\Back\User\ProfileComponent;
use App\Http\Livewire\Schedule\{CreateScheduleComponent, EditScheduleComponent, ScheduleComponent, UpdateStatusScheduleComponent};
use App\Http\Livewire\Teacher\{CreateTeacherComponent, EditTeacherComponent, TeacherComponent};
use App\Http\Livewire\{AppSetting, CourseComponent, DepartmentComponent, FacultyComponent, ManageRoomComponent, TeacherGradeComponent, TeacherStatusComponent};
use App\Http\Livewire\User\{CreateUserComponent, EditUserComponent, UserComponent};

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

Route::prefix('admin')->middleware(['auth:sanctum', 'verified', 'role:Admin|Super Admin|Invite'])->group(function () {

    // Route::get("/", [AdminController::class, 'index'])->name('home');

    Route::name('dashboard')->get('/', [AdminController::class, 'index']);
    Route::name('profile')->middleware(['password.confirm'])->get('user/profile', ProfileComponent::class);

    //teachers management
    Route::prefix("teachers")->name('teachers.')->group(function () {
        Route::name('index')->get('/', TeacherComponent::class)->middleware(['role:Admin|Super Admin|Invite']);
        Route::name('create')->get('/create', CreateTeacherComponent::class)->middleware(['role:Admin|Super Admin']);
        Route::name('edit')->get('/{teacher}/edit', EditTeacherComponent::class)->middleware(['role:Admin|Super Admin']);

        //grade and status
        Route::name('grade')->get('/grade', TeacherGradeComponent::class)->middleware(['role:Admin|Super Admin']);
        Route::name('status')->get('/status', TeacherStatusComponent::class)->middleware(['role:Admin|Super Admin']);
    });

    // rooms managent
    Route::name('rooms')->get('rooms', ManageRoomComponent::class)->middleware(['role:Admin|Super Admin|Invite']);

    // courses managent
    Route::name('courses')->get('courses', CourseComponent::class)->middleware(['role:Admin|Super Admin|Invite']);

    // departments managent
    Route::name('departments')->get('departments', DepartmentComponent::class)->middleware(['role:Admin|Super Admin|Invite']);

    // faculties managent
    Route::name('faculties')->get('faculties', FacultyComponent::class)->middleware(['role:Admin|Super Admin|Invite']);

    //schedule management
    Route::prefix("schedules")->name('schedules.')->group(function () {
        Route::name('index')->get('/', ScheduleComponent::class)->middleware(['role:Admin|Super Admin|Invite']);
        Route::name('create')->get('/create', CreateScheduleComponent::class)->middleware(['role:Super Admin']);
        Route::name('edit')->get('/{id}/edit', EditScheduleComponent::class)->middleware(['role:Super Admin']);

        //Update status
        Route::name('status')->get('/status', UpdateStatusScheduleComponent::class)->middleware(['role:Super Admin']);
    });

    //user management
    Route::prefix("users")->name('users.')->group(function () {
        Route::name('index')->get('/', UserComponent::class)->middleware(['role:Admin|Super Admin|Invite']);
        Route::name('create')->get('/create', CreateUserComponent::class)->middleware(['role:Super Admin']);
        Route::name('edit')->get('/{id}/edit', EditUserComponent::class)->middleware(['role:Super Admin']);
    });

    //app setting
    Route::name("settings")->get('/setting', AppSetting::class)->middleware(['role:Super Admin']);
});
