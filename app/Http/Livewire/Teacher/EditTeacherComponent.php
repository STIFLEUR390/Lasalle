<?php

namespace App\Http\Livewire\Teacher;

use File;
use App\Models\Teacher;
use Livewire\Component;
use App\Models\TeacherGrade;
use App\Models\TeacherStatus;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class EditTeacherComponent extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $grade;
    public $matricule;
    public $status;
    public $email;
    public $gender;
    public $phone;
    public $photo;
    public $img;
    public $teacher_id;
    public $teacherStatusArray;
    public $teacherGradeArray;

    protected function rules()
    {
        return [
            'first_name' => 'required|string|min:4',
            'last_name' => 'required|string|min:4',
            'grade' => ['required',Rule::in($this->teacherStatusArray)],
            'matricule' => ['required','string','min:4',Rule::unique('teachers')->ignore($this->teacher_id)],
            'status' => ['required',Rule::in($this->teacherStatusArray)],
            'email' => ['required','email',Rule::unique('teachers')->ignore($this->teacher_id)],
            'gender' => 'required|in:male,female',
            'phone' => ['required','numeric','digits:9',Rule::unique('teachers')->ignore($this->teacher_id)],
            'img' => 'nullable|image|max:4096',
        ];
    }

    public function mount(Teacher $teacher)
    {
        $this->first_name = $teacher->first_name;
        $this->last_name = $teacher->last_name;
        $this->grade = $teacher->grade;
        $this->matricule = $teacher->matricule;
        $this->status = $teacher->status;
        $this->email = $teacher->email;
        $this->gender = $teacher->gender;
        $this->phone = $teacher->phone;
        $this->photo = $teacher->photo;
        $this->teacher_id = $teacher->id;

        $this->teacherStatusArray = TeacherStatus::pluck('name');
        $this->teacherGradeArray = TeacherGrade::pluck('name');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $teacher_status = TeacherStatus::all();
        $teacher_grade = TeacherGrade::all();
        return view('livewire.teacher.edit-teacher-component', compact('teacher_status', 'teacher_grade'));
    }

    public function updateTeacher()
    {
        $this->validate();

        $teacher = Teacher::find($this->teacher_id);
        $teacher->first_name = $this->first_name;
        $teacher->last_name = $this->last_name;
        $teacher->grade = $this->grade;
        $teacher->matricule = $this->matricule;
        $teacher->status = $this->status;
        $teacher->email = $this->email;
        $teacher->gender = $this->gender;
        $teacher->phone = $this->phone;

        if ($this->img) {
            if ($this->photo != '/dist/img/avatar.png' || $this->photo != '/dist/img/avatar3.png') {
                File::delete($this->photo);
            }
            $filename = date('YmdHis') . $this->img->getClientOriginalName();
            $this->img->storeAs('public/upload/teacher/', $filename);
            $teacher->photo = 'storage/upload/teacher/' . $filename;
        }
        $teacher->save();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute updated successfully', ['attribute' =>  __('Teacher')]),
        ]);
    }
}
