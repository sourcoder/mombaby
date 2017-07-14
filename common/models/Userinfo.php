<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userinfo".
 *
 * @property integer $id
 * @property string $nickname
 * @property string $openid
 * @property integer $tall
 * @property integer $weight
 * @property integer $age
 * @property string $last_menses_time
 * @property string $due_date
 * @property integer $current_month
 * @property integer $current_week
 */
class Userinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        //    [['nickname', 'openid', 'tall', 'weight', 'age', 'last_menses_time', 'due_date', 'current_month', 'current_week'], 'required'],
        //    [['tall', 'weight', 'age', 'current_month', 'current_week'], 'integer'],
        //    [['last_menses_time', 'due_date'], 'safe'],
        //    [['nickname', 'openid'], 'string', 'max' => 255],
            [['tall', 'weight', 'age', 'last_menses_time'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => '昵称',
            'openid' => 'Openid',
            'tall' => '身高',
            'weight' => '体重',
            'age' => '年龄',
            'last_menses_time' => '末次月经时间',
            'due_date' => '预产期',
            'current_month' => '当前月',
            'current_week' => '当前周',
        ];
    }
    /**
     * 保存表单数据
     */
    public function create()
    {
        
    }
    
    public function saveInfo($post)
    {
        print_r($post);exit();
        $this->tall = $post['tall'];
        $this->weight = $post['weight'];
        $this->age = $post['age'];
        $this->last_menses_time = $post['last_menses_time'];
        $add = "+10 mouth +7 day";
        $this->due_date = date('Y-m-d',strtotime($add));
        $Date_List_a1=explode("-",$post['last_menses_time']);
        $d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
        $days = (time()-d1)/3600/24;
        $this->current_month = ($days / 30)+1;
        $this->current_week = ($days / 7)+1;
        if(!$this->save())
        {
            return false;
        }
        else {
            return true;
        }
    }
}
