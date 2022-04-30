<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Course, Department, Faculty, Room, Teacher, User};

class DashboardComponent extends Component
{
    public function render()
    {
        //composer require asantibanez/livewire-charts
        $users_count = User::withTrashed()->count();
        // $users_count = User::all()->count();
        $teachers_count = Teacher::all()->count();
        $rooms_count = Room::all()->count();
        $courses_count = Course::all()->count();
        $departments_count = Department::all()->count();
        $faculties_count = Faculty::all()->count();

        return view('livewire.dashboard-component', compact('courses_count', 'departments_count', 'faculties_count','rooms_count' ,'teachers_count' ,'users_count'));
    }
}
