<?php
//NOT fully functionally USED(i.e don't delete it so far)
//Was intended on Update to fire Elastic Cloud one Post indexing (via Observer ElasticSearchObserver and trait Searchable injected in Model), but for some bizzare reason Updating event is not triggered in Obserever. While testin worked only Deleted Event and only if use this construction Elastic_Posts::where('id',999)->first()->delete();. So we use manually triggering mpdel function $model->updateOneElasticCloudIndex($id, $request)

namespace App\Observers\Elastic;

//use ElasticSearch\Client;
use Illuminate\Support\Facades\Log;
use App\models\Elastic_search\Elastic_Posts;

class ElasticSearchObserver 
{
	private $elasticsearch;
	
	
	public function __construct(/* Client $elasticsearch */){
		//\Illuminate\Support\Facades\Log::info("Listerner WriteCredentialsToLog says: Observer fired " . date('Y-m-d H:i:s') );//
		//$this->elasticsearch = $elasticsearch;
	}
	
	
    /**
     * Handle the post "deleted" event. //update index if data is changed
     * @param \App\models\Elastic_search $item
     * @return void
     */
	
	public function deleting (Elastic_Posts $item){
		//do your indexing here
		\Illuminate\Support\Facades\Log::info("Observer for delete fired " . date('Y-m-d H:i:s') );
		dd("Observer works");
	}
	
	
	
	/**
     * Handle the post "updated" event.
     * @param \App\models\Elastic_search $item
     * @return void
     */
    public function updated(Elastic_Posts $item)
    {
        \Illuminate\Support\Facades\Log::info("Observer for update fired " . date('Y-m-d H:i:s') );
		dd("Observer works");
    }
}