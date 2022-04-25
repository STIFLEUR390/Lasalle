<?php

namespace App\Http\Livewire;

use App\Models\TeacherStatus;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherStatusComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'deleteTeacherStatus'];

    public $name;
    public $teacherStatus_id;
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
        $this->initializeTeacherStatus();
    }

    public function render()
    {
        if (!empty($this->search)) {
            $search = '%'.$this->search.'%';
            $teacherStatuses = TeacherStatus::where('name', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        } else {
            $teacherStatuses = TeacherStatus::orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }
        return view('livewire.teacher-status-component', compact('teacherStatuses'));
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

    public function deleteTeacherStatus($id)
    {
        TeacherStatus::find($id)->delete();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute deleted successfully', ['attribute' =>  __('Teacher status')]),
        ]);
    }

    public function initializeTeacherStatus()
    {
        $this->name = null;
        $this->teacherStatus_id = null;
    }

    public function initializeForCreateTeacherStatus()
    {
        $this->name = null;
        $this->teacherStatus_id = null;
        $this->resetValidation();
        $this->resetErrorBag();

        $this->emit("modalShow", ['id'=> 'modal-default']);
    }

    public function createTeacherStatus()
    {
        $this->emit("modalClose", ['id'=> "modal-default"]);
        $validatedData = $this->validate();
        TeacherStatus::create($validatedData);

        $this->initializeTeacherStatus();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute created successfully', ['attribute' =>  __('Teacher status')]),
        ]);

    }

    public function getData($id)
    {
        $this->resetValidation();
        $this->resetErrorBag();

        $teacherStatus = TeacherStatus::find($id);
        $this->name = $teacherStatus->name;
        $this->teacherStatus_id = $teacherStatus->id;
        $this->emit("modalShow", ['id'=> 'modal-update']);
    }

    public function updateTeacherStatus()
    {
        $this->emit("modalClose", ['id'=> 'modal-update']);
        $validatedData = $this->validate();
        $teacherStatus = TeacherStatus::find($this->teacherStatus_id);
        $teacherStatus->update($validatedData);

        $this->initializeTeacherStatus();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute updated successfully', ['attribute' =>  __('Teacher status')]),
        ]);
    }
}
