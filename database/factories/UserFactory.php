<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state. / Определить состояние модели по умолчанию.
     *
     * @return array
     */
	//Метод definition возвращает набор значений атрибутов по умолчанию, которые должны применяться при создании модели с использованием фабрики.
	//https://laravel.com/docs/8.x/database-testing		//https://laravel.su/docs/8.x/database-testing
	//https://faker.readthedocs.io/en/master/
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
			///'user_id' => (rand(1, 5) == 5) ? 1 : 2, //я // крайне редко будет всплывать первый пользователь и восновном все посты будут принадлежать второму
			//'role_id' => rand(1, 4), //я
			'role_id' => function () { //В Ларавель есть возможность создавать вместе с одной моделью через фабрику, создавать другую модель через фабрику
                //return Role::orderBy(DB::raw('RAND()'))->first()->id; //сортируем по ф-ции RAND. Все что находится внутри raw будет в сыром виде добавляться  в наш запрос. В итоге через ф-цию RAND будет выбирать(сортировать) роли в рандомном порядке и брать одну по айди
				return Role::inRandomOrder()->first()->id;
				//return Role::all()->random(); //Тоже ОК
            },
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
	//Создание неверифицированного пользователя // User::factory(1)->unverified()->create()
    public function unverified()
    {
        //Мы можем назвать несколько состояний нашей модели..нашего пользователя или нашего тикета..допустим это может быть статус или отсутствие какого нибудь поля или наоборот присутствие этого поля
		return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
	//Укажем в понятном виде, что хотим создать админа. И в классе DatabaseSeeder вызывать: User::factory(1)->admin()->create()
	public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => 1,
            ];
        });
    }
	
	public function client()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => 2,
            ];
        });
    }
}
