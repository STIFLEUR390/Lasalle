<?php

namespace App\Http\Livewire\Teacher;

use File;
use App\Models\Teacher;
use Livewire\Component;
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

    protected function rules()
    {
        return [
            'first_name' => 'required|string|min:4',
            'last_name' => 'required|string|min:4',
            'grade' => 'required|string',
            'matricule' => ['required','string','min:4',Rule::unique('teachers')->ignore($this->teacher_id)],
            'status' => 'required|string',
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
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.teacher.edit-teacher-component');
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
