<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WeekNutrition */

$this->title = 'Create Week Nutrition';
$this->params['breadcrumbs'][] = ['label' => 'Week Nutritions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="week-nutrition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
