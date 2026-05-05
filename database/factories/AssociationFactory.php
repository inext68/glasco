<?php

namespace Database\Factories;

use App\Models\Association;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssociationFactory extends Factory
{
    protected $model = Association::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'nation' => $this->faker->country,
            'address' => $this->faker->address,
            'type' => $this->faker->randomElement(['cultural', 'charity', 'educational', 'sports']),
        ];
    }
}
