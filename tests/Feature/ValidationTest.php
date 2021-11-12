<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use WithFaker;
	
	public function testValidationWrongEmail()
    {
        //$response = $this->post('login', ['email' => 'testemail', 'password' => 'testemail']);
		$response = $this->post('login', [
            'email' => $this->faker->word, //будет генерироваться случайная строка по умолчанию из трех символов 
            'password' => $this->faker->password //будет генерироваться случайная строка от 6 до 20 символов
        ]);
        $response->assertStatus(422); //если авторизовываемся с корректным имейлом //422 Unprocessable Entity («необрабатываемый экземпляр»)
        $content = $response->getContent();
		//dd($content); //"{"message":"The given data was invalid.","errors":{"email":["The email must be a valid email address."]}}"
		//$errorMessage = json_decode($content, true);
        //$this->assertContains('email', $errorMessage);
        $this->assertStringContainsString('email', $content);
    }

    public function testValidationNoPassword()
    {
        //$response = $this->post('login', ['email' => 'testemail@example.com']);
		$response = $this->post('login', [
            'email' => $this->faker->unique()->safeEmail
        ]);
        $response->assertStatus(422);
        $content = $response->getContent();
		//$errorMessage = json_decode($content, true);
        //$this->assertContains('email', $errorMessage);
        $this->assertStringContainsString('password', $content);
    }
}
