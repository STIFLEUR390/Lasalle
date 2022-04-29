<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\User;
use DB;
use Livewire\WithFileUploads;
use phpDocumentor\Reflection\Types\This;

class CreateUserComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $img;
    public $password;
    public $role;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:6',
            // 'email' => ['required', 'email', Rule::unique('users')->ignore($this->user_id)],
            'email' => ['required', 'email', Rule::unique('users')],
            'img' => 'nullable|image|max:4096',
            'password' => 'required|string|min:6',
            'role' => 'required|in:Invite,Admin,Super Admin'
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->password = 'password';
    }

    public function render()
    {
        return view('livewire.user.create-user-component');
    }

    public function createUser()
    {
        $validatedData = $this->validate();

        $user = User::create($validatedData);
        if ($this->img) {
            /* if ($this->img != '/dist/img/avatar4.png') {
                File::delete($this->img);
            } */
            $filename = date('YmdHis') . $this->img->getClientOriginalName();
            $this->img->storeAs('public/upload/profile/', $filename);
            $path = 'storage/upload/profile/' . $filename;

            DB::table('users')->where('id', $user->id)->update(['img' => $path]);
        }
        $user->assignRole($this->role);

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute created successfully', ['attribute' =>  __('User')]),
        ]);
    }
}
