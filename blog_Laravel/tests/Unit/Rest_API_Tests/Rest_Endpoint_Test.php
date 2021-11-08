<?php
 //Test Rest Api endpoint /GET   
namespace Tests\Unit\Rest_API_Tests;
    
use Illuminate\Http\Response;
use Tests\TestCase;
    
	
class Rest_Endpoint_Test extends TestCase {
    
    public function testRestReturnsDataInValidFormatTest() {
    
	    //$this->assertTrue(true);

        
        $this->json('get', 'api/articles')
         ->assertStatus(Response::HTTP_OK) //refactor Rest Controller, as ir currently returns anly articles but NOT Response::HTTP_OK
         ->assertJsonStructure(
             [
                 'data' => [
                     '*' => [
                         'wpBlog_id',
                         'wpBlog_title',
                         'wpBlog_author',
                         'wpBlog_created_at',
                         'wpBlog_category',
						 'wb_h',
						 
                         //'wallet' => [ 'id', 'balance' ] 
                    ]
                ]
            ]
        );
		
		
    }
	
    
}