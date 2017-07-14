<?php

namespace frontend\controllers;

use Yii;
use common\models\Food;
use backend\models\FoodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\FoodForm;
use yii\filters\AccessControl;
/**
 * FoodController implements the CRUD actions for Food model.
 */
class FoodController extends Controller
{
    
   /* 
    public $enableCookieValidation = false;
    
    */
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        //upload都是用post请求
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'upload', 'uediter','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'upload', 'uediter','update','delete'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get', 'post'],
                    'create' => ['get','post'],
                ],
            ],
        ];
    }
    /**
     * 此方法相当于actionUpload  actionUediter
     * @see \yii\base\Controller::actions()
     */
    public $enableCsrfValidation = false;
    public function actions()
    {
        return [
            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],
            'ueditor'=>[
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config'=>[
                    //上传图片配置
                    'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ],
        ];
    }
    
    /**
     * Lists all Food models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FoodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Food model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Food model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->enableCsrfValidation = false;
        $model = new FoodForm();
        //定义场景
        $model->setScenario(FoodForm::SCENARIOS_CREATE);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if(!$model->create())
			{
				Yii::$app->session->setFlash('warning', $model->_lastError);
			}
			else {
				return $this->redirect(['food/view', 'id' => $model->id]);
			}
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Food model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Food model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Food model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Food the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Food::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    /*******************here test wechat****************************/
    public function actionCode()
    {
    
        $redirect_uri = Yii::$app->params['wechat']['redirect_uri'];
        $redirect_uri = urlencode($redirect_uri);
        $appid = Yii::$app->params['wechat']['appid'];
        $appsecret = Yii::$app->params['wechat']['appsecret'];
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=
        code&scope=snsapi_userinfo&state=1#wechat_redirect";
        $this->redirect($url);
    }
    public function actionUser()
    {
        
        $code = $_GET["code"];
        if($code == '2')
        {
            $redirect_uri = Yii::$app->params['wechat']['redirect_uri'];
            $redirect_uri = urlencode($redirect_uri);
            $appid = Yii::$app->params['wechat']['appid'];
            $appsecret = Yii::$app->params['wechat']['appsecret'];
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
            $this->redirect($url);
        }else
        {
            $state = $_GET["state"];
            $access_token = $this->getAccesstoken($code, $state);
            //检验授权凭证（access_token）是否有效
            $data = $this->checkAvail($access_token['access_token'],$access_token['openid']);
            if($data['errcode'] != '0' || $data['errmsg'] != 'ok')
            {
                //刷新access_token
                $access_token = $this->refresh_access_token($access_token['refresh_token']);
            }
            //得到拉取用户信息(需scope为 snsapi_userinfo)
            $userinfo = $this->get_user_info($access_token['access_token'],$access_token['openid']);
            //require 'view/index.html';//-------1------这里根据具体情况去修改
            /**************************************************/
            var_dump($userinfo);
            echo "昵称:".$userinfo['nickname'];
            echo "<br/>";
            echo "性别:".$userinfo['sex']; echo "<br/>";
            echo "国家:".$userinfo['country']; echo "<br/>";
            echo "省份:".$userinfo['province']; echo "<br/>";
            echo "城市:".$userinfo['city']; echo "<br/>";
          //  echo "特权:".$userinfo['privilege'];  echo "<br/>";
            echo "----------头像--------------" ;echo "<br/>";
            echo  '<img src="'.$userinfo['headimgurl'].'" />'; 
        }
    }
    /*
     * 第二步：由code得到access_token
     */
    public function getAccesstoken($code, $state) 
    {
        $appid = Yii::$app->params['wechat']['appid'];
        $appsecret = Yii::$app->params['wechat']['appsecret'];
        $request_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
        $access_token = $this->https_request($request_url);
        $arr = json_decode($access_token,true);
        return $arr;
    }
    /*
     *
     *  刷新access_token（如果需要）
     *
     * */
    private function refresh_access_token($refresh_token)
    {
        //三步：刷新access_token（如果需要）
        $refresh_url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=".$this->appid."&grant_type=refresh_token&refresh_token={$refresh_token}";
        $access_token = $this->https_request($refresh_url);
        return json_decode($access_token,true);
    }
    
    public function https_request($url,$data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data))
        {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        if(curl_errno($curl)) {return 'ERROR '.curl_error($curl);}
        curl_close($curl);
        return $output;
    }
    /**
     *检验授权凭证（access_token）是否有效
     * @param string $access_token
     * @param string $open_id
     **/
    private function checkAvail($access_token='',$openid='')
    {
        if($access_token && $openid)
        {
            $avail_url = "https://api.weixin.qq.com/sns/auth?access_token={$access_token}&openid={$openid}";
            $avail_data = $this->https_request($avail_url);
            return json_decode($avail_data, TRUE);
        }
        return FALSE;
    }
    /**
     * 获取授权后的微信用户信息
     *oauth2.0
     * @param string $access_token
     * @param string $open_id
     **/
    public function get_user_info($access_token = '', $open_id = '')
    {
        // 第四步：拉取用户信息(需scope为 snsapi_userinfo)
        if($access_token && $open_id)
        {
            $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
            $info_data = $this->https_request($info_url);
            return json_decode($info_data, TRUE);
        }
        return FALSE;
    }
}
