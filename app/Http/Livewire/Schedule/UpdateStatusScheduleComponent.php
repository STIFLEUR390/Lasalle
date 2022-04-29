<?php

namespace App\Http\Livewire\Schedule;

use App\Models\{Course, Faculty, Room, Schedule, Teacher};
use DB;
use Livewire\Component;
use Livewire\WithPagination;

class UpdateStatusScheduleComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search_type;
    public $search_value;
    public $search_date;
    public $pageSize;
    public $status;
    public $schedule_id;

    public function mount()
    {
        $this->pageSize = 7;
    }

    public function render()
    {
        if (!empty($this->search_type) && !empty($this->search_value) && $this->search_date) {
            $schedules = Schedule::with(['teacher', 'faculty', 'room', 'course'])->where("date", $this->search_date)->where($this->search_type, $this->search_value)->orderBy('date', 'desc')->orderBy('start_time', 'asc')->paginate($this->pageSize);
        } else if (!empty($this->search_type) && !empty($this->search_value)) {
            $schedules = Schedule::with(['teacher', 'faculty', 'room', 'course'])->where($this->search_type, $this->search_value)->orderBy('date', 'desc')->orderBy('start_time', 'asc')->paginate($this->pageSize);
        } else if ($this->search_date) {
            $schedules = Schedule::with(['teacher', 'faculty', 'room', 'course'])->where("date", $this->search_date)->orderBy('date', 'desc')->orderBy('start_time', 'asc')->paginate($this->pageSize);
        } else {
            $schedules = Schedule::with(['teacher', 'faculty', 'room', 'course'])->orderBy('date', 'desc')->orderBy('start_time', 'asc')->paginate($this->pageSize);
        }

        $teachers = Teacher::orderBy('last_name')->get();
        $faculties = Faculty::orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();
        $courses = Course::orderBy('title')->get();
        return view('livewire.schedule.update-status-schedule-component', compact('schedules', 'teachers', 'faculties', 'rooms', 'courses'));
    }

    public function resetSearchValue()
    {
        $this->search_value = '';
    }

    public function initializeSchedule()
    {
        $this->status = null;
        $this->schedule_id = null;
    }

    public function getData($id)
    {
        $this->resetValidation();
        $this->resetErrorBag();

        $schedule = Schedule::find($id);
        $this->status = $schedule->status;
        $this->schedule_id = $schedule->id;
        $this->emit("modalShow", ['id'=> 'modal-default']);
    }

    public function updateSchedule()
    {
        $this->emit("modalClose", ['id'=> 'modal-default']);

        DB::table('schedules')->where('id', $this->schedule_id)->update(['status' => $this->status]);

        $this->initializeSchedule();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute updated successfully', ['attribute' =>  __('Schedule status')]),
        ]);
    }
}
