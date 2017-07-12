<?php
/*
*@author : DELL
*@time : 2016年11月6日
*标签表单模型
*/
namespace backend\models;

use yii\base\Model;
use common\models\Tags;
use Yii;
class TagForm extends Model
{
	public $id;
	
	public $tags;
	
	public function rules()
	{
		return [
				['tags', 'required'],
				['tags', 'each', 'rules' => ['string'], ],
		];
	}
	
	 /**
	  * 保存标签
	  */
	public function saveTags()
	{
		$ids = [];
		if (!empty($this->tags))
		{
			$this->tags = explode(",", $this->tags);
			foreach ($this->tags as $tags)
			{
				$ids[] = $this->_saveTag($tags);
			}
		}
		return $ids;
	}
	 
	 /*
	  * 保存单个标签
	  */
	private function _saveTag($tag)
	{
		$model = new Tags();
		$res = $model->find()->where(['tag_name' => $tag])->one();
		//新建标签
		if (!$res){
			$model->tag_name = $tag;
			if(!$model->save()){
				throw new \Exception('保存标签失败');
			}
			return $model->id;
		}
		return $res->id;
	}
}
	

	

	

	
