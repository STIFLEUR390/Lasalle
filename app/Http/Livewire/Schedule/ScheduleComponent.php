<?php

namespace App\Http\Livewire\Schedule;

use App\Models\{Course, Faculty, Room, Schedule, Teacher};
use Livewire\Component;
use Livewire\WithPagination;

class ScheduleComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'deleteSchedule'];

    public $search_type;
    public $search_value;
    public $search_date;
    public $pageSize;

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
        return view('livewire.schedule.schedule-component', compact('schedules', 'teachers', 'faculties', 'rooms', 'courses'));
    }

    public function resetSearchValue()
    {
        $this->search_value = '';
    }

    public function confirmDeletion($id)
    {
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'title'       => __('Are you sure?'),
            'text'        => __("You won't be able to revert this!"),
            'confirmText' => __('Yes, delete!'),
            'method'      => 'delete',
            'params'      => $id, // optional, send params to success confirmation
            'callback'    => 'annuler', // optional, fire event if no confirmed
        ]);
    }

    public function deleteSchedule($id)
    {
        Schedule::find($id)->delete();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute deleted successfully', ['attribute' =>  __('Schedule')]),
        ]);
    }
}
