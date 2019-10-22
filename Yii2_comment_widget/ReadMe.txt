This is advancee template.
# to be transfered to RBAC ReadMe

Table of content

1. Basic vs Advanced configs
2. Comments widget extension =>rmrevin/yii2-comments
3. Vote widget extension => /Chiliec/yii2-vote
4. Dektrium/Yii2_User Module => Extended register/login, login via social networks, Admin module => https://github.com/dektrium/yii2-user
5. Social share => https://github.com/bigpaulie/yii2-social-share
6.
7. Yii2 Ccodeception tests
8. Others => CLI
9. Laravel




==================================================================
1. Basic vs Advanced configs
 #DB connection: Basic (config/db.php) vs Advanced (common/config/main-local.php)
 #Modules: Basic (config/web.php) vs Advanced (common/config/main.php)
 #Components: Basic (config/web.php vs Advanced (common/config/main-local.php)
 #DB connection for Codeception Tests (Fixtures): Basic () vs Advanced (common/config/test-local.php)


 
 
 
 
 
 
 ==================================================================
2. Comments widget extension =>rmrevin/yii2-comments
Documentation=> https://github.com/rmrevin/yii2-comments
#This example is used in Advanced Yii2 template
#This widget displays comments to model {ItemX}. Comments are stored in DB comments (available after migration)
#This widget must display a form to add a comment but for some bizzair reason it doesn't, so I deployed my custom form to every item in for() loop.
  2.1 Install =>   composer require "rmrevin/yii2-comments:~1.4"
  2.2 Add to common/config/main.php:
      return [
	// ...
	'modules' => [
		// ...
		'comments' => [
		    'class' => 'rmrevin\yii\module\Comments\Module',
		    'userIdentityClass' => 'app\models\User',
		    'useRbac' => true,
		]
	],
	// ...
    ];
	2.3 In your User model (or another model implements the interface IdentityInterface) 
	need to implement the interface "\rmrevin\yii\module\Comments\interfaces\CommentatorInterface". See GitHub
	2.4 In auth manager add rules (if Module::$useRbac = true). See GitHub. To deploy, just run the code in any action but just one time, the second will cause crash.
	2.5 Add migration => php yii migrate/up --migrationPath=@vendor/rmrevin/yii2-comments/migrations/
	2.6 in View:
	   use rmrevin\yii\module\Comments;
	   foreach($model as $a){
	        echo Comments\widgets\CommentListWidget::widget([
          'entity' => (string) $a->item_id/*item_name*/ /*'photo-15'*/, // type and id
		  'options' => ['class' => ''],
		  'showCreateForm' => True,
          ]);
 
 
 
 
 
 
 
 
 
 
===================================================================
3. Vote widget extension => /Chiliec/yii2-vote
 Documentation=> https://github.com/Chiliec/yii2-vote
 This example is used in Advanced Yii2 template
 # You can modify the view of widget, text, icons in \vendor\chiliec\yii2-vote\widgets\views.vote.php
 How to deploy:
   3.1 Install:
      #by running in CLI =>       composer require --prefer-dist chiliec/yii2-vote "^4.2"
      #or install by adding to composer  =>   "chiliec/yii2-vote": "^4.2" 
	  
   3.2 Add this code to /commom/config/main.php  to modules section. SPECIFY YOUR MODEL for VOTING HERE!!!!!!!!!!!!!!!
   
       'modules' => [
	   
	   //other modules...........
	   
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
             \frontend\models\ItemX::className(),  //Mega error fix, MUST SPECIFY YOUR MODEL for VOTING HERE. I use model/table ItemX, that store some items to be voted for
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
		
        // other modules......
		
		]
 
    3.3 Add to /commom/config/main.php outside the modules section
	'bootstrap' => [
    'chiliec\vote\components\VoteBootstrap',
    ],
	
	3..3.3 Add migration
	
	3.4 Use in view. 
	  3.4.1.Example from documentation:
	
	    echo \chiliec\vote\widgets\Vote::widget([
           'model' => $model,
           // optional fields
           // 'showAggregateRating' => true,
         ]);
	
    3.4.2 Example from my actual usage. We use model/table ItemX, that store some items to be voted for.
	Firstly, in Controller we find all items in model Itemx => 
	Secondly, in view we use foreach=> 
	            foreach($model as $a){
				    echo $a->item_name; //just echo the name of item from table ItemX
					
					//vote=> Chiliec/yii2-vote  
	                echo \chiliec\vote\widgets\Vote::widget([
                       'model' => $a,
                       // optional fields
                      'showAggregateRating' => true,
                    ]); 
				}
		    
				
	
 
 
 
 
 
 
 ==================================================================
4. Dektrium/Yii2_User Module => Extended register/login, login via social networks, Admin module => https://github.com/dektrium/yii2-user
  Extended register/login Yii2_USER module instead of custom build-in advanced template.
  This example is used in Advanced Yii2 template
  4.1 To install => follow https://github.com/dektrium/yii2-user/blob/master/docs/README.md
  4.2 If u have had already some registration (before deploying Yii2_USER module):
      #it means u have already DB {users}, which will conflict with migration,that suppose to use its own table {users}. Therefore, rename/delete your original table {user}.
      # change config file in frontend/config/main.php and backend/config/main.php => change in component section:
	      this:    'user' => [  'identityClass' => 'common\models\User', .......
		  to this: 'user' => ['identityClass' => 'dektrium\user\models\User', ............
	  #if you have any other modules using {'common\models\User'} change it to {'dektrium\user\models\User'}. 
	     In my case it was {https://github.com/rmrevin/yii2-comments} in common/config/main.php
	  #change login, log out, register Menu links to {"/user/security/login", "/user/registration/register", etc}
 
  4.3 If u'd like to switch back to your original reister/login process=> rename back original table to {users} + change back {dektrium\user\models\User'} to {'common\models\User'}
 
 
 4.5 Admin Module in Dektrium/Yii2_User Module is at {"/user/admin/index"}. Is intended to view, create, block users. Can not assign RBAC roles to users.
 4.5.1 By default Admin Module is not available, you habe no rights to visit it, to ovverride this:
    # in \vendor\dektrium\yii2-user\controllers\AdminController in {public function behaviors()} change {'switch'} to your actions u need access:
	    'rules' => [
                    [   'allow' => true,
                        'actions' => ['switch'], // change {'switch'} to {'index', 'create', etc}
                        'roles' => ['@'], ],
 
    # For some bizzar reasons  {'allow' => true,'roles' => ['admin'],} does not work & from now all users have access to admin/index, to fix this:
	      - create your own exception in AdminController, as variant to restrict access to all controller, add in {public function __construct()} => {if(!Yii::$app->user->can('admin')){throw new \yii\web\NotFoundHttpException("Have no rights");}
          - create RBAC 'admin' role to yourself(the account u are now logge in)=> see 8.Yii RBAC at  https://github.com/account931/yii2_REST_and_Rbac_2019/blob/master/Readme_YII2_mine_Common_Comands.txt
 
 
 
 =================================================================
 5. Social share => https://github.com/bigpaulie/yii2-social-share
 
 
 
 
 
 
 
 
 
 
 
 
 

==================================================================
7. Yii2 Ccodeception tests
Codeception=>   https://codeception.com/for/yii

Prepare(https://habr.com/ru/post/254509/):

1. Install codeception globally  =>      composer global require codeception/codeception
2. Go to root and install yii2-codeception library =>   composer require --dev yiisoft/yii2-codeception
3. codecept bootstrap --customize
  codecept build ???

4. codecept run

#Configure fixture DB  for Codeception Tests: Basic () vs Advanced (common/config/test-local.php). Import here all tables from main DB.

#Advanced template tests:
     Common tests:  {unit=> testLoginNoUser(), testLoginWrongPassword(), testLoginCorrect()}
     Backend tests:  {functional=> LoginCest(login & there is no LOGIN/SIGN UP buttons)}
	 Frontend tests:  {acceptance=> HomeCest (I visit "/" I see...)} +
	                  {functional=>  SignupCest(signupWithEmptyFields, signupWithWrongEmail, signupSuccessfully),  LoginCest, AboutCest, HomeCest, etc}
                      {unit=> models/SignupFormTest(testCorrectSignup(), testNotCorrectSignup()),  ContactFormTest, PasswordResetRequestFormTest,  etc }

#composer require "codeception/specify=*"
#composer require "codeception/verify=*"

codecept bootstrap -creats envinroment for test and creats config codeception.yml (by default from the box в yii уже созданы окружения)
codecept build - makes the compilation, should be done after changes in tests config
codecept run - run tests				  
					  

#Examples of my tests with descriptions => see \Yii2_comment_widget\frontend\tests\unit\models\ItemX.php					  
					  
					  
					  
	//Erase below, tried to launch 1 test only				  
	codecept run tests/frontend/unit/models/ContactFormTest.php	
    codecept run frontend/unit/models/ContactFormTest.php	
	codecept run unit models ContactFormTest.php
	codecept run tests/unit/ContactFormTest.php
	codecept run -vv unit models/ContactFormTest
	codecept run -vv acceptance HomeCept
	
	
	
	
	
					  
					  
==================================================================
8. Others => CLI
 #Use CLI in full screen =>   mode 800
 #Check php version => php -v
 
 =================================================================
8.1 Others=> Yii2
 #Render partial => echo $this->render('render_partial/myCommentForm', ['model'=> $model]);
 
 #Built-in Captcha=> 
    In model:
            public $verifyCode; //for captcha
			 //..
			 // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
    In View:
	 echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                 'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]);
				
	#Hidden input field + default value + hide lable =>  $form->field($model, 'entity')-> hiddenInput(['value'=> ''])->label(false);
	
	#add to Readme=> prettyUrl=> 'yout-text-from-config-web-php.rar' => 'site/about', //pretty url for 1 action(if Yii sees 'site/about' it turn it to custom text)
	
	#cancel last migration => yii migrate/down  