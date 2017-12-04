<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use common\models\Customer;
use yii\db\Query;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
        $query = new Query();
        $customer = $query->select(['*'])
                  ->from('customer')
                  ->where(['user_id'=>Yii::$app->User->getId()])->one()['id_customer'];

        $dataProvider->query = $customer; 

        // new ActiveDataProvider([
        //   'query' => $customer,
        // ]);

        // $dataProvider = new ActiveDataProvider([
        //   'query' => Customer::find()->where(['user_id'=>Yii::$app->User->getId()])->one(),
        // ]);

    ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
      
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_customer',
            'nama',
            'email:email',
            'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
