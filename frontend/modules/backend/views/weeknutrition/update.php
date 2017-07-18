<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WeekNutrition */

$this->title = 'Update Week Nutrition: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Week Nutritions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="week-nutrition-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
