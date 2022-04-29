<?php

namespace Database\Seeders;

use App\Models\{AppSetting, Course, Department, Faculty, Room, Teacher, TeacherGrade, TeacherStatus, User};
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\PermissionRegistrar;

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
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Role::create(['name' => 'Super Admin']); //Obligatoire
        Role::create(['name' => 'Admin']); //Obligatoire
        Role::create(['name' => 'Invite']); //Obligatoire

        $user = User::create([ //optionnel
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole(['Super Admin']);

        Room::factory(15)->create();
        Course::factory(10)->create();
        Department::factory(10)
            ->has(Faculty::factory()->count(3))
            ->create();

        for ($i=0; $i <15 ; $i++) {
            $roles = ['Admin', 'Super Admin', 'Invite'];
            $user = User::factory()->create();
            $ra = rand(0, 2);
            $user->assignRole($roles[$ra]);
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
