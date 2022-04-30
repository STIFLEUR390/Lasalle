<?php

namespace App\Exports;

use App\Models\Schedule;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Maatwebsite\Excel\Concerns\FromCollection;

class SchedulesExport implements FromView, WithTitle
// class SchedulesExport implements FromCollection, ShouldQueue
{
    use Exportable;

    public $search_type;
    public $search_value;
    public $search_date;

    public function __construct($search_type = null, $search_value = null, $search_date = null)
    {
        $this->search_type = $search_type;
        $this->search_value = $search_value;
        $this->search_date = $search_date;
    }

    public function view(): View
    {
        if (!empty($this->search_type) && !empty($this->search_value) && $this->search_date) {
            return view('exports.schedule', [
                'schedules' => Schedule::with(['teacher', 'faculty', 'room', 'course'])->where("date", $this->search_date)->where($this->search_type, $this->search_value)->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get()
            ]);

        } else if (!empty($this->search_type) && !empty($this->search_value)) {
            return view('exports.schedule', [
                'schedules' => Schedule::with(['teacher', 'faculty', 'room', 'course'])->where($this->search_type, $this->search_value)->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get()
            ]);

        } else if ($this->search_date) {
            return view('exports.schedule', [
                'schedules' => Schedule::with(['teacher', 'faculty', 'room', 'course'])->where("date", $this->search_date)->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get()
            ]);

        } else {
            return view('exports.schedule', [
                'schedules' => Schedule::with(['teacher', 'faculty', 'room', 'course'])->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get()
            ]);
        }

        return view('exports.schedule', [
            'schedules' => Schedule::with(['teacher', 'faculty', 'room', 'course'])->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get()
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return __('Schedule');
    }
}
