<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WeekNutrition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="week-nutrition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'week')->textInput() ?>

    <?= $form->field($model, 'nutrition')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
