<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function create() //http://dav.crm/create
    {
        // //1.
		// $role = new Role();
        // $role->name = 'Client';
        // $role->save();

		////2.
        // Role::insert(['name' => 'Admin']);

		//3.
        /*Role::create([
            'name' => 'manager',
        ]);*/

        return response()->json(true);
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
}