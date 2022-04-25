<?php

namespace App\Http\Livewire;

use App\Models\TeacherGrade;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherGradeComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'deleteTeacherGrade'];

    public $name;
    public $teacherGrade_id;
    public $search;
    public $oderBy;
    public $pageSize;

    protected $rules = [
        'name' => 'required|min:2|string',
    ];

    public function mount()
    {
        $this->oderBy = 'desc';
        $this->pageSize = 7;
        $this->initializeTeacherGrade();
    }

    public function render()
    {
        if (!empty($this->search)) {
            $search = '%'.$this->search.'%';
            $teacherGrades = TeacherGrade::where('name', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        } else {
            $teacherGrades = TeacherGrade::orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }
        return view('livewire.teacher-grade-component', compact('teacherGrades'));
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
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function deleteTeacherGrade($id)
    {
        TeacherGrade::find($id)->delete();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute deleted successfully', ['attribute' =>  __('Teacher grade')]),
        ]);
    }

    public function initializeTeacherGrade()
    {
        $this->name = null;
        $this->teacherGrade_id = null;
    }

    public function initializeForCreateTeacherGrade()
    {
        $this->name = null;
        $this->teacherGrade_id = null;
        $this->resetValidation();
        $this->resetErrorBag();

        $this->emit("modalShow", ['id'=> 'modal-default']);
    }

    public function createTeacherGrade()
    {
        $this->emit("modalClose", ['id'=> "modal-default"]);
        $validatedData = $this->validate();
        TeacherGrade::create($validatedData);

        $this->initializeTeacherGrade();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute created successfully', ['attribute' =>  __('Teacher grade')]),
        ]);

    }

    public function getData($id)
    {
        $this->resetValidation();
        $this->resetErrorBag();

        $teacherGrade = TeacherGrade::find($id);
        $this->name = $teacherGrade->name;
        $this->teacherGrade_id = $teacherGrade->id;
        $this->emit("modalShow", ['id'=> 'modal-update']);
    }

    public function updateTeacherGrade()
    {
        $this->emit("modalClose", ['id'=> 'modal-update']);
        $validatedData = $this->validate();
        $teacherGrade = TeacherGrade::find($this->teacherGrade_id);
        $teacherGrade->update($validatedData);

        $this->initializeTeacherGrade();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute updated successfully', ['attribute' =>  __('Teacher grade')]),
        ]);
    }
}
