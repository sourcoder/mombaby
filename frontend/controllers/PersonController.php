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
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if(!$model->save())
            {
                Yii::$app->session->setFlash('warning', "产生错误啦！");
            }
            else {
                Yii::$app->session->setFlash('success', "成功啦！");
                return $this->redirect(['person/index']);
            }
        }
        return $this->render('info', ["model" => $model]);
    }
}



