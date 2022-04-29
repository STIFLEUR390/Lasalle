<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Teacher;
use App\Models\AppSetting;
use App\Models\Department;
use App\Models\TeacherGrade;
use App\Models\TeacherStatus;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        $this->call(PermissionsSeeder::class); //Obligatoire
        $this->call(UserSeeder::class); //optionnel

        Room::factory(15)->create();
        Course::factory(10)->create();
        Department::factory(10)
            ->has(Faculty::factory()->count(3))
            ->create();

        for ($i=0; $i <15 ; $i++) {
            $roles = ['Admin', 'Super Admin', 'Invite'];
            $user = User::factory()->create();
            $user->assignRole(array_rand($roles,1));
        }

        for ($i = 0; $i < 10; $i++) {
            $teacherGrade = TeacherGrade::factory()->create();
            $teacherStatus = TeacherStatus::factory()->create();

            Teacher::factory()
                ->count(2)
                ->for($teacherGrade)
                ->for($teacherStatus)
                ->create();
        }


    }
}
