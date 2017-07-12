<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\Object;
use common\models\Userinfo;
use yii\bootstrap\Alert;
/**
 * Person controller
 */
class PersonController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionFood()
    {
        return $this->render('food');
    }
    public function actionShop()
    {
        return $this->render('shop');
    }
    public function actionInfo()
    {
        $model = new Userinfo();
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate())
        {
            echo 'hah';
            $post = $post['Userinfo'];
            var_dump($post);
            $model->tall = $post['tall'];
            $model->weight = $post['weight'];
            $model->age = $post['age'];
            $model->last_menses_time = $post['last_menses_time'];
            
            $add = "+10 month +7 day";
            $model->due_date = date('Y-m-d',strtotime($add));
            
            $Date_List_a1=explode("-",$post['last_menses_time']);
            $d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
            $days = (time()-$d1)/3600/24;
            $model->current_month = ($days / 30)+1;
            $model->current_week = ($days / 7)+1;
            if(!$model->save())
            {
                echo "错误";
                Yii::$app->session->setFlash('warning', $model->_lastError);
            }
            else {
                return $this->redirect(['person/index']);
            }
        }else 
            echo "here ";
        return $this->render('info', ["model" => $model]);
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
}



