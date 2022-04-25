<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'deleteCourse'];

    public $title;
    public $ue_code;
    public $course_id;
    public $search;
    public $oderBy;
    public $pageSize;

    protected $rules = [
        'title' => 'required|min:2|string',
        'ue_code' => 'required|min:2|string',
    ];

    public function mount()
    {
        $this->oderBy = 'desc';
        $this->pageSize = 7;
        $this->initializeCourse();
    }

    public function render()
    {
        if (!empty($this->search)) {
            $search = '%'.$this->search.'%';
            $courses = Course::where('title', 'like', $search)->where('ue_code', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        } else {
            $courses = Course::orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }
        return view('livewire.course-component', compact('courses'));
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

    public function deleteCourse($id)
    {
        Course::find($id)->delete();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute deleted successfully', ['attribute' =>  __('Cours')]),
        ]);
    }

    public function initializeCourse()
    {
        $this->title = null;
        $this->ue_code = null;
        $this->course_id = null;
    }

    public function initializeForCreateCourse()
    {
        $this->title = null;
        $this->ue_code = null;
        $this->course_id = null;
        $this->resetValidation();
        $this->resetErrorBag();

        $this->emit("modalShow", ['id'=> 'modal-default']);
    }

    public function createCourse()
    {
        $this->emit("modalClose", ['id'=> "modal-default"]);
        $validatedData = $this->validate();
        Course::create($validatedData);

        $this->initializeCourse();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute created successfully', ['attribute' =>  __('Cours')]),
        ]);

    }

    public function getData($id)
    {
        $this->resetValidation();
        $this->resetErrorBag();

        $Course = Course::find($id);
        $this->title = $Course->title;
        $this->ue_code = $Course->ue_code;
        $this->course_id = $Course->id;
        $this->emit("modalShow", ['id'=> 'modal-update']);
    }

    public function updateCourse()
    {
        $this->emit("modalClose", ['id'=> 'modal-update']);
        $validatedData = $this->validate();
        $Course = Course::find($this->course_id);
        $Course->update($validatedData);

        $this->initializeCourse();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute updated successfully', ['attribute' =>  __('Cours')]),
        ]);
    }
}
