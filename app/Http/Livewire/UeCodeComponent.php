<?php

namespace App\Http\Livewire;

use App\Models\UeCode;
use Livewire\Component;
use Livewire\WithPagination;

class UeCodeComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'deleteUeCode'];

    public $name;
    public $UeCode_id;
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
        $this->initializeUeCode();
    }

    public function render()
    {
        if (!empty($this->search)) {
            $search = '%'.$this->search.'%';
            $UeCodes = UeCode::where('name', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        } else {
            $UeCodes = UeCode::orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }
        return view('livewire.ue-code-component', compact('UeCodes'));
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

    public function deleteUeCode($id)
    {
        UeCode::find($id)->delete();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __('Teaching unit deleted with success'),
        ]);
    }

    public function initializeUeCode()
    {
        $this->name = null;
        $this->UeCode_id = null;
    }

    public function initializeForCreateUeCode()
    {
        $this->name = null;
        $this->UeCode_id = null;
        $this->resetValidation();
        $this->resetErrorBag();

        $this->emit("modalShow", ['id'=> 'modal-default']);
    }

    public function createUeCode()
    {
        $this->emit("modalClose", ['id'=> "modal-default"]);
        $validatedData = $this->validate();
        UeCode::create($validatedData);

        $this->initializeUeCode();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __('Teaching unit created with success'),
        ]);

    }

    public function getData($id)
    {
        $this->resetValidation();
        $this->resetErrorBag();

        $UeCode = UeCode::find($id);
        $this->name = $UeCode->name;
        $this->UeCode_id = $UeCode->id;
        $this->emit("modalShow", ['id'=> 'modal-update']);
    }

    public function updateUeCode()
    {
        $this->emit("modalClose", ['id'=> 'modal-update']);
        $validatedData = $this->validate();
        $UeCode = UeCode::find($this->UeCode_id);
        $UeCode->update($validatedData);

        $this->initializeUeCode();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __('Teaching unit updated with success'),
        ]);
    }
}
