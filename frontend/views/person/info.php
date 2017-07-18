<?php
$this->title = "个人信息";
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\date\DatePicker;
?>
<style>
#head .img{
	margin:20px;
}
</style>
<div id="head">
    <div class="img"><img src="<?=$model->headimgurl?>" alt="here is avatar" style = "whdth:100px;height:100px" class="img-circle center-block"></div>
    <div><p class="text-center">hello <span><?=$model->nickname?></span></p></div>
</div>
<?php $form = ActiveForm::begin(['method'=>'post',]); ?>

<div>
    <?=$form->field($model, 'age')->textInput([]) ?>
</div>
<div>
    <?= $form->field($model, 'last_menses_time')->widget(DatePicker::classname(), [ 
    'options' => ['placeholder' => ''], 
    'pluginOptions' => [ 
        'autoclose' => true, 
        'todayHighlight' => true, 
        'endDate' =>'-28d',
        'format' => 'yyyy-mm-dd', 
    ] 
]); ?>
    
</div>
<div class="text-center">
<?=Html::submitButton('确认', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>
</div>
<?php ActiveForm::end(); ?>