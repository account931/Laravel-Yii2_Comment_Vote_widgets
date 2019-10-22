<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

use frontend\models\ItemX; // some list of items to be commented
use frontend\models\Comment; // to create form to add comments




use frontend\models\AuthItem; //table with Rbac roles
use frontend\models\AuthAssignment; //table with Rbac roles $ users' id assigned to that rbac role





//Comments https://github.com/rmrevin/yii2-comments
use \rmrevin\yii\module\Comments\Permission;
use \rmrevin\yii\module\Comments\rbac\ItsMyComment;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	
	
	
	
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
		

//MUST fire it only 1 time ever. Used for https://github.com/rmrevin/yii2-comments
/*
$AuthManager = \Yii::$app->getAuthManager();
$ItsMyCommentRule = new ItsMyComment();

$AuthManager->add($ItsMyCommentRule);

$AuthManager->add(new \yii\rbac\Permission([
    'name' => Permission::CREATE,
    'description' => 'Can create own comments',
]));
$AuthManager->add(new \yii\rbac\Permission([
    'name' => Permission::UPDATE,
    'description' => 'Can update all comments',
]));
$AuthManager->add(new \yii\rbac\Permission([
    'name' => Permission::UPDATE_OWN,
    'ruleName' => $ItsMyCommentRule->name,
    'description' => 'Can update own comments',
]));
$AuthManager->add(new \yii\rbac\Permission([
    'name' => Permission::DELETE,
    'description' => 'Can delete all comments',
]));
$AuthManager->add(new \yii\rbac\Permission([
    'name' => Permission::DELETE_OWN,
    'ruleName' => $ItsMyCommentRule->name,
    'description' => 'Can delete own comments',
]));
 */


        return $this->render('index');
    }
	
	
	
	
	
	
	
	

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
		//assign RBAC
		/*
		 $role = Yii::$app->authManager->createRole('admin');
         $role->description = 'Админ';
         Yii::$app->authManager->add($role);
		 
		 $userRole = Yii::$app->authManager->getRole('admin');
        Yii::$app->authManager->assign($userRole, Yii::$app->user->identity->id); //assign to current user
		*/
		//
		
		
		
		
        return $this->render('about');
    }
	
	
	
	
	
	
	

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
	
	
	
	
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
	 public function actionVote_comment()
    {
		$model = new Comment();
		
		if ($model->load(\Yii::$app->request->post())) {
			
			
			if($model->save()){
                 \Yii::$app->session->setFlash("successX", "Successfully added comment <i class='fa fa-address-book-o' style='font-size:1.2em;'></i> <b> $model->text</b>");
			     return $this->refresh(); //prevent  F5  resending	
		    }
		}
		
		//find all items
		$itemX = ItemX::find()-> all();
		
	
		
		return $this->render('voteComment', [
            'model' => $model,
			'itemX' => $itemX,
        ]);
	}
	//------------------------------------------------------------
	
	
	
	//just to display yii2_user Module links
	// **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
	 public function actionYii2_user()
    {
		
		return $this->render('yii2_user'/*, [
            'model' => $model,
        ]*/);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//RBAC management table, creats/displays RBAC management table(based on 3table INNERJOIN).
//In table u can select and assign a specific RBAC role to a certain user. When u this, an ajax with userID & RBAC roleName are sent to site/AjaxRbacInsertUpdate. Ajax logic is in views/site/rbac-view
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **
     public function actionRbac()
    {
			
		
		//check if user has Rbac role {admin}. If user has, do next....
		if(Yii::$app->user->can('admin')){
			
			
			
				
			
			//Instance/model of DB table {auth_item} to pass it to view (to render yii form "Add new Rbac role ") + detect form submission here
			$authItem_Model = new AuthItem();
		
			//**********************************************************************
			//If the Form to add a new RBAC role to {auth_item} DB is trigered-----------------
			
            // validate any AJAX requests fired off by the form
            /*if (Yii::$app->request->isAjax && $authItem_Model->load(Yii::$app->request->post())) {
               Yii::$app->response->format = Response::FORMAT_JSON;
               return ActiveForm::validate($authItem_Model);
             }	*/		
			
			
			
			
            if ($authItem_Model->load(Yii::$app->request->post()) /*&& $authItem_Model->save()*/) {  //&& $searchMine->validate()
				//var_dump(\Yii::$app->request->post());
				
			
                //	Section to create a new role (in Bootsrap dropdown collapse)		
		        //create a new role, it is created if this role does not exist in table {auth_item}
			    $is = AuthItem::find()->where(['name' => $authItem_Model->name])->one(); //find the role in table {auth_item} by suggested user input { $authItem_Model->name}
	            if (!$is) {   //Checks if Rbac role already exists. Name of rbac role is passes as $authItem_Model->name
                    $role = Yii::$app->authManager->createRole($authItem_Model->name);
                    $role->description = $authItem_Model->description;
                    Yii::$app->authManager->add($role);
				    Yii::$app->getSession()->setFlash('success', "New role is created-> <b>$authItem_Model->name </b>");
			    } else {
				    Yii::$app->getSession()->setFlash('success', "The role <b>$authItem_Model->name </b> already exists");
			}
			
              return $this->refresh(); //prevents from form resubmitting on reload & flash appearing  		
			}
			//END If the Form to add a new RBAC role to {auth_item} DB is trigered-----------------
            //*************************************************************************
		
		
		
		
		
		
		
		
		
			
			//Inner Join 3 tables---------------------
            $query = new \yii\db\Query;  //must be {$query = new \yii\db\Query;} not{$query = new Query;}, adding {use yii\db\Query} won't help
            $query  ->select(['item_name', 'user_id', /*users DB*/ 'id', 'username', /*auth_item DB*/'description'])  //columns list from all JOIN tables[/*auth_assignment DB*/,  /*users DB*/,/*auth_item DB*/ ]
                ->from('auth_assignment')  //table1
				
				
				//
				 ->join( 'INNER JOIN',  
                     'auth_item', //table2
                     'auth_item.name=auth_assignment.item_name' //table2.column = table1.column
                  )
				//
				
                 ->join( 'RIGHT JOIN',  //INNER JOIN //use RIGHT JOIN to get all users regardless in their ids in auth_assignment
                     'user', //table3
                     'auth_assignment.user_id=user.id ' //table2.column = table1.column
                  ); 
            $command = $query->createCommand();
            $query = $command->queryAll(); 
		    // END Inner Join 3 tables-----------------
			
			
			
			
			
			
			//Selects all RBAc roles from table auth_item(for <select><option>)
			$rbacRoleList = AuthItem::find()->/*where(['username' => 'admin'])->one()*/all();
			
		
			
			
			
			
		
			
			
			return $this->render('rbac-view', [
                         //'model' => $model,
						 'query' => $query, //Inner Join result (based on Buyres/Orders Sql)
						 'rbacRoleList' => $rbacRoleList, //all RBAc roles from table auth_item(for <select><option>)
						 'authItem_Model' => $authItem_Model,//Instance/model of DB table {auth_item} to pass to view (to render yii form "Add new Rbac role ")
						
                         ]);
						 
			
		//if user does not have Rbac role {admin}	
		} else {
			return $this->render('no-access', [
            //'model' => $model,
            ]);
		}
        
 
        
    }
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************



//Ajax function/action that is triggered from view/site/rbac-view.php(renedered by actionRbac())
//This functions waits for request with userID & RbacRole from view/site/rbac-view.php, then UPDATES/INSERTS a specified user with specified Rbac role
// **************************************************************************************
// **************************************************************************************
// **                                                                                  **
// **                                                                                  **
     public function actionAjaxRbacInsertUpdate()
    {   
	    //just a test if ajax is recognized
        if (Yii::$app->request->isAjax) { 
	        $test = "Ajax Worked, recognized!";
	    } else {
            $test = "Ajax  not recognized!";
		}
		
		
		
		//assign new RBAC role to a specific user(the role to assign and userID came via ajax from view/site/rbac-view.php)=$_POST['selectValue'];$_POST['userID']
		
		//check if User has any role at all in {auth_assignment} DB, to decide to use DB INSERT or DB UPDATE
		$userExist = AuthAssignment::find()->where(['user_id' => $_POST['userID']])->one(); //finding a single user in DB
		
		
		
		if($userExist){//IF user is already in {auth_assignment} DB
		
			if($userExist->item_name == $_POST['selectValue'] ){ //if user selects a rbac role that is already currently assigned, DO NOTHING
				$status = "User is already assigned to this role. Do nothing";
			} else {
			    $status = "User has already a role in auth_assignment DB. Use UPDATE";
			    //UPDATE logic.....
			    
			    //$customer = Customer::findOne(123);
                /*$userExist->item_name = $_POST['selectValue'];
                $customer->save();
				$status = $status ." HAVE DONE";*/
				//Can't edit , just use REVOKE for Rbac role & assign a new role !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				$revokedRole = Yii::$app->authManager->getPermission($userExist->item_name);
			if (Yii::$app->authManager->revokeAll((int)$_POST['userID'])){ //revoke all user's rbac roles. to revoke one role-> revoke( $current_user_role, $this->id );
			    //after revoking all assign a new rbac role
				$userRole = Yii::$app->authManager->getRole($_POST['selectValue']); //gets the role that was selected in form, role is (from auth_assignment DB)
                Yii::$app->authManager->assign($userRole, $_POST['userID']);// assign a DB role to user ID
				$status = $status ." HAVE DONE. Rbac Revoked & assigned new";
			} else {$status = $status ." Revoke failed";}
			
			}
			
		} else { //IF user is not in {auth_assignment} DB - get role and assign it to him
			$status = "User is new to auth_assignment DB. Use INSERT";
			//INSERT logic
			$userRole = Yii::$app->authManager->getRole($_POST['selectValue']); //gets the role that was selected in form, role is (from auth_assignment DB)
            Yii::$app->authManager->assign($userRole, $_POST['userID']);// assign a DB role to user ID
			$status = $status ." HAVE DONE. Created New";
		}
		//END assign new RBAC role to a specific user(the role to assign and userID came via ajax from view/site/rbac-view.php)=$_POST['selectValue'];$_POST['userID']
		
		
		//getting  new role decription the user was assigned(to html with ajax)
		//$descriptionNewX = AuthItem::find()->where(['name' => $userRole])->one();
		//$desc = $descriptionNewX->description;
		
		
		  //RETURN JSON DATA
		  // Specify what data to echo with JSON, ajax usese this JSOn data to form the answer and html() it, it appears in JS consol.log(res)
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => $test, // return ajx status
             'code' => 100,	 
             'selectedRBAC' => $_POST['selectValue'], //json echo rbac role, that came from /view/site/rbac-view.php
             'userIDX' => 	   $_POST['userID'], //json echo rbac role, that came from /view/site/rbac-view.php		
             'statusX' => $status,  //message wheather UserID exists in auth_assignment DB, if true use DB UPDATE, if false use DB INSERT	
             'roleNew' => $userRole->name, // new role the user was assigned(to html with ajax)	
             'descriptionNew' => $userRole->description, // new role decription the user was assigned(to html with ajax)				 
          ]; 
	}    
// **                                                                                  **
// **                                                                                  **
// **************************************************************************************
// **************************************************************************************









	
	
}
