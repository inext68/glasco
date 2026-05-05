<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birth_date' => $this->faker->optional()->date(),
            'gender' => $this->faker->optional()->randomElement(['male', 'female', 'other']),
            'notes' => $this->faker->optional()->paragraph,
            'updated_by_person_id' => null,
        ];
    }
}
