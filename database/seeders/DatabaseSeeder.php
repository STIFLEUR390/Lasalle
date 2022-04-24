<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
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
        Room::factory(15)->create();
        Course::factory(10)->create();
        Department::factory(10)
            ->has(Faculty::factory()->count(3))
            ->create();

            for ($i=0; $i < 10; $i++) {
                $teacherGrade = TeacherGrade::factory()->create();
                $teacherStatus = TeacherStatus::factory()->create();
                User::factory(5)->create();

                Teacher::factory()
                    ->count(2)
                    ->for($teacherGrade)
                    ->for($teacherStatus)
                    ->create();
            }


        AppSetting::factory(1)->create(); //Obligatoire
        $this->call(PermissionsSeeder::class); //Obligatoire
        $this->call(UserSeeder::class); //Obligatoire
    }
}
