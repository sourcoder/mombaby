<?php

namespace backend\controllers;

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
    
    public $enableCsrfValidation = false;
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
			    echo 'hello';
			    
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
}
