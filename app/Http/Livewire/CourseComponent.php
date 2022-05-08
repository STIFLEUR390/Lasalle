<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\UeCode;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class CourseComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'deleteCourse'];

    public $title;
    public $ue_id;
    public $course_id;
    public $search;
    public $oderBy;
    public $pageSize;
    public $ueArray;
    public $search_ue;

    protected function rules()
    {
        return [
            'title' => 'required|min:2|string',
            'ue_id' => ['required',Rule::in($this->ueArray)],
        ];
    }

    public function mount()
    {
        $this->oderBy = 'desc';
        $this->pageSize = 7;
        $this->initializeCourse();

        $this->ueArray = UeCode::pluck('id');
    }

    public function render()
    {
        if (!empty($this->search) && !empty($this->search_ue)) {
            $search = '%'.$this->search.'%';
            $courses = Course::where('ue_id', $this->search_ue)->where('title', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }else if (!empty($this->search)) {
            $search = '%'.$this->search.'%';
            $courses = Course::where('title', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        } else if (!empty($this->search_ue)) {
            $courses = Course::where('ue_id', $this->search_ue)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }else {
            $courses = Course::orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }

        $ue_codes = UeCode::orderBy('name', 'asc')->get();
        return view('livewire.course-component', compact('courses', 'ue_codes'));
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
        $this->ue_id = null;
        $this->course_id = null;
    }

    public function initializeForCreateCourse()
    {
        $this->title = null;
        $this->ue_id = null;
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
        $this->ue_id = $Course->ue_id;
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
