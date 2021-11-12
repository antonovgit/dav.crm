<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    //use WithFaker, DatabaseTransactions;
    use WithFaker;
    
	//Этот трейт запускает транзакцию перед каждым методом и делает ролбек для нее
	use DatabaseTransactions; //Елисеев: этот трейт перед тестом открывает транзакцию..тест проходит и после того как тест выполнился он эту транзакцию откатывает. Соответственно весь мусор, который был записан в БД во время теста откатывается и БД возвращается к первоначальному виду
	
	protected $user;
    protected $password;

    //Мы используем setUp там где мы можем как то объединить начашльные настройки для наших тестов внутри одного класса. Для каждого из тестов этот setUp будет запущен
	protected function setUp(): void
    {
        parent::setUp();

        //$this->password = '123456';
		$this->password = $this->faker->password; //будет генерироваться случайная строка от 6 до 20 символов https://d.radikal.ru/d24/2111/2d/dd5158fe0004.png
		//$this->password = $this->faker->password(10, 12); //будет генерироваться случайная строка от 10 до 12 символов
		//dump($this->password); //"^rzcx]Ws*0R]" //будет каждый раз разный
        //$this->user = User::factory()->create(['password' => bcrypt($this->password)]);
        $this->user = User::factory()->create(['password' => Hash::make($this->password)]);  //https://laravel.com/docs/8.x/hashing
    }
	
	//Этот метод не должен называться test.., потому что иначе он будет запускаться автотестом. Так он получается никак независим от самих тестов
	protected function attemptToLogin($password)
    {
        return $this->post('login', [
            'email' => $this->user->email,
            'password' => $password
        ]);
    }
	
	public function testAuth()
    {
        $response = $this->attemptToLogin($this->password);
		$response->assertStatus(200);
		
		//$response = $this->get('roles');
		$response = $this->get('home');
        $response->assertStatus(200);

        $response = $this->get('logout');
        $response->assertStatus(200);

        //$response = $this->get('roles');
		$response = $this->get('home');
        $response->assertStatus(301);
    }

    public function testAuthFailed()
    {
        $response = $this->attemptToLogin($this->password . '7');
        $response->assertStatus(301);

        //$response = $this->get('roles');
		$response = $this->get('home');
        $response->assertStatus(301);
    }

    public function testRolesAuth()
    {
        $response = $this->attemptToLogin($this->password . '7');
        $response->assertStatus(301);

        //$response = $this->get('roles');
		$response = $this->get('home');
        $response->assertStatus(301);
    }
}