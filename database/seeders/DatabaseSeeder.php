<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
	//https://laravel.com/docs/8.x/database-testing		//https://laravel.su/docs/8.x/database-testing
    public function run()
    {
		$this->call([
            RolesSeeder::class,
        ]);
        //\App\Models\User::factory(10)->create();
        //User::factory(5)->create(); //Метод create() создает запись и объект, а метод make() создает только объект
        
		//$user = User::factory()->make(); //Елисеев: make() создает новый объект и создает несохраненный инстанс вот этой модели //create() помимо создания пользователя еще и вызывает метод save(), чтобы сохранить его в БД //make() выполнит аналогичный метод, который имеется в самой нашей сущности..и не сохранит нашу сущность в БД, а просто создаст нового пользователя в памяти через new, по полям, которые здесь перечислены, не записывая в базу
		//dd($user);
		
		//User::factory(1)->create(['role_id' => 1,]); //создадим одного админа, жестко прописав тут поль 1
		//User::factory(1)->admin()->create(); //создадим одного админа, используя метод admin() фабрики UserFactory
		//User::factory(1)->unverified()->create(); //Создание неверифицированного пользователя
		
		//Ticket::factory()->create(); //вместе с тикетом создаст нового юзера
		
		
		/*User::factory(1)->admin()->create(); //создадим одного админа, используя метод admin() фабрики UserFactory
		
		//!Создас 5 юзеров с ролью Client, к каждом юзеру создаем по три тикета
		//Предположим, что модель User определяет отношения hasMany с Ticket. Мы можем создать 5 пользователей, каждый из них с тремя тикетами, используя метод has, предоставляемый фабриками Laravel. Метод has принимает экземпляр фабрики.
		//По соглашению, при передаче модели Ticket методу has, Laravel будет предполагать, что модель User должна иметь метод tickets, который определяет отношения. При необходимости вы можете явно указать имя отношения, которым вы хотите управлять
		User::factory(5)
            ->client()
            ->has(Ticket::factory()->count(3))
            //->has(Ticket::factory()->count(3), 'tickets')  //явно указываем связь tickets
            ->create();*/
    }
}