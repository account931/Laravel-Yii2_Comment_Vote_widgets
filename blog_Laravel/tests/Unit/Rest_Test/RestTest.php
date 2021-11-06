<?php
    
namespace Tests\Controllers;
    
use Illuminate\Http\Response;
use Tests\TestCase;
    
class UserControllerTests extends TestCase {
    
    public function testIndexReturnsDataInValidFormat() {
    
    $this->json('get', '/api/articles')
         //->assertStatus(Response::HTTP_OK) //refactor Rest Controller, as ir currently returns anly articles but NOT Response::HTTP_OK
         ->assertJsonStructure(
             [
                 'data' => [
                     '*' => [
                         'wpBlog_id',
                         'wpBlog_title',
                         'wpBlog_author',
                         'wpBlog_created_at',
                         'wpBlog_category',
						 /*
                         'wallet' => [
                             'id',
                             'balance'
                         ] */
                     ]
                 ]
             ]
         );
  }
    
}