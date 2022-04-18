<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RoomComponent extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $teachers = Teacher::all();
        return view('livewire.room-component', compact('teachers'));
    }
}
