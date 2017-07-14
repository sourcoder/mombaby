<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "relation_food_tag".
 *
 * @property integer $id
 * @property integer $food_id
 * @property integer $tag_id
 */
class RelationFoodTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation_food_tag';
    }
    /*
     * 关联tag
     */
    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['food_id', 'tag_id'], 'required'],
            [['food_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'food_id' => 'Food ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
