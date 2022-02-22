<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $datefrom = $this->faker->dateTimeThisMonth('2022-02-01');
        $dateto = $this->faker->dateTimeThisMonth();

        return [
            'user_id' => \App\Models\User::factory()->create(),
            'datefrom' => $datefrom,
            'dateto' => $dateto,
            'status' => array_rand(Application::STATUS),
            'days' => 5,
            'reason' => $this->faker->sentence,
        ];
    }
}
