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
    public $matricule;
    public $teacher_grade;
    public $teacher_status;
    public $schedule_status;

    public function mount()
    {
        $app_setting = ModelsAppSetting::firstOrFail();
        $this->name = $app_setting->name;
        $this->logo = $app_setting->logo;
        $this->matricule = $app_setting->matricule;
        $this->teacher_grade = $app_setting->teacher_grade;
        $this->teacher_status = $app_setting->teacher_status;
        $this->schedule_status = $app_setting->schedule_status;
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

        $app_setting = ModelsAppSetting::firstOrFail();
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

    public function UpdateSetting()
    {
        $matricule = $this->matricule ? 1 : 0;
        $teacher_grade = $this->teacher_grade ? 1 : 0;
        $teacher_status = $this->teacher_status ? 1 : 0;
        $schedule_status = $this->schedule_status ? 1 : 0;

        $app_setting = ModelsAppSetting::firstOrFail();
        $app_setting->matricule = $matricule;
        $app_setting->teacher_grade = $teacher_grade;
        $app_setting->teacher_status = $teacher_status;
        $app_setting->schedule_status = $schedule_status;
        $app_setting->save();

        $this->emit('swal:modal', [
            'icon' => 'success',
            'type'  => 'success',
            'title' => appName(),
            'text'  => __("Appplication updated successfully"),
        ]);
    }
}
