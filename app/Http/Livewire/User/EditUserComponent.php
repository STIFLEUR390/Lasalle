<?php

namespace App\Http\Livewire\User;

use DB;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\Types\This;

class EditUserComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $img;
    public $role;
    public $user_id;
    public $image;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:6',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user_id)],
            'image' => 'nullable|image|max:4096',
            // 'password' => 'required|string|min:6',
            'role' => 'required|in:Invite,Admin,Super Admin'
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($id)
    {
        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->img = $user->img;
        $this->role = $user->getRoleNames()[0];
        $this->user_id = $user->id;
    }

    public function render()
    {
        return view('livewire.user.edit-user-component');
    }

    public function UpdateUser()
    {
        $validatedData = $this->validate();

        $user = User::find($this->user_id);
        if ($this->role != $user->getRoleNames()[0]) {
            $user->syncRoles($this->role);
        }

        $user->update($validatedData);

        if ($this->image) {
            if ($this->img != '/dist/img/avatar4.png') {
                File::delete($this->img);
            }
            $filename = date('YmdHis') . $this->image->getClientOriginalName();
            $this->image->storeAs('public/upload/profile/', $filename);
            $path = 'storage/upload/profile/' . $filename;

            DB::table('users')->where('id', $user->id)->update(['img' => $path]);
        }

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'    => 'success',
            'title' => appName(),
            'text'   => __(':attribute updated successfully', ['attribute' =>  __('User')]),
        ]);
    }
}
