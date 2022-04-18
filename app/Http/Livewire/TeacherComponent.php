<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TeacherComponent extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $teachers = Teacher::all();
        return view('livewire.teacher-component', compact('teachers'));
    }
}
