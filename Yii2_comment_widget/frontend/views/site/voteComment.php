<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use rmrevin\yii\module\Comments;
use bigpaulie\social\share\Share;




$this->title = 'Vote_Comment';
$this->params['breadcrumbs'][] = $this->title;
?>




 <!------ FLASH Success from BookingCpg/actionIndex() ----->
   <?php if( Yii::$app->session->hasFlash('successX') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('successX'); ?>
    </div>
    <?php endif;?>
  <!------ END FLASH Successfrom BookingCpg/actionIndex() ----->
	
	



<div class="site-about js-test">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>VoteComments. <br>Uses DB {yii2_comment} <br>Comments by Comments https://github.com/rmrevin/yii2-comments. <br>Votes by: https://github.com/Chiliec/yii2-vote</p><br><br>
</div>

<div class="col-sm-12 col-xs-12">
  <?php
      //getting ItemX items
      foreach($itemX as $a){
	     echo "<div class='list-group-item'>"; 
		 echo "<div class='padding-lg bg-primary' style='padding:0.6em;'><h5>" .$a->item_name . "</h5></div>";   //just name of the item
		   
		   
		 //display comments => rmrevin/yii2-comments
		 echo Comments\widgets\CommentListWidget::widget([
          'entity' => (string) $a->item_id/*item_name*/ /*'photo-15'*/, // type and id
		  'options' => ['class' => 'sx'],
		  'showCreateForm' => true,
		  'pagination'=> [
                'pageParam' => 'page',
                'pageSizeParam' => 'per-page',
                'pageSize' => 2,
                'pageSizeLimit' => [1, 50],
           ]
          ]);
			
		//fill in hidden fields	
		$model->from = Yii::$app->user->identity->username; //assign current userID to form
		$model->entity = $a->item_id; //assign ID of Item to comment to form
        $time = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));//new \yii\db\Expression('NOW()');	
		$model->created_at = $time;

		
		//my form for comment Fix	
		 //echo Yii::$app->controller->renderPartial('render_partial/myCommentForm',  ['itemX'=>'$itemX']);
		 //echo $this->context->renderPartial('render_partial/myCommentForm');
		 echo $this->render('render_partial/myCommentForm', ['model'=> $model]);

	
		
	     //display vote=> Chiliec/yii2-vote  
	     echo \chiliec\vote\widgets\Vote::widget([
         'model' => $a,
          // optional fields
          'showAggregateRating' => true,
         ]); 
		 
		 
		 
		 //Social share =>  https://github.com/yiimaker/yii2-social-share
	
		
		//Social share =>  https://github.com/bigpaulie/yii2-social-share
		   echo Share::widget([
        'type' => 'small',
        'tag' => 'span',
        'template' => '<span>{button}</span>',
    ]);
			
        echo  "</div><br><br><hr><br>";			
      }
	  
	  
	  

	  
	
?>


</div>