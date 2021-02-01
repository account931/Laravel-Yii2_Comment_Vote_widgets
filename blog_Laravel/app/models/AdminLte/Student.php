<?php

namespace App\Models\AdminLte;

//use Illuminate\Database\Eloquent\Factories\HasFactory;  //causes Crash, not found
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'username',
        'phone',
        'dob',
    ];    
}