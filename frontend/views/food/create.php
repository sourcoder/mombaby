<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Food */

$this->title = '新建推荐食谱';
?>
<div class="food-create">
    <?php /*$this->render('_form', [
        'model' => $model,
    ])*/ ?>
    <div class="food-form">

        <?php $form = ActiveForm::begin(); ?>
    
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?php 
            $cat = [];
            for($i = 1; $i <= 44; $i++ )
                $cat[] = $i;
        ?>
        <?= $form->field($model, 'week_id')->dropDownList($cat) ?>
    
        <?= $form->field($model, 'image')->widget('common\widgets\file_upload\FileUpload',[
        'config'=>[
            'domain_url' => 'http://frontend.mombaby.com/',
        ]
    ]) ?>
        <?= $form->field($model, 'detail')->widget('common\widgets\ueditor\Ueditor',[
        		'options'=>[
        			'initialFrameHeight' => 400,
       			 ]
    		]) ?>
    		    <?=$form->field($model, 'tags')->Widget('common\widgets\tags\Tags')?>
        <div class = "form-group">
    			<?= Html::submitButton("保存", ['class' => 'btn btn-success'])?>
    	</div>
            
        <?php ActiveForm::end() ?>

    </div>
</div>
