<?php

namespace Database\Factories;

use App\Models\Application;
use Carbon\Carbon;
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
        $dateFrom = Carbon::create($this->faker->dateTimeBetween('next Monday', 'next Monday +7 days'));
        $dateTo = Carbon::create($this->faker->dateTimeBetween($dateFrom, $dateFrom->format('Y-m-d H:i:s').' +2 days'));
        $vacationDays = $dateFrom->diffInDaysFiltered(function(Carbon $date) {
            return !$date->isWeekend();
        }, $dateTo);
        $days = $vacationDays + 1;

        return [
            'user_id' => \App\Models\User::factory()->create(),
            'datefrom' => $dateFrom,
            'dateto' => $dateTo,
            'status' => array_rand(Application::STATUS),
            'days' => $days,
            'reason' => $this->faker->sentence,
        ];
    }
}
