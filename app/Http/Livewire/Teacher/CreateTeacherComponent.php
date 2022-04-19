<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateTeacherComponent extends Component
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

    protected $rules = [
        'first_name' => 'required|string|min:4',
        'last_name' => 'required|string|min:4',
        'grade' => 'required|string',
        'matricule' => 'required|string|min:4',
        'status' => 'required|string',
        'email' => 'required|email|unique:teachers,email',
        'gender' => 'required|in:male,female',
        'phone' => 'required|numeric|digits:9',
        'photo' => 'required|image|max:4096',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.teacher.create-teacher-component');
    }

    public function createTeacher()
    {
        $validatedData = $this->validate();

        $teacher = Teacher::create($validatedData);

        $teacher_update = Teacher::find($teacher->id);
        $filename = date('YmdHis') . $this->photo->getClientOriginalName();
        $this->photo->storeAs('public/upload/teacher/', $filename);
        $teacher_update->photo = 'storage/upload/teacher/' . $filename;
        $teacher_update->save();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute created successfully', ['attribute' =>  __('Teacher')]),
        ]);
    }
}
