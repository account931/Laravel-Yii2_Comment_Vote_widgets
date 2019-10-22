<?php

/* @var $this yii\web\View */

use yii\helpers\Html;





$this->title = 'Yii2-User_Kartik';
$this->params['breadcrumbs'][] = $this->title;
?>








<div class="col-sm-12 col-xs-12">
   <p> Yii2-User_Kartik Widget. Login via Social Networks</p>
   
   <?php
       echo Html::a( "Yii2_Register", ["/user/registration/register"] /* $url = null*/, $options = ["title" => "register",] ) . "</br>"; 
	   echo Html::a( "Yii2_Login", ["/user/security/login"] /* $url = null*/, $options = ["title" => "register",] ) . "</br>";
	   echo Html::a( "Yii2_Log_Out", ["/user/security/logout"] /* $url = null*/, $options = ["title" => "register",] ) . "</br>";
	   echo Html::a( "Yii2_Profile", ["/user/settings/profile"] /* $url = null*/, $options = ["title" => "register",] ) . "</br>";
	   
	   echo Html::a( "Yii2_Account", ["/user/settings/account" ] /* $url = null*/, $options = ["title" => "register",] ) . "</br>";
	   echo Html::a( "Yii2_Social", ["/user/settings/network"] /* $url = null*/, $options = ["title" => "register",] ) . "</br>";
	   echo Html::a( "Yii2_Profile 2", ["/user/profile/show"] /* $url = null*/, $options = ["title" => "register",] ) . "</br>";
	   echo Html::a( "Yii2_Admin", ["/user/admin/index" ] /* $url = null*/, $options = ["title" => "register",] ) . "</br>";
   ?>
</div>