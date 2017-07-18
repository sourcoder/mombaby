<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Userinfo;
use common\models\Food;
use backend\models\FoodForm;
use common\models\WechatUser;
use yii\web\NotFoundHttpException;
use common\models\WeekNutrition;
use yii\base\Object;

/**
 * Person controller
 */
class PersonController extends Controller
{
    public function actionIndex($id)
    {
        $food = new Food();
        $week_id = $this->updateCurrentWeek($id);
        $foods = $food->find()->where(['week_id' => $week_id])->asArray()->all();
        //根据ID拿到标签
        $model = new FoodForm();
        $data = [];
        foreach ($foods as $food)
        {
            $data[] = $model->getViewById($food['id']);
        }
        $foods = $data;
        $user = new WechatUser();
        $userinfo = $user->find()->where(['id' => $id])->asArray()->one();
        $nu = new WeekNutrition();
        $nuinfo = $nu->find()->where(['week' => $week_id])->asArray()->one();
        return $this->render('index', ['foods'=> $foods, 'userinfo'=>$userinfo, 'nuinfo'=>$nuinfo]);
    }
    /**
     * 更新当前怀孕周数和月数，并返回当前周
     * @param unknown $id
     */
    private function updateCurrentWeek($id)
    {
     
        $model = WechatUser::findOne($id);
        $model->setScenario(WechatUser::SCENARIOS_UPDATE_CURRENT_WEEK);
        $Date_List_a1=explode("-",$model->last_menses_time);
        $d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
        $days = (time()-$d1)/3600/24;
        $model->current_month = intval( ($days / 30)+1 );
        $model->current_week = intval( ($days / 7)+1);
        if(!$model->save())
        {
            var_dump($model->errors);
            echo 'dkajd';exit();
            Yii::$app->session->setFlash('warning', "信息更新失败了……");
        }
        else
        {
            return $model->current_week;
        }
        
    }
    public function actionFood($id)
    {
        $model = new FoodForm();
        $data = $model->getViewById($id);
        //var_dump($data);
        return $this->render('food', ['data' => $data]);
    }
    public function actionShop()
    {
        return $this->render('shop');
    }
    public function actionInfo($id)
    {
        $model = $this->findModel($id);
        $model->setScenario(WechatUser::SCENARIOS_SAVE_ADVANCED_INFO);
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate())
        {
            //print_r($post);exit();
            $post = $post['WechatUser'];
        //    $model->tall = $post['tall'];
         //   $model->weight = $post['weight'];
            $model->age = $post['age'];
            $model->last_menses_time = $post['last_menses_time'];
            $add = "+10 month +7 day";
            $model->due_date = date('Y-m-d',strtotime($add, strtotime($model->last_menses_time)));
            $Date_List_a1=explode("-",$post['last_menses_time']);
            $d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
            $days = (time()-$d1)/3600/24;
            $model->current_month = intval( ($days / 30)+1 );
            $model->current_week = intval( ($days / 7)+1);
            if(!$model->save())
            {
                Yii::$app->session->setFlash('warning', "信息保存失败了……");
            }
            else {
                return $this->redirect(['person/index', 'id'=>$id]);
            }
        }
        return $this->render('info', ["model" => $model,]);
    }
    public function actionSave()
    {
        $model = new Userinfo();
        $post = \Yii::$app->request->post();
        if(!$model->saveInfo($post))
        {
            Yii::$app->session->setFlash('warning', "产生错误啦！");
        }
        else {
            Yii::$app->session->setFlash('success', "成功啦！");
            return $this->redirect(['person/index']);
        }
    }
    
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WechatUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}



