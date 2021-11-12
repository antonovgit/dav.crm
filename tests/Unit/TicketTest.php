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
	
	
	//Если вы хотите чтобы метод не запускался, то можем дать название some_action. Т.е. Юнит тест будет запускать только то, что имеет название либо test_  , либо имеет анотацию
	public function some_action()
    {
        dd('Метод с названием some_action не сработает!!!');
    }

	public function getTestData()
    {
        return [
            [0, true],  //первый раз передаем 0 и ожидаем что будет true
            [1, false], //второй раз передаем 1 и ожидаем что будет false
        ];
    }
	
	/**
     * @dataProvider getTestData
     */
	public function testIsNew($status, $expectedResult)
    {
		//dump($status, $expectedResult);
		$ticket = Ticket::factory()->create([
            'status' => $status,
        ]);

		$this->assertEquals($expectedResult, $ticket->isNew());
    }
}
