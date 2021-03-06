<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;
// use Illuminate\Support\Facades\Validator;

class ManageRoomComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'deleteRoom'];

    public $name;
    public $is_available;
    public $room_id;
    public $search;
    public $oderBy;
    public $pageSize;

    protected $rules = [
        'name' => 'required|min:2|string',
        'is_available' => 'required',
    ];

    public function mount()
    {
        $this->oderBy = 'desc';
        $this->pageSize = 7;
        $this->initializeRoom();
    }

    public function render()
    {
        if (!empty($this->search)) {
            $search = '%'.$this->search.'%';
            $rooms = Room::where('name', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        } else {
            $rooms = Room::orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }
        return view('livewire.manage-room-component', compact('rooms'));
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

    public function deleteRoom($id)
    {
        Room::find($id)->delete();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute deleted successfully', ['attribute' =>  __('Room')]),
        ]);
    }

    public function initializeRoom()
    {
        $this->name = null;
        $this->is_available = false;
        $this->room_id = null;
    }

    public function initializeForCreateRoom()
    {
        $this->name = null;
        $this->is_available = false;
        $this->room_id = null;
        $this->resetValidation();
        $this->resetErrorBag();

        $this->emit("modalShow", ['id'=> 'modal-default']);
    }

    public function createRoom()
    {
        $this->emit("modalClose", ['id'=> "modal-default"]);
        $validatedData = $this->validate();
        Room::create($validatedData);

        $this->initializeRoom();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute created successfully', ['attribute' =>  __('Room')]),
        ]);
    }

    public function getData($id)
    {
        $this->resetValidation();
        $this->resetErrorBag();

        $room = Room::find($id);
        $this->name = $room->name;
        $this->is_available = $room->is_available ? true : false;
        $this->room_id = $room->id;
        $this->emit("modalShow", ['id'=> 'modal-update']);
    }

    public function updateRoom()
    {
        $this->emit("modalClose", ['id'=> 'modal-update']);
        $validatedData = $this->validate();
        $room = Room::find($this->room_id);
        $room->update($validatedData);

        $this->initializeRoom();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute updated successfully', ['attribute' =>  __('Room')]),
        ]);
    }
}
