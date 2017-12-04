<?php

namespace frontend\controllers;

use Yii;
use common\models\Item;
use common\models\ItemSearch;
use common\models\Order;
use common\models\OrderItem;
use common\models\Customer;
use yii\web\Controller;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access'=> [
                'class' => AccessControl::className(),
                'rules' =>[
                    [
                        'actions' => ['index','contact','about','captcha','error'],
                        'allow' => true,
                        'roles' => ['?','@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','login','signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout','view','order','favorite'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Item models.
     * @return mixed
     */

    public function actionOrder($id,$id_customer){
           
        $query = new Query();
        $order = new Order();
        $order->date = date("Y-m-d");
        $order->customer_id = $id_customer;
        $order->save();

        $idOrder = $query->select(['id_order'])->from('order')
                    ->orderBy('id_order DESC')
                    ->one()['id_order'];

        $oItem = new OrderItem();
        $oItem->order_id = $idOrder;
        $oItem->item_id = $id;
        $oItem->save();

        return $this->redirect('@web/item/index');
    }


    public function actionIndex()
    {
        //PAGINATION
        $query = Item::find();
        $pages = new \yii\data\Pagination([
                'totalCount' => $query->count(),
                'pageSize' => 5,
            ]);
                $sort = new \yii\data\Sort([
                'attributes'=>['name']
            ]);

        $models = Item::find()
                    ->orderBy($sort->orders)
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();

        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //SORTING

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'models' => $models,
            'pages' =>$pages,
            'sort' => $sort,
        ]);
    }

    /**
     * Displays a single Item model.
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
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Item();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
   /* public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
