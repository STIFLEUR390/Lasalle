<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Teacher;
use Livewire\Component;
use App\Models\AppSetting;
use App\Models\TeacherGrade;
use App\Models\TeacherStatus;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class CreateTeacherComponent extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $grade_id;
    public $matricule;
    public $statut_id;
    public $email;
    public $gender;
    public $phone;
    public $photo;
    public $teacherStatusArray;
    public $teacherGradeArray;

    protected function rules()
    {
        return [
            'first_name' => 'required|string|min:4',
            'last_name' => 'required|string|min:4',
            'grade_id' => ['required',Rule::in($this->teacherGradeArray)],
            'matricule' => 'required|string|min:4',
            'statut_id' => ['required',Rule::in($this->teacherStatusArray)],
            'email' => 'required|email|unique:teachers,email',
            'gender' => 'required|in:male,female',
            'phone' => 'required|numeric|digits:9',
            'photo' => 'required|image|max:4096',
        ];
    }

    public function mount()
    {
        $this->teacherStatusArray = TeacherStatus::pluck('id');
        $this->teacherGradeArray = TeacherGrade::pluck('id');
        $app_setting = AppSetting::firstOrFail();
        if ($app_setting->matricule) {
            $pre = null;
            $pres = preg_split("/[\s,_-]+/", $app_setting->name);
            foreach ($pres as $value) {
                $pre.=$value[0];
            }
            $this->matricule = $pre. Carbon::now()->format('YmdHms');
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $teacher_status = TeacherStatus::all();
        $teacher_grades = TeacherGrade::all();
        return view('livewire.teacher.create-teacher-component', compact('teacher_status', 'teacher_grades'));
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
