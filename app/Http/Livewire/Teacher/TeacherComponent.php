<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'deleteTeacher', 'annuler' => 'annuler'];

    public $search;
    public $oderBy;
    public $pageSize;

    public function mount()
    {
        $this->oderBy = 'desc';
        $this->pageSize = 7;
    }

    public function render()
    {
        if (!empty($this->search)) {
            $search = '%'.$this->search.'%';
            $teachers = Teacher::where('first_name', 'like', $search)
                ->orWhere('last_name', 'like', $search)
                ->orWhere('gender', 'like', $search)
                ->orWhere('matricule', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orWhere('phone', 'like', $search)
                ->orderBy('updated_at', $this->oderBy)->paginate($this->pageSize);
        } else {
            $teachers = Teacher::orderBy('updated_at', $this->oderBy)->paginate($this->pageSize);
        }

        return view('livewire.teacher.teacher-component', compact('teachers'));
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
            'callback'    => 'annuler', // optional, fire event if no confirmed
        ]);
    }

    public function deleteTeacher($id)
    {
        Teacher::find($id)->delete();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute deleted successfully', ['attribute' =>  __('Teacher')]),
        ]);
    }

    public function annuler()
    {
        $this->emit('swal:alert', [
            'icon' => 'info',
            'type'  => 'info',
            'title'  => __('Operation canceled'),
            'timer' => 10000,
            'timerProgressBar' => true
        ]);
    }
}
