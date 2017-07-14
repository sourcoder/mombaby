<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Userinfo;
use common\models\Food;
use backend\models\FoodForm;
use common\models\WechatUser;
use yii\web\NotFoundHttpException;
/**
 * Person controller
 */
class PersonController extends Controller
{
    public function actionIndex()
    {
        $model = new Food();
        $week_id = 1;
        $data = $model->find()->where(['week_id' => $week_id])->asArray()->all();
        var_dump($data);
        return $this->render('index');
    }
    
    public function actionFood($id)
    {
    /*    $model = new Food();
        $week_id = 1;
        $data = $model->find()
                      ->where(['week_id' => $week_id])
                      ->select(['id', 'week_id'])
                      ->asArray()->all();
        
        
        */
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
            $model->tall = $post['tall'];
            $model->weight = $post['weight'];
            $model->age = $post['age'];
            $model->last_menses_time = $post['last_menses_time'];
            
            $add = "+10 month +7 day";
            $model->due_date = date('Y-m-d',strtotime($add));
            
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
                return $this->redirect(['person/index']);
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



