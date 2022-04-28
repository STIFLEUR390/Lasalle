<?php

namespace App\Http\Livewire\Schedule;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\{Course, Faculty, Room, Schedule, Teacher};
use Carbon\Carbon;
use DB;

class EditScheduleComponent extends Component
{
    public $teacher_id;
    public $faculty_id;
    public $date;
    public $start_time;
    public $end_time;
    public $room_id;
    public $course_id;
    public $ue_code;
    public $teacherArray;
    public $facultyArray;
    public $roomArray;
    public $courseArray;
    public $day;
    public $schedule_id;

    protected function rules()
    {
        return [
            'teacher_id' => ['required',Rule::in($this->teacherArray)],
            'faculty_id' => ['required',Rule::in($this->facultyArray)],
            'date' => ['required','date','after_or_equal:'.$this->day],
            'start_time' => 'required',
            'end_time' => 'required',
            'room_id' => ['required',Rule::in($this->roomArray)],
            'course_id' => ['required',Rule::in($this->courseArray)],
            'ue_code' => 'required|min:2',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($id)
    {
        $this->teacherArray = Teacher::pluck('id');
        $this->facultyArray = Faculty::pluck('id');
        $this->roomArray = Room::pluck('id');
        $this->courseArray = Faculty::pluck('id');
        $this->day = Carbon::now()->format('Y-m-d');

        $schedule = Schedule::find($id);
        $this->teacher_id = $schedule->teacher_id;
        $this->faculty_id = $schedule->faculty_id;
        $this->date = $schedule->date;
        $this->end_time = $schedule->end_time;
        $this->start_time = $schedule->start_time;
        $this->room_id = $schedule->room_id;
        $this->course_id = $schedule->course_id;
        $this->ue_code = $schedule->ue_code;
        $this->schedule_id = $schedule->id;

    }

    public function render()
    {
        // $teachers = Teacher::all();
        $teachers = Teacher::orderBy('last_name')->get();
        $faculties = Faculty::orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();
        $courses = Course::orderBy('title')->get();
        return view('livewire.schedule.edit-schedule-component', compact('teachers', 'faculties', 'rooms', 'courses'));
    }

    public function updateSchedule()
    {
        $validatedData = $this->validate();

        $schedule = Schedule::find($this->schedule_id);
        $schedule->update($validatedData);

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute updated successfully', ['attribute' =>  __("Schedule")]),
        ]);
    }
}
