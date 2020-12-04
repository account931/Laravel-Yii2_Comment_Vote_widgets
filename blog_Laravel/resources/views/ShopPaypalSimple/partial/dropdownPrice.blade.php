<?php
//Select by lowest, highest price, newest etc. Done by adding to url $_GET param, i.e &order=lowest OR &order=highest 
//Proccessin happens in Controller in function index() -> ShopPayPalSimpleController.php

//Auto generate correct url path, i.e "shopSimple?order=highest" or "/shopSimple?shop-category=2&order=lowest"
//if url already contain some $_GET, i.e $_GET['shop-category'], get it 
if(isset($_GET['shop-category'])){
	$categoryX = "?shop-category=" . $_GET['shop-category'] . "&"; //i.e will be "?shop-category=desktop&"
} else {
	$categoryX = '?'; ////i.e will be "?"
}

//NOT USED so far 
if(isset($_GET['page'])){
	$pageX = "&page=" . $_GET['page'] . "&"; //i.e will be "?shop-category=desktop&"
} else {
	$pageX = ''; ////i.e will be "?"
}
?>


<!-- Bootstrap dropdown (instead of select)-->
<div class="dropdown">
    Price <i class="fa fa-chevron-down dropdown-toggle" data-toggle="dropdown"></i>   
 
    <div class="dropdown-menu ">                                        
	  <ul>
	    <!-- for every <li> check if URL contains ($_GET['order']) and  $_GET['order']=='item' and add a mark to show this item is selected -->
        <li><a class="dropdown-item" href={{ url("/shopSimple" . $categoryX .  "order=lowest") }} > Lowest price  {!! (isset($_GET['order']) && $_GET['order']=='lowest')  ? ' <span class="text-danger">&hearts;</span>' : ' ' !!} </a></li> <!-- html unescapped tags / without escapping-->
        <li><a class="dropdown-item" href={{ url("/shopSimple" . $categoryX .  "order=highest") }}> Highest price {!! (isset($_GET['order']) && $_GET['order']=='highest') ? ' <span class="text-danger">&hearts;</span>' : ' ' !!} </a></li> <!-- html unescapped tags / without escapping-->
        <li><a class="dropdown-item" href={{ url("/shopSimple" . $categoryX .  "order=newest") }} > New product   {!! (isset($_GET['order']) && $_GET['order']=='newest')  ? ' <span class="text-danger">&hearts;</span>' : ' ' !!} </a></li> <!-- html unescapped tags / without escapping-->
      </ul>
    </div>
  </div>