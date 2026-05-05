<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'person_id' => Person::factory(),
            'type' => $this->faker->randomElement(['phone', 'email', 'pec', 'whatsapp', 'telegram', 'address', 'social']),
            'label' => $this->faker->randomElement(['personale', 'ufficio', 'istituzionale', 'emergenza']),
            'value' => $this->faker->optional()->email ?? $this->faker->phoneNumber,
            'is_primary' => $this->faker->boolean(30),
        ];
    }
}
