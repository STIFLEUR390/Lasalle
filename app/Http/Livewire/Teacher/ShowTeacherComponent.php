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
        $teacher = Teacher::with(['teacherStatus', 'teacherGrade'])->whereId($this->teacher_id)->first();
        return view('livewire.teacher.show-teacher-component', compact('teacher'));
    }
}
