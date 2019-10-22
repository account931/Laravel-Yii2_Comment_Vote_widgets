<?php
//model/Db to store all items (some list of items(products, songs, etc) to be used for commenting and voting)
namespace frontend\models;


use Yii;

/**
 * This is the model class for table "itemX".
 *
 * @property int $item_id
 * @property string $item_name
 * @property string $item_description
 * @property string $item_image
 */
class ItemX extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemX';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'item_description'], 'required'],  //'item_image'
            [['item_name', 'item_description', 'item_image'], 'string', 'max' => 77, 'message' => 'Input type must be string.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'item_name' => 'Item Name',
            'item_description' => 'Item Description',
            'item_image' => 'Item Image',
        ];
    }
	
	
	
	
	
	
	

	
	
	
	
	
}
