<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wechat_user".
 *
 * @property integer $id
 * @property string $openid
 * @property string $nickname
 * @property integer $sex
 * @property string $headimgurl
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $access_token
 * @property string $refresh_token
 * @property string $created_at
 * @property integer $tall
 * @property integer $weight
 * @property integer $age
 * @property string $last_menses_time
 * @property string $due_date
 * @property integer $current_month
 * @property integer $current_week
 */
class WechatUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'openid', 'nickname', 'headimgurl', 'country', 'province', 'city', 'access_token', 'refresh_token', 'tall', 'weight', 'age', 'last_menses_time', 'due_date', 'current_month', 'current_week'], 'required', 'message' => "不能为空"],
            [['id', 'sex', 'tall', 'weight', 'age', 'current_month', 'current_week'], 'integer'],
            [['created_at', 'last_menses_time', 'due_date'], 'safe'],
            [['openid', 'headimgurl', 'access_token', 'refresh_token'], 'string', 'max' => 255],
            [['nickname', 'country', 'province', 'city'], 'string', 'max' => 50],
        ];
    }
    /**
     * 定义场景
     * SCENARIOS_SAVE_BASIC_INFO = 'save_basic_info';
     * SCENARIOS_SAVE_ADVANCED_INFO = 'save_advanced_info';
     */
    const SCENARIOS_SAVE_ADVANCED_INFO = 'save_advanced_info';
    const SCENARIOS_SAVE_BASIC_INFO = 'save_basic_info';
    
    /*
     * 场景设置
     */
    public function scenarios()
    {
        $scenarios = [
            self::SCENARIOS_SAVE_ADVANCED_INFO	 => ['tall', 'weight', 'age', 'last_menses_time', 'due_date','current_month','current_week'],
            self::SCENARIOS_SAVE_BASIC_INFO => ['openid', 'nickname', 'headimgurl', 'country', 'province', 'city', 'access_token'],
        ];
        return array_merge(parent::scenarios(),$scenarios);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => 'Openid',
            'nickname' => '昵称',
            'sex' => '性别',
            'headimgurl' => '头像',
            'country' => '国籍',
            'province' => '省',
            'city' => '城市',
            'access_token' => 'Access Token',
            'refresh_token' => 'Refresh Token',
            'created_at' => '创建时间',
            'tall' => '身高(cm)',
            'weight' => '体重(kg)',
            'age' => '年龄',
            'last_menses_time' => '末次月经日期',
            'due_date' => '预产期',
            'current_month' => '当前怀孕月数',
            'current_week' => '当前怀孕周数',
        ];
    }
}
