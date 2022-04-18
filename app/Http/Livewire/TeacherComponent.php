<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TeacherComponent extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['confirm' => 'confirm', 'annuler' => 'annuler'];

    public function render()
    {
        $teachers = Teacher::all();
        return view('livewire.teacher-component', compact('teachers'));
    }

    public function createTeacher($id=null)
    {
        /* $this->emit('swal:modal', [
            'icon' => 'success',
            'type'  => 'success',
            'title' => 'Success!!',
            'text'  => "This is a success message",
        ]); */

        /* $this->emit('swal:alert', [
            'icon' => 'success',
            'type'    => 'success',
            'title'   => 'This is a success alert!!',
            'timeout' => 10000
        ]); */

        /* $this->emit("swal:confirm", [
            'type'        => 'warning',
            'title'       => 'Are you sure?',
            'text'        => "You won't be able to revert this!",
            'confirmText' => 'Yes, delete!',
            'method'      => 'confirm',
            'params'      => $id, // optional, send params to success confirmation
            'callback'    => 'annuler', // optional, fire event if no confirmed
        ]); */
    }

    public function confirm($id)
    {
        dd('ok', $id);
    }

    public function annuler()
    {
        dd('annuler');
    }
}
