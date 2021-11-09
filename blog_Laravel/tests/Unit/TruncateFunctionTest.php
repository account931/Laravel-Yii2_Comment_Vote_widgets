<?php
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\models\ShopSimple\ShopSimple;     //model to test

class TruncateFunctionTest extends TestCase
{
	
	
    /**WORKING!!!!!
     * A basic test example to test creating instance of class
     *
     * @return void
     */
    public function testModelAttribute()
    {
        $box = new ShopSimple();
        //$this->assertTrue($box->has('table'));
        //$this->assertFalse($box->has('ball'));
		$this->assertClassHasAttribute('table', ShopSimple::class); // test if ShopSimple::class has attribute 'table'
		//$this->assertTrue(true);
    }
	
	
	
	
	 /**WORKING!!!!!
     * A test for function truncateTextProcessor($text, $maxLength), that crops a string by length and adds '...'
     * make sure it crops a string as designed
     * @return boolean
     */
    public function testTruncateTextProcessor()
    {
        $m = new ShopSimple();
		
		$source = "Shop title"; //initial string 
		$cropLength = 3;
		
		//checking that function crops text as expected
		$one = "Sho...";  //manually cropped string $source 
		$two = $m->truncateTextProcessor($source, $cropLength); //string $source cropped by function
		$this->assertEquals($one, $two); //Assertion, must be equal to return True (i.e 'Sho...' ==='Sho...' )
		
		//checking that cropped string length equals $cropLength + 3 , i.e + '...' 
		$x = str_split($two); // $two to array, i.e 'Sho...' to array('s', 'h', 'o', '.', '.', '.');
		//var_dump(count($x));
		$this->assertCount($cropLength +3, $x);  //not count($x), Php Counts by itself
		
    }
	
	
     /**WORKING!!!!!
     * A test for generateUUID($length=10) 
     * make sure it generates UUID as designed
     * @return boolean
     */
    public function testGenerateUUID()
    {
		$m = new ShopSimple();
		$uuid_1  = $m->generateUUID(12);
		//$check_1 = str_split($uuid_1); //(int)strlen($uuid_1);
		
		//manually created UUID
		$uuid_2  = "sh-" . time() . "-123456789012";
		$check_2 = str_split($uuid_2); //string to array
		
		$this->assertCount(strlen($uuid_1), $check_2); //WTF, 1st arg can be as string length (strlen($uuid_1), but 2nd cannot, only as plain array and PHPUnit count it itself)  //not count($check_2), Php Counts by itself
	}
	
	
	
}
