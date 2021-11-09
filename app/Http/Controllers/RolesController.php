<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
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

    public function index() //http://dav.crm/index
    {
		//return response()->json(Role::get());
		//return Role::get();
        //return Role::all();
		
        //return Role::where('created_at', '!=', null)->get();
        //return Role::whereNotNull('created_at')->get(); //тоже самое
		
        //return Role::whereNull('created_at')->get();
        
		//return Role::whereNotNull('created_at')->where('id', '>', 1)->get();
		
		//return Role::whereNotNull('created_at')->orWhere('id', '>', 1)->get();
		//return Role::whereNotNull('created_at')->orWhere('id', '>', 1)->toSql(); //select * from `roles` where `created_at` is not null or `id` > ?
        
		//dd(Role::whereNotNull('created_at')->orWhere('id', '>', 1)->get());
        //dd(Role::whereNotNull('created_at')->orWhere('id', '>', 1)->first()); //вернет первую запись..вернет экземпляр модели, а не коллекцию
		
        //return Role::find(1); //модель с айди 1
        //return Role::where('id', 1)->first(); //тоже самое
		
        //return Role::orderBy('id')->get();
        //return Role::orderByDesc('id')->get();
        //return Role::get()->orderByDesc('id'); //!!!работать не будет. 
        
		//dd(Role::get()->sortBy('name'));
		//В чем разница методов sortBy() и orderBy()?
		//Метод sortBy() используется для сортировки коллекции, а метод orderBy() используется для сортировки посредством SQL
		
        /*$role = Role::find(3);
        $role->name = 'Manager';
        $role->save();
		return Role::find(3);*/

        /*$role = Role::find(3)->update([
            'name' => 'M',
        ]);
        return Role::find(3);*/

        Role::find(3)->delete();
    }
	
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
}