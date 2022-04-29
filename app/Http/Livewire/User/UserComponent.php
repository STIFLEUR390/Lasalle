<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['delete' => 'deleteUser'];

    public $oderBy;
    public $search_role;
    public $search;
    public $pageSize;

    public function mount()
    {
        $this->roles = Role::all()->pluck('name');
        $this->oderBy = 'desc';
        $this->pageSize = 7;
    }

    public function render()
    {
        if (!empty($this->search) && $this->search_role) {
            $search = '%'.$this->search.'%';
            $users = User::role($this->search_role, 'web')->where('name', 'like', $search)->orWhere('email', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }else if (!empty($this->search)) {
            $search = '%'.$this->search.'%';
            $users = User::where('name', 'like', $search)->orWhere('email', 'like', $search)->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }else if ($this->search_role) {
            $search = '%'.$this->search.'%';
            $users = User::role($this->search_role, 'web')->orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        } else {
            $users = User::orderBy('created_at', $this->oderBy)->paginate($this->pageSize);
        }

        $roles = Role::all()->pluck('name');
        return view('livewire.user.user-component', compact('users', 'roles'));
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

    public function deleteUser($id)
    {
        User::find($id)->delete();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute deleted successfully', ['attribute' =>  __('User')]),
        ]);
    }
}
