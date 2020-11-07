<?php
//seeder for table {shpsimple}
use Illuminate\Database\Seeder;



//fill DB table {Wpress_blog} with data 
class ShopSimpleSeeder extends Seeder {

  public function run()
  {
    DB::table('shopSimple')->delete();  //whether to Delete old materials

    //User::create(['email' => 'foo@bar.com']);
    DB::table('shopSimple')->insert(['shop_title' => 'Canon camera', 'shop_image' => "canon.jpg",         'shop_price' => 16.64, 'shop_currency' => '$', 'shop_desrc' => "30 Mpx, 5kg" ]);
	DB::table('shopSimple')->insert(['shop_title' => 'HP notebook',  'shop_image' => "hp.jpg",            'shop_price' => 35.31, 'shop_currency' => '$', 'shop_desrc' => "8Gb Ram, 500Gb SSD" ]);
	DB::table('shopSimple')->insert(['shop_title' => 'Iphone 3',     'shop_image' => "iphone_3.jpg",      'shop_price' => 75.55, 'shop_currency' => '$', 'shop_desrc' => "TFT capacitive touchscreen, 3.5 inches, 16M colors, 2 Mpx" ]);
	DB::table('shopSimple')->insert(['shop_title' => 'Iphone 5',     'shop_image' => "iphone_5.jpg",      'shop_price' => 45.00, 'shop_currency' => '$', 'shop_desrc' => "Iphone 5 description......" ]);
    DB::table('shopSimple')->insert(['shop_title' => 'Ipod',         'shop_image' => "ipod_classic_3.jpg",'shop_price' => 2.66,  'shop_currency' => '$', 'shop_desrc' => "Ipod description...." ]);
    DB::table('shopSimple')->insert(['shop_title' => 'Samsung Sync', 'shop_image' => "samsung_sync.jpg",  'shop_price' => 18.96, 'shop_currency' => '$', 'shop_desrc' => "Samsung Sync description..." ]);

  }
}

