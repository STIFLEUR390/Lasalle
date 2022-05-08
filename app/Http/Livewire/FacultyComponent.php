<?php

namespace App\Http\Livewire;

use App\Models\Faculty;
use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class FacultyComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'deleteFaculty'];

    public $name;
    public $department_id;
    public $faculty_id;
    public $search;
    public $departement_search;
    public $oderBy;
    public $pageSize;
    public $departmentArray;


    protected function rules()
    {
        return [
            'name' => 'required|min:2|string',
            'department_id' => ['required',Rule::in($this->departmentArray)],
        ];
    }

    public function mount($id=null)
    {
        $this->oderBy = 'desc';
        $this->pageSize = 7;
        $this->initializeFaculty();
        $this->departmentArray = Department::pluck('id');
        $this->departement_search = !empty($id) ? $id : null;
    }

    public function render()
    {
        if (!empty($this->search)) {
            $search = '%'.$this->search.'%';
            if (!empty($this->departement_search)) {
                $faculties = Faculty::with(['department'])->where('department_id', $this->departement_search)->where('name', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
            }else {
                $faculties = Faculty::with(['department'])->where('name', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
            }
        } else if(!empty($this->departement_search)){
            $faculties = Faculty::with(['department'])->where('department_id', $this->departement_search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }
         else {
            $faculties = Faculty::with(['department'])->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }
        $departments = Department::all();
        return view('livewire.faculty-component', compact('departments', 'faculties'));
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

    public function deleteFaculty($id)
    {
        Faculty::find($id)->delete();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute deleted successfully', ['attribute' =>  __('Faculty')]),
        ]);
    }

    public function initializeFaculty()
    {
        $this->name = null;
        $this->department_id = null;
        $this->faculty_id = null;
    }

    public function initializeForCreateFaculty()
    {
        $this->name = null;
        $this->department_id = null;
        $this->faculty_id = null;
        $this->resetValidation();
        $this->resetErrorBag();

        $this->emit("modalShow", ['id'=> 'modal-default']);
    }

    public function createFaculty()
    {
        $this->emit("modalClose", ['id'=> "modal-default"]);
        $validatedData = $this->validate();
        Faculty::create($validatedData);

        $this->initializeFaculty();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute created successfully', ['attribute' =>  __('Faculty')]),
        ]);

    }

    public function getData($id)
    {
        $this->resetValidation();
        $this->resetErrorBag();

        $faculty = Faculty::find($id);
        $this->name = $faculty->name;
        $this->department_id = $faculty->department_id;
        $this->faculty_id = $faculty->id;
        $this->emit("modalShow", ['id'=> 'modal-update']);
    }

    public function updateFaculty()
    {
        $this->emit("modalClose", ['id'=> 'modal-update']);

        $validatedData = $this->validate();
        $faculty = Faculty::find($this->faculty_id);
        $faculty->update($validatedData);

        $this->initializeFaculty();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute updated successfully', ['attribute' =>  __('Faculty')]),
        ]);
    }
}
