<?php
return [

    //mine for chiliec\vote, but actually works withou it 
	'bootstrap' => [
    'chiliec\vote\components\VoteBootstrap',
    ],
	//mine
	
	
	'modules' => [
	     
		
	    
		// ... https://github.com/rmrevin/yii2-comments
		'comments' => [
		    'class' => 'rmrevin\yii\module\Comments\Module',
		    'userIdentityClass' => 'dektrium\user\models\User', //'\common\models\User',   //megaFix
		    'useRbac' => true,
		],
		// ...https://github.com/rmrevin/yii2-comments
		
		
		
		
		//Vote widget=> https://github.com/Chiliec/yii2-vote
		'vote' => [
        'class' => 'chiliec\vote\Module',
        // show messages in popover
        'popOverEnabled' => true,
        // global values for all models
        // 'allowGuests' => true,
        // 'allowChangeVote' => true,
        'models' => [
        	// example declaration of models
             \frontend\models\ItemX::className(),  //Mega error fix
            // 'backend\models\Post',
            // 2 => 'frontend\models\Story',
            // 3 => [
            //     'modelName' => \backend\models\Mail::className(),
            //     you can rewrite global values for specific model
            //     'allowGuests' => false,
            //     'allowChangeVote' => false,
            // ],
        ],      
        ],
		//Vote widget => https://github.com/Chiliec/yii2-vote
		
		
		
		//Yii2_USER => https://github.com/dektrium/yii2-user
		'user' => [
            'class' => 'dektrium\user\Module',
        ],
		//https://github.com/dektrium/yii2-user

		
		
		
		
	],// end Modules

	
	
	
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		

		
		 // ...
		 //Social share =>  https://github.com/yiimaker/yii2-social-share
		//Social share =>  https://github.com/yiimaker/yii2-social-share
		

		
    ],
];
