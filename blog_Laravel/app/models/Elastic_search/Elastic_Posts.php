<?php
//Model for tabel {elastic_search}
namespace App\models\Elastic_search;

use Illuminate\Database\Eloquent\Model;
//use App\models\Polymorphic\Polymorphic_Images;   //model for DB table {polymorphic_images} //Mega Fix
use App\Traits\ElasticSearchMy\Searchable;
 
class Elastic_Posts extends Model
{
    use Searchable; //use my trait
	
    /**
    * Connected DB table name.
    *
    * @var string
    */
    protected $table = 'elastic_search';

    //allow mass assignment
    protected $fillable = [ 'elast_title', 'elast_text', 'elast_created_at'];  //????? protected $fillable = ['wpBlog_author', 'wpBlog_text', 'wpBlog_author', 'wpBlog_category',  'updated_at', 'created_at'];
    public $timestamps = false; //to override Error "Unknown Column 'updated_at'" that fires when saving new entry

    //https://www.larashout.com/how-to-use-laravel-model-observers
    
	//Init the Observer. DON"T NEED THIS FOR OBSERVER. All necessary is set in trait and observer
	/*
    protected static function boot()
    {
        parent::boot();
        parent::observe(ElasticSearchObserver::class);
    } */
	
	
	
	
	//Yii2 analoque of to trigger something on update
	/*
	protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            \Illuminate\Support\Facades\Log::info("Model Boot fired " . date('Y-m-d H:i:s') );
			dd("Stopped in Modelll");
        });
    }
	*/
	
	
	/**
     * Update the one document index on Elastic Cloud (on one Post update) by sending POST cURL 
     * @param $id
	 * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateOneElasticCloudIndex($id, $request)
    {
		//construct the url to use in cURL
        $url = "https://myelasticz.ent.us-central1.gcp.cloud.es.io/api/as/v1/engines/my-elastic-enginez/documents"; //URL //my-elastic-enginez is my engine
        $authorization = "Authorization: Bearer " . env('ElasticPrivate_Api_Key'); //Inject the token (Private Api Key) into the header
  
        $curl = curl_init();

        //construct the data (array of arrays) to be used in cURL POST (to be indexed)
	    $dataX = array(); //final array of arrays to contain all data, e.g [ ["id" => 1, "elast_title" => "text1"], ["id" => 2, "elast_title" => "text2"] ] 
			
		//mandatory specify the id key (same as SQL table row id), otherwise the ElasticCloud will generate it by itself (e.g "doc-4545") and we won't be able to update and when making the whole table indexing if prev index exists, it will not update it but create dublicates
	    $temp = [ "id" => $id, "elast_title" => $request->input('product-name'), "elast_text" => $request->input('product-desr') ] ;
        array_push($dataX, $temp );
			
			
		$dataX = json_encode($dataX); //converts array [ ["id" => 1, "elast_title" => "text1"], ["id" => 2, "elast_title" => "text2"] ] to json '{"id": 1, "elast_title": "text1"}, {"id": 2, "elast_title": "text2"} '
		//dd($dataX);

        curl_setopt_array($curl, array(
                CURLOPT_URL            => $url,
	            CURLOPT_HTTPHEADER     => array('Content-Type: application/json' , $authorization ), //Inject the token into the header
                CURLOPT_RETURNTRANSFER => true,
				//CURLOPT_USERPWD => 'user:pass', //authorization variant 2
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => "POST",
                CURLOPT_POSTFIELDS      => $dataX,//"{\n  \"customer\" : \"con\",\n  \"customerID\" : \"5108\",\n  \"customerEmail\" : \"jordi@correo.es\",\n  \"Phone\" : \"34600000000\",\n  \"Active\" : false,\n  \"AudioWelcome\" : \"https://audio.com/welcome-defecto-es.mp3\"\n\n}",
                /*CURLOPT_HTTPHEADER => array(
                  "cache-control: no-cache",
                  "content-type: application/json",
                  "x-api-key: whateveriyouneedinyourheader"
                ),*/
        ));
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //must option to Kill SSL, otherwise sets an error


        $response = curl_exec($curl);
        $err = curl_error($curl); //return string with last error or if no errof empty string

        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
		    //$elasticResults = "cURL Error #:" . $err;
			throw new \App\Exceptions\myException("cURL Exception happened while Elastic Cloud Search " . $err);

        } else {
            //echo "<p> FEATURE STATUS=></p><p>Below is response from API-></p>";
            //echo "Index was for all table was created successfully. Elastic Cloud response is => " . $response;
		    //$elasticResults = $response;
			return $response;
        }
		
	}
}
