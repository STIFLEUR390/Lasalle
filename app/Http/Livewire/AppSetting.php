<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use App\Models\AppSetting as ModelsAppSetting;
use Livewire\WithFileUploads;

class AppSetting extends Component
{
    use WithFileUploads;

    public $name;
    public $logo;
    public $image;

    public function mount()
    {
        $app_setting = ModelsAppSetting::firstOrFail();
        $this->name = $app_setting->name;
        $this->logo = $app_setting->logo;
    }

    public function render()
    {
        return view('livewire.app-setting');
    }

    public function UpdateAppInfo()
    {
        $this->validate([
            'name' => 'required|string|min:2',
            'image' => 'nullable|image|max:4096',
        ]);

        $app_setting = ModelsAppSetting::findOrFail(1);
        $app_setting->name = $this->name;
        if ($this->image) {
            if ($this->logo != '/dist/img/AdminLTELogo.png') {
                File::delete($this->logo);
            }
            $filename = date('YmdHis') . $this->image->getClientOriginalName();
            $this->image->storeAs('public/upload/app/', $filename);
            $path = 'storage/upload/app/' . $filename;
            $app_setting->logo = $path;
        }
        $app_setting->save();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'  => 'success',
            'title' => appName(),
            'text'  => __("Appplication information updated successfully"),
        ]);
    }
}
