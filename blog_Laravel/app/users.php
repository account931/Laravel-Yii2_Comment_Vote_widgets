<?php
//USE USER.php!!!!!!
//While this {user} model is used somewhere in Zizaco\Entrust setting (I am sure about 60%), before Deleting this {user} model, switch that settings to User.php
//My best guess, this model is the same as model User, but this model I generated manually for get users list,
//while model User was generated by CLI=> php artisan make:auth
//So, users.php used for HasMany in WpBlog, User.php for authentication ??? INCORRECT??
namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
	
    //
	protected $table = 'users';
}
