<?php
namespace frontend\tests\unit\models;

use common\fixtures\UserFixture;
use frontend\models\ItemX;

class ItemXTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

/*
    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }
	*/

	
	//check that saving to DB works, if types are coherent to validation rules in frontend\models\ItemX;
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
    public function testCorrectSQLInsert()
    {
		
		$model = new ItemX([
            'item_name' => 'some_username',
            'item_description' => 'some_descr',
        ]);

        $user = $model->save();
        expect($user)->true();
	}
      
		
		
		
		
		
	
	
	 //test that DB insert wont work as validation fails (as  'item_name' type is int instead of string)
	 // **************************************************************************************
     // **************************************************************************************
     //                                                                                     **
	 public function testNoCorrectSQLInsert()
    {
		
		$model = new ItemX([
            'item_name' => 1111, //error will be here, as type is int instead of string
            'item_description' => 'some_descr',
        ]);

        $user = $model->save();
        expect($user)->false(); //save if False as validation fails
		
		expect_that($model->getErrors('item_name')); //expect to see Errors in 'item_name' field input, as  'item_name' type is int instead of string
	    
		//check custom validation message set in frontend\models\ItemX;
		expect($model->getFirstError('item_name'))
            ->equals('Input type must be string.');
	}
	
	
	
	
}
