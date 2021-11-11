<?php

namespace Tests\Unit;

use App\Models\Ticket;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;  //!Используем этот класс!

class TicketTest extends TestCase
{
    //use RefreshDatabase; //!Елисеев: использовать его нужно с осторожностью // перед выполнением тестов откатит миграции и применит их снова..выполнит команду мигрейшен рефреш ..чтобы очистились у вас таблицы от предыдущих данных, которые у вас имеются
	
	//Этот трейт запускает транзакцию перед каждым методом и делает ролбек для нее
	use DatabaseTransactions; //Елисеев: этот трейт перед тестом открывает транзакцию..тест проходит и после того как тест выполнился он эту транзакцию откатывает. Соответственно весь мусор, который был записан в БД во время теста откатывается и БД возвращается к первоначальному виду
	
	/**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true); //проверяет, что то что мы здесь передаем оно соответствует true
    }
	
	/*//! something → This test did not perform any assertions  D:\OpS\OpenServer\domains\rdavydov2\Laravel\dav.crm\tests\Unit\TicketTest.php:20
	public function test_something()
    {
        
    }*/
	
	//Если вы хотите чтобы метод не запускался, то можем дать название some_action. Т.е. Юнит тест будет запускать только то, что имеет название либо test_  , либо имеет анотацию
	public function some_action()
    {
        dd('Метод с названием some_action не сработает!!!');
    }
	
	/**
	 * @test
	 *
	 */
	/*public function some_action2()
    {
        dd('Метод с названием some_action2, но с анотацией срабатывает');
    }*/
	
	public function test_is_new()
    {
        //$this->seed();	//указываем, что нужно запустить сиды
		$ticket = Ticket::factory()->create([
            'status' => 0, //новый
        ]);

        $this->assertTrue($ticket->isNew());
    }

	public function test_is_not_new()
    {
        //$this->seed();	//указываем, что нужно запустить сиды
		$ticket = Ticket::factory()->create([
            'status' => 1,
        ]);

        $this->assertFalse($ticket->isNew());
    }
}
