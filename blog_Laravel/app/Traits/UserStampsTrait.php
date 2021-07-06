<?php
//NOT USED and Does Not work. The only working way to emulate Yii2 beforeDelete() event is to hook the Delete event in model App/User
//An abortive attemp to detect a delete event via Trait. Tried to be used in App/User model

namespace App\Traits;
use Illuminate\Support\Facades\Auth; 
use Log; //use logging
   
trait UserStampsTrait
{
 public static function boot()
  {
    parent::boot();
    // first we tell the model what to do on a creating event
    
    /*
    static::creating(function($modelName='')
    {
       $createdByColumnName = 'create_user_id ';
       $modelName->$createdByColumnName = Auth::id();
    });

    // // then we tell the model what to do on an updating event
    static::updating(function($modelName='')
    {
      $updatedByColumnName = 'update_user_id';
      $modelName->$updatedByColumnName = Auth::id();
    });  
    */  

    static::deleting(function($user)
    {
        dd('Delete Fired (in trait UserStampsTrait)');
        Log::info("UserStampsTrait says: Deleted at " . date('Y-m-d H:i:s') );
    }); 

    
  }
}