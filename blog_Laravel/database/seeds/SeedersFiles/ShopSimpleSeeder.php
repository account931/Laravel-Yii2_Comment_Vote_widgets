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
    DB::table('shop_simple')->insert(['shop_id' => 1, 'shop_title' => 'Canon EOS R',         'shop_image' => "canon.jpg",         'shop_price' => 2354.16, 'shop_currency' => '$', 'shop_categ' => 1, 'sh_device_type'=> 'Camera',      'shop_descr' => "CANON EOS R, 30 Mpx. The EOS R is Canon's first full-frame mirrorless camera. It features a 30.3MP CMOS sensor with Dual Pixel AF and an ISO range of 100-40000 (expandable to 50-102400). The EOS R can record both 14-bit (CRW) and compressed (C-RAW) formats. It can shoot continuously at 8 fps in single AF and 5 fps with continuous AF" ]);
	DB::table('shop_simple')->insert(['shop_id' => 2, 'shop_title' => 'HP notebook 4530S',   'shop_image' => "hp.jpg",            'shop_price' => 287.36,  'shop_currency' => '$', 'shop_categ' => 1, 'sh_device_type'=> 'Notebook',    'shop_descr' => "HP 4530S, 4Gb Ram, 320Gb HDD. Outfitted with a 2.3-GHz Intel Core i5-2410M processor and 4GB of RAM, the HP ProBook 4530s offers solid performance. Equipped with a large 500GB hard drive spinning at a quick 7,200 rpm, the ProBook 4530s managed to fire up Windows 7 Professional in 58 seconds, 8 seconds faster than the average 15-inch notebook" ]);
	DB::table('shop_simple')->insert(['shop_id' => 3, 'shop_title' => 'Iphone 3',            'shop_image' => "iphone_3.jpg",      'shop_price' => 60.55,   'shop_currency' => '$', 'shop_categ' => 1, 'sh_device_type'=> 'LCD',         'shop_descr' => "TFT capacitive touchscreen, 3.5 inches, 16M colors, 2 Mpx" ]);
	DB::table('shop_simple')->insert(['shop_id' => 4, 'shop_title' => 'Iphone 5',            'shop_image' => "iphone_5.jpg",      'shop_price' => 112.39,  'shop_currency' => '$', 'shop_categ' => 2, 'sh_device_type'=> 'mobile',      'shop_descr' => "Iphone 5 description......" ]);
    DB::table('shop_simple')->insert(['shop_id' => 5, 'shop_title' => 'Ipod',                'shop_image' => "ipod_classic_3.jpg",'shop_price' => 273.34,  'shop_currency' => '$', 'shop_categ' => 2, 'sh_device_type'=> 'mobile',      'shop_descr' => "Ipod description...." ]);
    DB::table('shop_simple')->insert(['shop_id' => 6, 'shop_title' => 'Samsung C27R500',     'shop_image' => "samsung_sync.jpg",  'shop_price' => 257.64,  'shop_currency' => '$', 'shop_categ' => 3, 'sh_device_type'=> 'TV',          'shop_descr' => "Samsung C27R500 27'. FHD Curved Monitor with 1800R curvature and 3-sided bezel-less screen." ]);
    DB::table('shop_simple')->insert(['shop_id' => 7, 'shop_title' => 'Audio-Tech AT-LP120', 'shop_image' => "turntable.jpg",     'shop_price' => 472.91,  'shop_currency' => '$', 'shop_categ' => 4, 'sh_device_type'=> 'Turntable',   'shop_descr' => "The best starter turntable with all the features you'll ever need. This professional stereo turntable features a high-torque direct-drive motor for quick start-ups and a USB output that connects directly to your computer. Other features include: forward and reverse play capability; cast aluminum platter with slip mat and a start/stop button; three speeds 33/45/78; selectable high-accuracy quartz-controlled pitch lock and pitch change slider control with +/-10% or +/-20% adjustment ranges; and removable hinged dust cover. Mac and PC compatible Audacity software digitizes your LPs Direct drive high-torque motor. Stroboscopic platter speed indicator" ]);
    DB::table('shop_simple')->insert(['shop_id' => 8, 'shop_title' => 'Behringer Vmx200',    'shop_image' => "mixer.jpg",         'shop_price' => 169.36,  'shop_currency' => '$', 'shop_categ' => 4, 'sh_device_type'=> 'Mixer',       'shop_descr' => "Professional 2-channel ultra-low noise DJ mixer with state-of-the-art phono preamps. Super-smooth, long-life ULTRAGLIDE faders (up to 500,000 cycles). 3-band kill EQ (-32 dB) and precise level meters with peak hold function" ]);
    DB::table('shop_simple')->insert(['shop_id' => 9, 'shop_title' => 'Kington 16GB Flash',  'shop_image' => "kingston.jpg",      'shop_price' => 3.35,    'shop_currency' => '$', 'shop_categ' => 1, 'sh_device_type'=> 'Flash',       'shop_descr' => "16 GB Flash Drive. Convenient - small, capless and pocket-sized for easy transportability. Durable - metal casing with sturdy ring. USB Specification: USB 2.0,Guaranteed - five-year warranty" ]);
    DB::table('shop_simple')->insert(['shop_id' => 10,'shop_title' => 'Pioneer DDJ-WEGO-K',  'shop_image' => "wego.jpg",          'shop_price' => 351.69,  'shop_currency' => '$', 'shop_categ' => 4, 'sh_device_type'=> 'Controller',  'shop_descr' => "Ultra-compact and affordable DJ controller. Plug & Play with bundled Virtual DJ LE software. Pulse Control Provides Visual Prompts via Various Types of Illuminations Directly on the Unit. Multi-colored LED for customization of lights to match the user's style" ]);

  }
}

