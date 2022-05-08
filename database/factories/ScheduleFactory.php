<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['waiting','in_progress','finish','absent'];
        return [
            'teacher_id' => rand(1, 30),
            'faculty_id' => rand(1, 30),
            'date' => $this->faker->dateTimeBetween('now', '+30 days'),
            'start_time' => $this->faker->time,
            'end_time' => $this->faker->time,
            'room_id' => rand(1, 15),
            'course_id' => rand(1, 15),
            'ue_id' => rand(1, 15),
            'status' => $status[rand(0, 3)],
        ];
    }
}
