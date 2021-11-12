<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public function role()
    {
        //return $this->belongsTo(Role::class, 'role_id', 'id');
        return $this->belongsTo(Role::class);
    }
	
	public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
	
	//На входе имеет либо массив либо строку с названием роли или ролей и проверяет данный пользователь соответствет этому критерию
	public function hasAnyRole($roles)
    {
        //return true;
		if (!is_array($roles)) { //если не массив, то делаем с него массив
            $roles = [$roles];
        }

		//dump($roles);
        foreach ($roles as $role) {
            //dump($role);
            //dump($this->role->name);
			if (strtolower($role) === strtolower($this->role->name)) { //если в массиве есть наша роль, то возвращаем true
                return true;
            }
        }

        return false;
    }
}
