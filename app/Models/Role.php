<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
	
	//protected $fillable = ['name'];
	
	protected $guarded = []; //позволяем записывать любые поля в нашу модель
	
	/*//https://laravel.com/docs/8.x/routing#customizing-the-default-key-name
	//Если вы хотите, чтобы привязка модели всегда использовала столбец базы данных, отличный от id, при извлечении данного класса модели, вы можете переопределить метод getRouteKeyName в модели Eloquent:
	public function getRouteKeyName() //http://dav.crm/roles/Client
    {
        return 'name';
    }*/
	
	//Все пользователи, которые относятся к этой роли
	public function users()
    {
        //return $this->hasMany(User::class, 'role_id', 'id'); //поле role_id модели User связывается с полем id модели Role
        return $this->hasMany(User::class);
    }
}
