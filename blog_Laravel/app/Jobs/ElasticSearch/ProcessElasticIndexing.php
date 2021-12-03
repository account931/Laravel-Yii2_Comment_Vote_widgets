<?php
//My Async Queue Job. Triggered in function runQueryJob() (ElasticController) by =>\App\Jobs\ElasticSearch\ProcessElasticIndexing::dispatch($text);
namespace App\Jobs\ElasticSearch;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessElasticIndexing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job. Put your code to run in handler.
     *
     * @return void
     */
    public function handle()
    {
        //
		\Illuminate\Support\Facades\Log::info("Queue Job ProcessElasticIndexing  fired " . date('Y-m-d H:i:s') ); //Just Logging the info
		
		//run the method doElasIndexing() in Queque Job
		$res = app('App\Http\Controllers\Elastic\ElasticController')->doElasIndexing(); //call Controller method from other code  place
		//return "Job fired";
    }
}
