<?php

//NOT fully functionally USED(i.e don't delete it so far)
//Was intended to connect Observer to model and  on Update to fire Elastic Cloud one Post indexing (via Observer ElasticSearchObserver and trait Searchable injected in Model), but for some bizzare reason Updating event is not triggered in Obserever. While testin worked only Deleted Event and only if use this construction Elastic_Posts::where('id',999)->first()->delete();. So we use manually triggering mpdel function $model->updateOneElasticCloudIndex($id, $request)

namespace App\Traits\ElasticSearchMy;

use App\Observers\Elastic\ElasticSearchObserver;

trait Searchable
{
			
	//connect observer ElasticSearchObserver
	public static function bootSearchable(){
		static::observe(ElasticSearchObserver::class);
	}
	
	//var 2 connect observer
	/*
	public static function bootObservantTrait()
    {
        static::observe(new ElasticSearchObserver);
	}	*/
	
	//name of index
	public static function getSearchIndex():string {
	    return env('APP_NAME') . $this->getTable();	
	}
	
	
	//name of type
	public static function getSearchtType():string {
	    return '_doc';	
	}
	
	//fileds to use in Elastic
	public static function toSearchArray():array {
	    return ['title' => $this->title ];	
	}
	
}
	
?>
	