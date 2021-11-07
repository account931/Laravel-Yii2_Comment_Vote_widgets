<?php
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Mockery\MockInterface;
use App\models\ShopSimple\ShopSimple;     //model to test



class DataBaset extends TestCase
{
	
    /**
     * A test 
     *
     * @return void
     */
    public function test_modell()
    {
        // Build your mock object.
        $mockProduct = Mockery::mock(new ShopSimple);

        // Have Laravel return the mocked object instead of the actual model.
        $this->app->instance('ShopSimple', $mockProduct);

        // Tell your mocked instance what methods it should receive.
        $mockProduct
            ->shouldReceive('generateUUID')
            ->once()
            ->andReturn(false);

        // Now you can instantiate your class and call the methods on it to be sure it's returning items and setting class properties correctly
    }
	
	
	
	
	
	
}
