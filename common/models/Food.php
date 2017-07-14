<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\RelationFoodTag;
/**
 * This is the model class for table "food".
 *
 * @property integer $id
 * @property integer $week_id
 * @property string $image
 * @property string $title
 * @property string $detail
 */
class Food extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['week_id', 'image', 'title', 'detail'], 'required'],
            [['week_id'], 'integer'],
            [['detail'], 'string'],
            [['image', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'week_id' => '试用周数',
            'image' => '图片',
            'title' => '名称',
            'detail' => '详细步骤',
        ];
    }
    /**
     * 关联关系
     */
    public function getRelate()
    {
        return $this->hasMany(RelationFoodTag::className(), ['food_id' => 'id']);
    }
}
