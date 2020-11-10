<?php
//seeder for table {shpsimple}

//namespace App\database\seeds\SeedersFiles;

use Illuminate\Database\Seeder;



//fill DB table {Wpress_blog} with data 
class ShopSimpleSeeder extends Seeder {

  public function run()
  {
    DB::table('shop_simple')->delete();  //whether to Delete old materials

    //User::create(['email' => 'foo@bar.com']);
    DB::table('shop_simple')->insert(['shop_title' => 'Canon camera',        'shop_image' => "canon.jpg",         'shop_price' => 16.64, 'shop_currency' => '$', 'shop_categ' => 1, 'shop_descr' => "30 Mpx, 5kg" ]);
	DB::table('shop_simple')->insert(['shop_title' => 'HP notebook',         'shop_image' => "hp.jpg",            'shop_price' => 35.31, 'shop_currency' => '$', 'shop_categ' => 1, 'shop_descr' => "8Gb Ram, 500Gb SSD" ]);
	DB::table('shop_simple')->insert(['shop_title' => 'Iphone 3',            'shop_image' => "iphone_3.jpg",      'shop_price' => 75.55, 'shop_currency' => '$', 'shop_categ' => 1, 'shop_descr' => "TFT capacitive touchscreen, 3.5 inches, 16M colors, 2 Mpx" ]);
	DB::table('shop_simple')->insert(['shop_title' => 'Iphone 5',            'shop_image' => "iphone_5.jpg",      'shop_price' => 45.00, 'shop_currency' => '$', 'shop_categ' => 2, 'shop_descr' => "Iphone 5 description......" ]);
    DB::table('shop_simple')->insert(['shop_title' => 'Ipod',                'shop_image' => "ipod_classic_3.jpg",'shop_price' => 2.66,  'shop_currency' => '$', 'shop_categ' => 2, 'shop_descr' => "Ipod description...." ]);
    DB::table('shop_simple')->insert(['shop_title' => 'Samsung Sync',        'shop_image' => "samsung_sync.jpg",  'shop_price' => 18.96, 'shop_currency' => '$', 'shop_categ' => 3, 'shop_descr' => "Samsung Sync description..." ]);
    DB::table('shop_simple')->insert(['shop_title' => 'Audio-Tech AT-LP120', 'shop_image' => "turntable.jpg",     'shop_price' => 233,   'shop_currency' => '$', 'shop_categ' => 4, 'shop_descr' => "The best starter turntable with all the features you'll ever need." ]);
    DB::table('shop_simple')->insert(['shop_title' => 'Behringer Vmx200',    'shop_image' => "mixer.jpg",         'shop_price' => 92.04, 'shop_currency' => '$', 'shop_categ' => 4, 'shop_descr' => "Three channels mixer" ]);

  }
}

