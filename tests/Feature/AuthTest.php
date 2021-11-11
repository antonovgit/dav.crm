<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    public function testAuth()
    {
        //$password = 123456;
        $password = '123456';
        //$user = User::factory()->create(['password' => bcrypt($password)]);
        $user = User::factory()->create(['password' => Hash::make($password)]); //https://laravel.com/docs/8.x/hashing

        $response = $this->post('login', ['email' => $user->email, 'password' => $password]);
		//dd($response->getContent()); //"{"message":"The given data was invalid.","errors":{"password":["The password must be a string."]}}"  //"1"
        $response->assertStatus(200);

        $response = $this->get('roles');
        $response->assertStatus(200);

        $response = $this->get('logout');
        $response->assertStatus(200);

        $response = $this->get('roles');
        $response->assertStatus(301);
    }

    public function testAuthFailed()
    {
        $password = '123456';
        //$user = User::factory()->create(['password' => bcrypt($password)]);
        $user = User::factory()->create(['password' => Hash::make($password)]);

        $response = $this->post('login', ['email' => $user->email, 'password' => $password . '7']);
        $response->assertStatus(301);

        $response = $this->get('roles');
        $response->assertStatus(301);
    }

    public function testRolesAuth()
    {
        $password = '123456';
        //$user = User::factory()->create(['password' => bcrypt($password)]);
        $user = User::factory()->create(['password' => Hash::make($password)]);

        $response = $this->post('login', ['email' => $user->email, 'password' => $password . '7']);
        $response->assertStatus(301);

        $response = $this->post('roles');
        $response->assertStatus(301);
    }
}