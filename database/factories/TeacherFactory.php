<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $rand = rand(0, 100);
        $phone = '65'.rand(0000000, 9999999);

        if (fmod($rand, 2)) {
            $sexe = 'male';
            $firstName = $this->faker->firstNameMale();
            $img = '/dist/img/avatar.png';
        } else {
            $sexe = 'female';
            $firstName = $this->faker->firstNameFemale();
            $img = '/dist/img/avatar3.png';
        }
        return [
            'first_name' => $firstName,
            'last_name' => $this->faker->lastName,
            // 'grade' => 'Grade',
            'matricule' => "DV".$phone,
            // 'status' => 'active',
            'photo' => $img,
            'email' => $this->faker->email,
            'gender' => $sexe,
            'phone' => $phone
        ];
    }
}
