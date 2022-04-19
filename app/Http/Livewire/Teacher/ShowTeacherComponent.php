<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Teacher;
use Livewire\Component;

class ShowTeacherComponent extends Component
{
    public $teacher_id;

    public function mount($id)
    {
        $this->teacher_id = $id;
    }

    public function render()
    {
        $teacher = Teacher::find($this->teacher_id);
        return view('livewire.teacher.show-teacher-component', compact('teacher'));
    }
}
