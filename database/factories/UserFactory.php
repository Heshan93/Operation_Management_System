<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'nic' => $this->faker->unique()->regexify('[0-9]{9}[vV]'),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'job_roll' => $this->faker->jobTitle(),
            'address' => $this->faker->unique()->address,
            'district' => $this->faker->city,
            'division' => $this->faker->city,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
           /*  'is_admin' =>$this->faker -> boolean,
            'is_view_user' =>$this->faker -> boolean,
            'is_edit_user' =>$this->faker -> boolean,
            'is_edit_user_access' =>$this->faker -> boolean,
            'is_view_citizen' =>$this->faker -> boolean,
            'is_edit_citizen' =>$this->faker -> boolean,
            'is_manage_appointment' =>$this->faker -> boolean, */
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    /*
     public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }*/
}
