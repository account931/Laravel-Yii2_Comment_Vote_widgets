<?php
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Illuminate\Support\Facades\DB;
use Mockery\MockInterface;
use App\models\ShopSimple\ShopSimple;     //model to test



class DataBaset extends TestCase
{
	
	//causes test_checkSQL() failure
	/*
	public $test;

    public function setUp() {
        $this->test = $this->createMock('\App\models\ShopSimple\ShopSimple');
    }

    public function testMock() {
        $this->test->expects($this->any())
            ->method('generateUUID')
            ->will($this->returnValue(null));

        $this->assertEquals(null, $this->test->generateUUID());
    }
	*/
	
	
	
	
	/** 
     * Test DB Select. Working!!!!
     *
     * @return void
     */
    public function test_checkSQL()
    {
		//load post manually
		$db_post  = DB::select('select * from shop_simple where shop_id =1');
		$db_title = ucfirst($db_post[0]->shop_title);
		
		//load post using Eloquent
		$model_post  = ShopSimple::find(1);
		$model_title = ucfirst($model_post->shop_title);
		
		$this->assertEquals($db_title, $model_title);
		
	}
	
	
	
    /** FAILING!!!!!!!!!!!!!!!!
     * A test (create model and test method)
     *
     * @return void
     */
    public function test_modelX()
    {
        // Build your mock object.
        $mockProduct = Mockery::mock('\App\models\ShopSimple\ShopSimple');
		//$mockProduct = $this->createMock('\App\models\ShopSimple\ShopSimple');

        // Have Laravel return the mocked object instead of the actual model.
        //$this->app->instance('\App\models\ShopSimple\ShopSimple', $mockProduct);
		//dd($mockProduct);

        // Tell your mocked instance what methods it should receive.
        $mockProduct
            ->shouldReceive('generateUUID(5)')
            ->once();
            //->andReturn(false);

        // Now you can instantiate your class and call the methods on it to be sure it's returning items and setting class properties correctly
    }
	
	
	
	
	
	
}
