<?php
//Проверяем для каких пользователей что мы получаем. Для Администатора будет выдавать 200, а для всех остальных он будет выдавать 403 ошибку

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CheckRolesTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    //Для Администатора будет выдавать 200, а для всех остальных он будет выдавать 403 ошибку
	public function dataProviderRoles()
    {
        return [
            ['Admin', 200],
            ['Client', 403],
            ['Manager', 403],
            ['Main-Manager', 403],
        ];
    }

    /**
     * @dataProvider dataProviderRoles
     * @param $roleName
     * @param $expectedCodeResult
     */
    public function testCheckRouteRoles($roleName, $expectedCodeResult)
    {
        $role = Role::where('name', $roleName)->first();
        $password = $this->faker->password;
        $user = User::factory()->create([
            'role_id' => $role->id,
            //'password' => bcrypt($password),
            'password' => Hash::make($password), //https://laravel.com/docs/8.x/hashing
        ]);

        //Пытаюсь залогиниться
		$this->post('login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response = $this->get('roles'); //делаю запрос на маршрут с ролями..и ожидаю некоторый статус
        $response->assertStatus($expectedCodeResult); //..и ожидаю некоторый статус
    }
}