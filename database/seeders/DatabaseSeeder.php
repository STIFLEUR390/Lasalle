<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\TeacherGrade;
use App\Models\TeacherStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        AppSetting::factory(1)->create(); //Obligatoire
        Teacher::factory(15)->create();
        Room::factory(15)->create();
        TeacherGrade::factory(10)->create();
        TeacherStatus::factory(10)->create();
        $this->call(PermissionsSeeder::class); //Obligatoire
        $this->call(UserSeeder::class); //Obligatoire
        User::factory(5)->create();
    }
}
