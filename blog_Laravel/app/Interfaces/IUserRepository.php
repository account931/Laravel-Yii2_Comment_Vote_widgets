<?php
//Interfaces for Service Layout
namespace App\Interfaces;

//use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;

interface IUserRepository {
    
    public function getAllUsers();
 
    public function getUserById($id);
 
    //public function createOrUpdate($id = null);
    
}
