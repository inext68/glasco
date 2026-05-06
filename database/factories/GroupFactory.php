<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Diocese;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence,
            'diocese_id' => Diocese::factory(),
            'meeting_place' => $this->faker->address,
            'meeting_day' => $this->faker->randomElement(['lunedì', 'martedì', 'mercoledì', 'giovedì', 'venerdì', 'sabato', 'domenica']),
            'meeting_time' => $this->faker->time,
        ];
    }
}
