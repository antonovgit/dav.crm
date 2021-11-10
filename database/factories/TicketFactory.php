<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
	//https://faker.readthedocs.io/en/master/
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(), //по умолчанию фраза из 4 слов //->sentence('3'), //фраза из трех слов
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement([0, 1, 2, 3]),
            'user_id' => User::factory(), //вместе с тикетом создаст нового юзера
        ];
    }
}
