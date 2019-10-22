<?php
//partial view for comment form
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>

<div class="">

   <?php
   
   if(Yii::$app->user->isGuest){ 
       echo "<p>Please, login to vote </p>";
   } else {
	           
	           $form = ActiveForm::begin(['id' => '']); 
	   
                echo $form->field($model, 'entity')-> hiddenInput()->label(false); //textInput(['value'=> ''])->label(false);
				
                //echo $form->field($model, 'entity')->textInput(['autofocus' => true]);

                echo $form->field($model, 'from')->hiddenInput()->label(false);

                echo $form->field($model, 'text')->textarea(['rows' => 2, 'placeholder'=>'comment here']) ->label(false); 
				echo $form->field($model, 'created_at')->hiddenInput()->label(false); //->textInput(); 

               echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                 'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]);
				?>

                <div class="form-group">
                    <?= Html::submitButton('Comment', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); 
   }
   ?>
    

</div>
