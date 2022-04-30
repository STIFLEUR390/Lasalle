<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\AppSetting as ModelAppSetting;
use App\Exports\SchedulesExport;
use App\Models\{Course, Faculty, Room, Teacher};
use PDF;

class ExportDataComponent extends Component
{
    public $search_type;
    public $search_value;
    public $search_date;

    public function render()
    {
        $teachers = Teacher::orderBy('last_name')->get();
        $faculties = Faculty::orderBy('name')->get();
        $rooms = Room::orderBy('name')->get();
        $courses = Course::orderBy('title')->get();
        return view('livewire.export-data-component', compact('teachers', 'faculties', 'rooms', 'courses'));
    }

    public function resetSearchValue()
    {
        $this->search_value = '';
    }

    public function exportExcel()
    {
        return (new SchedulesExport($this->search_type, $this->search_value, $this->search_date))->download('schedules.xlsx');
    }

    public function exportCSV()
    {
        return (new SchedulesExport($this->search_type, $this->search_value, $this->search_date))->download('schedules.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportCSVWithDelemiter()
    {
        return (new SchedulesExport($this->search_type, $this->search_value, $this->search_date))->download('schedules.csv', \Maatwebsite\Excel\Excel::CSV, ['delimiter'=> ';']);
    }

    public function exportPDF()
    {
        return redirect()->route('export.pdf', [
            'search_type' => $this->search_type,
            'search_value' => $this->search_value,
            'search_date' => $this->search_date,
        ]);
    }
}
