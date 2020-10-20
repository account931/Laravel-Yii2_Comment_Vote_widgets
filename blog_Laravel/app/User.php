<?php
//It was generated by CLI=> php artisan make:auth
//is used for authentication (login/password)
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model; //???? Added by me

use Zizaco\Entrust\Traits\EntrustUserTrait; //my

class User extends Authenticatable
{
    use EntrustUserTrait; //my
	use Notifiable;
	

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
