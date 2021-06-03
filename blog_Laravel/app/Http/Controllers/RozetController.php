<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use App\models\ShopSimple\ShopSimple;      //model for DB table 
use App\models\ShopSimple\ShopCategories;  //model for DB table 



class RozetController extends Controller
{
    public function __construct(){
		   
	}
	
	
	
	/**
     * Show start page  
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        return view('rozet.index'/*,  compact('articles', 'categories', 'countArticles')*/);
    }
	
	
   /**
     * Create XMl from DB table {shop_simple}, echo it and saves to /public/roztk_xml 
     * SimpleXMLElement, DOMDocument  is a built-in Php library
     * @return \Illuminate\Http\Response
     * https://sellerhelp.rozetka.com.ua/p185-pricelist-requirements.html
     * Use htmlspecialchars() as символы ", &, >, <, ' нужно заменять на эквивалентные коды. Требование относится только к тексту и не относится к написанию тегов;
     */
    public function createXMLSQL()
    {
        $products   = ShopSimple::all();
        $categories = ShopCategories::all();

        $out = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
        $out .= '<!DOCTYPE yml_catalog SYSTEM "shops.dtd">' . "\r\n";
        $out .= '<yml_catalog date="' . date('Y-m-d H:i') . '">' . "\r\n";
        $out .= '<shop>' . "\r\n";
 
        // Optional. Короткое название магазина. Максимальное количество символов 255.
        $out .= '<name>Shop name</name>' . "\r\n";
 
        // Полное наименование компании, владеющей магазином. Максимальное количество символов 255. Optional
        $out .= '<company>ООО Company Dimmm</company>' . "\r\n";
 
        // Main shop page URL. Optional
        $out .= '<url>http://site.com/</url>' . "\r\n";
 
        // Список курсов валют магазина.
        $out .= '<currencies>' . "\r\n";
        $out .= '<currency id="UAH" rate="1"/>' . "\r\n";
        //$out .= '<currency id="USD" rate="26.8"/>' . "\r\n";
        //$out .= '<currency id="EUR" rate="29.2"/>' . "\r\n";
        $out .= '</currencies>' . "\r\n";
 
 
        // Список категорий магазина:
        // id     - ID категории, any random ID set by you.
        // parent - ID родительской категории.
        // name   - Название категории.
        $out .= '<categories>' . "\r\n";
        $out .= '<category id="391">Куртки для мальчиков</category>' . "\r\n";
        $out .= '<category id="245" rz_id="4639416">Аромадиффузоры</category>' . "\r\n"; //rz_id="4639416" is a Rozet section ID
        
        //variant with DB
        /*
        foreach ($categories as $row) {
	        $out .= '<category id="' . $row->categ_id  . '">' //'" parentId="' . $row['parent']
	             . $row->categ_name . '</category>' . "\r\n";
        } 
        */
 
        $out .= '</categories>' . "\r\n";
 

        //Products 
        $out .= '<offers>' . "\r\n";
        foreach ($products as $row) {
	        $out .= '<offer id="' . $row->shop_id . '" group_id="1225" available="true" >' . "\r\n";
 
	        // URL страницы товара на сайте магазина.
	        $out .= '<url>http://site.com/prod/' . $row->shop_id  . '.html</url>' . "\r\n";
 
	        // Цена, предполагается что в БД хранится цена и цена со скидкой.
		    $out .= '<price>' . $row->shop_price . '</price>' . "\r\n";
	
	        // Валюта товара.
	        $out .= '<currencyId>UAH</currencyId>' . "\r\n";//$out .= '<currencyId>' . $row->shop_currency . '</currencyId>' . "\r\n"; 
 
	        // ID категории. //WRONG!!!!!!!!!!!!!
	        $out .= '<categoryId>' . $row->categoryName->categ_name . '</categoryId>' . "\r\n"; //hasOne
 
	        // Изображения товара, Required. Минимальное количество фото - 1, максимальное - 15. Максимальный размер 1 фотографии ━ 10 Мб..
	        $out .= '<picture>http://site.com/img/1.jpg' . $row->shop_image . '</picture>' . "\r\n";
            
            //Бренд-производитель товара. Required.
            $out .= '<vendor>Greenleaf Haven</vendor>' . "\r\n";
            
            //Остатки товара. Required.
            $out .= '<stock_quantity>100</stock_quantity>' . "\r\n";
            
	        // Название товара. Required.
	        $out .= '<name>'. $row->shop_title  .'</name>' . "\r\n";
 
	       // Описание товара, максимум 50 000. Required. символов. описание желательно отформатировать с помощью html тегов. Html теги закрыть в <![CDATA[...]]>; 
	       $out .= '<description> <![CDATA[' . stripslashes(htmlspecialchars($row->shop_descr)) . ']]> </description>' . "\r\n";   //A CDATA section is "a section of element content that is marked for the parser to interpret as only character data, not markup." 
	       
           //Характеристики (параметры) товара. Required. Минимальное количество необходимых характеристик у товара — 3.
            $out .= '<param name="Рост">146 см</param>' . "\r\n";
            $out .= '<param name="Цвет">Черный</param>' . "\r\n";
            $out .= '<param name="Дополнительные характеристики"><![CDATA[Гладить при темпера не более 110 °С. Стирка при температуре 30 °С]]></param>' . "\r\n";
           
            $out .= '</offer>' . "\r\n";
        }
 
        $out .= '</offers>' . "\r\n";
        $out .= '</shop>'   . "\r\n";
        $out .= '</yml_catalog>' . "\r\n";

        header('Content-Type: text/xml; charset=utf-8'); //must have
       /* 
        header('Content-Type: text/xml; charset=utf-8');
        echo $out;
        exit;
       */

		
        //Format XML to save indented tree rather than one line
        $dom = new \DOMDocument('1.0');
        //$dom->preserveWhiteSpace = false;
        //$dom->formatOutput = true;

        //$xmlR = new \SimpleXMLElement($out); //Laravel Fix

        $dom->loadXML($out); //$dom->loadXML($xmlR->asXML());// == $dom->loadXML($out);
        //Echo XML - remove this and following line if echo not desired
        echo $dom->saveXML();

        //Save XML to file - remove this and following line if save not desired
        if($dom->save('roztk_xml/fileName.xml')){ //saves to /public/roztk_xml
            $message = true;
        } else {
            $message = false;
        }    

    }
	
	
}
