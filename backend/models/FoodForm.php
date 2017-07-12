<?php
namespace backend\models;

use Yii;
use common\models\Food;
use yii\db\Query;
use common\models\RelationFoodTag;
use yii\base\Model;
/*
 * Food表单模型
 */

class FoodForm extends Model
{
	public $id;
	public $title;
	public $detail;
	public $image;
	public $week_id;
	public $tags;
	
	public $_lastError = "";
	/*
	 * 创建场景
	 * SCENARIOS_CREATE  创建
	 * SCENARIOS_UPDATE  更新
	 */
	const SCENARIOS_CREATE = 'create';
	const SCENARIOS_UPDATE = 'update';
	const EVENT_AFTER_CREATE = 'eventAfterCreate';
	const EVENT_AFTER_UPDATE = 'eventAfterUpdate';
	/*
	 * 场景设置
	 */
	public function scenarios()
	{
		$scenarios = [
			self::SCENARIOS_CREATE	 => ['title', 'detail', 'image', 'week_id', 'tags'],
		    self::SCENARIOS_CREATE	 => ['title', 'detail', 'image', 'week_id', 'tags'],
		];
		return array_merge(parent::scenarios(),$scenarios);
	}
	public function rules()
	{
		return [
			//	['id', 'required'],
				['title', 'required'],
				['detail', 'required'],
				['week_id', 'required'],
				[['id', 'week_id'], 'integer'],
		];
	}
	
	public function attributeLabels()
	{
		return [
				'id' => '编码',
				'title' => '菜名',
				'detail' => '详细步骤',
				'image' => '图片',
				'week_id' => '合适的周数',
				'tags' => '标签',
		];
	}
	/*
	 * 文章创建
	 */
	public function create()
	{
		//事务,涉及到多张表，若程序中断可能导致对应元素的不完整性，所以这里要用事务
		$transation = Yii::$app->db->beginTransaction();
		try {
			$model = new Food();
			echo 'jajj';
			var_dump($this->attributes);
			//$model->setAttributes($this->attributes);
			$model->title = $this->title;
			$model->detail = $this->detail;
			$model->image = $this->image;
			$model->week_id = $this->week_id + 1;
			$model->image = 'dddd';
			echo 'dsd';
			if(!$model->save())
			{
				throw new \Exception('食物保存失败');
			}
			$this->id = $model->id;
			//调用事件
			$data = array_merge($this->getAttributes(), $model->getAttributes());
			$this->_eventAfterCreate($data);
			$transation->commit();
			return true;
		}catch (\Exception $e)
		{
			$transation->rollBack();
			$this->_lastError = $e->getMessage();
			return false;
		}
	}
	/**
	 * 得到文章的数据
	 * @param unknown $id
	 */
/*	public function getViewById($id)
	{
		//with是关联查询
		$res = Food::find()->with('relate.tag','extend')->where(['id' => $id])->asArray()->one();
		if(!$res)
		{
			throw new \Exception("文章不存在！");
		}
		
		
		if(isset($res['relate']) && !empty($res['relate']))
		{
			$res['tags'] = [];
			foreach ($res['relate'] as $list)
			{
				$res['tags'][] = $list['tag']['tag_name'];
			}
		}
		unset($res['relate']);
		return $res; 
	}
*/
	/*
	 * Food创建完成后调用事件
	 */
	public function _eventAfterCreate($data)
	{
		//添加事件，标签
		$this->on(self::EVENT_AFTER_CREATE, [$this, '_eventAddTag'], $data);
		//触发事件
		$this->trigger(self::EVENT_AFTER_CREATE);
		
	}
	 /**
	  * 添加标签事件
	  * @param unknown $event
	  * @throws \Exception
	  */
	 public function _eventAddTag($event)
	 {
	 	//保存标签
	 	$tag = new TagForm();
	 	$tag->tags = $event->data['tags'];//这里将tags数据扔给TagForm里的tags
	 	$tagids = $tag->saveTags();
	 	
	 	//删除原先关联
	 	RelationFoodTag::deleteAll(['food_id' => $event->data['id']]);
	 	
	 	//批量保存文章和标签的关系
	 	if (!empty($tagids))
	 	{
	 		foreach ($tagids as $k => $id)
	 		{
	 			$row[$k]['food_id'] = $this->id;
	 			$row[$k]['tag_id'] = $id;
	 		}
	 		//批量保存
	 		$res = (new Query())->createCommand()
	 			->batchInsert(RelationFoodTag::tableName(), ['food_id', 'tag_id'], $row)
	 			->execute();
	 		if(!$res)
	 		{
	 			throw new \Exception('保存标签失败');
	 		}
	 		
	 	}
	 }
	 
/*	 public static function getList($cond, $curPage = 1, $pageSize = 5, $orderBy = ['id' => SORT_DESC])
	 {
	 	$model = new Food();
	 	//查询语句
	 	$select = ['id', 'title', 'image', 'week_id'];
	 	$query = $model->find()
	 	->select($select)
	 	->where($cond)
	 	->with('relate.tag', 'extend')
	 	->orderBy($orderBy);
	 	//获取分页数据
	 	$res = $model->getPages($query, $curPage, $pageSize);
	 	//格式化数据
	 	$res['data'] = self::_formatList($res['data']);
	 	return $res;
	 }
	 */
	 /**
	  * 数据格式化--标签
	  * @param unknown $data
	  */
	 /*
	 public static function _formatList($data)
	 {
	 	foreach ($data as &$list)//这里加上&的的原因在于让$list的改变可以直接引起$data的改变
	 	{
	 		$list['tags'] = [];
	 		if (isset($list['relate']) && !empty($list['relate']))
	 		{
	 			foreach ($list['relate'] as $lt)
	 			{
	 				$list['tags'][] = $lt['tag']['tag_name'];
	 			}
	 		}
	 		unset($list['relate']);
	 	}
	 	return $data;
	 }
	 */
	 
}





