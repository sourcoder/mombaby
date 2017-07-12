<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "week_nutrition".
 *
 * @property integer $id
 * @property integer $week
 * @property string $nutrition
 */
class WeekNutrition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'week_nutrition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['week', 'nutrition'], 'required'],
            [['week'], 'integer'],
            [['nutrition'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'week' => '周数',
            'nutrition' => '主要营养',
        ];
    }
}
