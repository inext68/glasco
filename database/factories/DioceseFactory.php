<?php

namespace Database\Factories;

use App\Models\Diocese;
use Illuminate\Database\Eloquent\Factories\Factory;

class DioceseFactory extends Factory
{
    protected $model = Diocese::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city . ' Diocese',
            'country' => $this->faker->country,
            'region' => $this->faker->state,
            'city' => $this->faker->city,
        ];
    }
}
