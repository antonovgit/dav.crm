<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
	/*public function __construct()
    {
        $this->middleware('auth'); //тогда в файле web.php убрать middlewere('auth')
    }*/
	
	public function index()
    {
        return Role::get();
    }
	
//    public function create() //http://dav.crm/create
//    {
//        // //1.
//		// $role = new Role();
//        // $role->name = 'Client';
//        // $role->save();
//
//		////2.
//        // Role::insert(['name' => 'Admin']);
//
//		//3.
//        /*Role::create([
//            'name' => 'manager',
//        ]);*/
//
//        return response()->json(true);
//    }
	
	public function create(Request $request) //http://dav.crm/roles
    {
		//return response()->json($request->input('name')); //input по названию переменной возвращает то что мы туда передали
		//return response()->json([$request->has('name')]); //has показывает, что данное значение вообще имеется в массиве и возвращает тру, иначе фолс. НО если будет передано пустое значение, то вернет тру..т.е. скажет что значение было передано, но оно пустое. Чтобы отлавливать пустые значения есть метод filled
		//return response()->json([$request->filled('name')]); //filled вертнет фолс, если была переданна переменная с пустым значением. Если была переданна эта переменная с непустым значением то вертет тру.
		//!Разница между has и filled. Метод has() проверяет заполнена ли переменная, а filled() проверяет ещё что переменная не пустая
		
		//return response()->json([$request->all()]);	//вернет все поля
		//return response()->json([$request->input()]);	//вернет все поля
		//return response()->json([$request->only('name')]);	//только поле 'name'
		//return response()->json([$request->except('name')]);	//все кроме поля 'name'
		//return response()->json([$request->name]);	//динамическое свойство name
		//return response()->json([$request->input('name-test')]);	//через input можем забирать любые данные
		
		Role::create($request->only('name'));
	}
	
	public function update(Request $request, Role $role)  //http://dav.crm/roles/3
    {
        $role->update($request->only('name'));
        return response()->json($role);
    }

//    public function index() //http://dav.crm/index
//    {
//		//return response()->json(Role::get());
//		//return Role::get();
//        //return Role::all();
//		
//        //return Role::where('created_at', '!=', null)->get();
//        //return Role::whereNotNull('created_at')->get(); //тоже самое
//		
//        //return Role::whereNull('created_at')->get();
//        
//		//return Role::whereNotNull('created_at')->where('id', '>', 1)->get();
//		
//		//return Role::whereNotNull('created_at')->orWhere('id', '>', 1)->get();
//		//return Role::whereNotNull('created_at')->orWhere('id', '>', 1)->toSql(); //select * from `roles` where `created_at` is not null or `id` > ?
//        
//		//dd(Role::whereNotNull('created_at')->orWhere('id', '>', 1)->get());
//        //dd(Role::whereNotNull('created_at')->orWhere('id', '>', 1)->first()); //вернет первую запись..вернет экземпляр модели, а не коллекцию
//		
//        //return Role::find(1); //модель с айди 1
//        //return Role::where('id', 1)->first(); //тоже самое
//		
//        //return Role::orderBy('id')->get();
//        //return Role::orderByDesc('id')->get();
//        //return Role::get()->orderByDesc('id'); //!!!работать не будет. 
//        
//		//dd(Role::get()->sortBy('name'));
//		//В чем разница методов sortBy() и orderBy()?
//		//Метод sortBy() используется для сортировки коллекции, а метод orderBy() используется для сортировки посредством SQL
//		
//        /*$role = Role::find(3);
//        $role->name = 'Manager';
//        $role->save();
//		return Role::find(3);*/
//
//        /*$role = Role::find(3)->update([
//            'name' => 'M',
//        ]);
//        return Role::find(3);*/
//
//        Role::find(3)->delete();
//    }
	
	/*public function show($roleId, $date) //http://dav.crm/roles/1/321
	{
        $role = Role::find($roleId);
		if (empty($role)) {
			return response([], 404);
		}
		return response()->json(['data' => $role]);
    }*/
	public function show(Role $role) //http://dav.crm/roles/1
	{
		return response()->json(['data' => $role]);
    }
	
	public function users(Role $role) //http://dav.crm/roles/1/users
    {
        //return $role;
        //return User::where('role_id', $role->id)->get(); //Уберем этот код в модель Role и ниже наишем уже через связь users()
        //return $role->users()->get(); //Получим тоже самое что и строчкой выше //связь как метод
        //return $role->users; //Получим тоже самое что и строчкой выше //связь как проперти(свойство)
        
		//$users = $role->users;
		//return $role->users; //В итоге будет только один запрос ..будет меньше запросов
		
	/**
	//Связи служат в качестве конструктора запросов, а это значит что мы можем дополнительные еще и условия использовать
	
	//Проверим как работает конструктор запросов, использовать методы конструктора запросов
	//!Виктор: Обращаясь к методам, которые реализуют связи между моделями, вы таким образом получаете возможность использовать методы конструктора запросов для формирования более точных условий получения необходимых данных
	//Когда мы работаем с конструктором запросов то здесь уже нужно обращаться не к динамическому свойству, а именно к методу и дальше мы можем писать какие то другие методы, которые нам известны для конструктора запросов
	//$posts = Rubric::find(1)->posts()->select('title')->where('id', '>', '2')->get();
	*/
		//return $role->users()->orderByDesc('id')->get();
		//return $role->users()->orderByDesc('id')->first();
		//return $role->users()->where('id', '>', '2')->get();
		//return $role->users->where('id', '>', '2')->get(); //!Так будет ошибка, т.к. если через динамическое свойство, то работаем с коллекцией..т.е. это то что вы уже получаете после того как выполнили запрос. Таким образом вам не нужен будет get(), потому что это уже у вас коллекции, т.е. выборка и вы можете использовать все тоже самое, что вы используете в обычных коллекциях
		//Еще раз: Если вы используете связь как динамическое свойство, значит вы уже вытащили ваши модели и вы уже работаете с коллекцией. Если вы используете связь как метод, значит дальше вы уже будете работать с постоителем запросов
		//return $role->users->where('id', '>', '2'); //OK
        
		//return $role->users->first()->role()->first();
		//return $role->users->first()->role; //тоже самое что и строчкой выше
		
		//Метод map можем использовать как свойство. $role->users - здесь мы понимаем, что тут находится коллекция с юзерами. Чтобы обратиться к каждому из пользователей и с ним что то сделать, например вытащить его имя, можем использовать метод map как свойтво
		return $role->users->map->name;
		/*foreach ($role->users as $user) {
			$name[] = $user->name;
		}
		return $name;*/
    }
}