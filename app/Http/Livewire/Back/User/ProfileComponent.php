<?php

namespace App\Http\Livewire\Back\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\{Auth, File, Hash};
use Laravel\Fortify\Actions\{GenerateNewRecoveryCodes, EnableTwoFactorAuthentication, DisableTwoFactorAuthentication};

class ProfileComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $img;
    public $image;
    public $user_id;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $showQrCode = false;
    public $showRecoveryCodes = false;

    public function mount()
    {
        $user = User::find(auth()->user()->id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->img = $user->img;
    }


    public function render()
    {
        return view('livewire.back.user.profile-component');
    }

    public function UpdateProfile()
    {
        $this->validate([
            'name' => 'required|string|min:6',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user_id)],
            'image' => 'nullable|image|max:4096',
        ]);

        $user = User::find($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        if ($this->image) {
            if ($this->img != '/dist/img/avatar4.png') {
                File::delete($this->img);
            }
            $filename = date('YmdHis') . $this->image->getClientOriginalName();
            $this->image->storeAs('public/upload/profile/', $filename);
            $path = 'storage/upload/profile/' . $filename;
            $user->img = $path;
        }
        $user->save();

        $this->emit('swal:alert', [
            'icon' => 'success',
            'type'  => 'success',
            'title'  => __("Profile updated successfully."),
            'timeout' => 10000
        ]);
    }

    public function UpdatePassword()
    {
        $this->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ]);

        $user = User::find($this->user_id);

        if (Hash::check($this->current_password, $user->password)) {
            $user->forceFill([
                'password' => Hash::make($this->password),
            ])->save();

            $this->emit('swal:alert', [
                'icon' => 'success',
                'type'  => 'success',
                'title'  => __('Password change successfully.'),
                'timeout' => 10000
            ]);
        } else {
            $this->addError('current_password', __('The password entered does not match the current password.'));
        }
    }

    public function showRecoveryCodes()
    {
        $this->showRecoveryCodes = true;
    }


    public function getUserProperty()
    {
        return Auth::user();
    }


    public function enableTwoFactorAuth(EnableTwoFactorAuthentication $enable)
    {
        $enable(Auth::user());

        $this->showQrCode = true;
        $this->showRecoveryCodes = true;
    }


    public function disableTwoFactorAuth(DisableTwoFactorAuthentication $disable)
    {
        $disable(Auth::user());
    }


    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generate)
    {
        $generate(Auth::user());

        $this->showRecoveryCodes = true;
    }
}
