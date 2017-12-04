<style>   
.card {
/*    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);*/
    transition: 0.3s;
    border: solid #3e7a16;
    width: 20%;
    background-color: #fff;
    margin-left: 40px;
    margin-top: 10px;
    float: left;
/*    border-radius: 5px;*/
}
img{
  border-radius: 5px 5px 0 0;
  width:100%;
  height: 200px;
}
.haha{
  width:30%; 
}
.animasi{
    width: 100%;
    height: 50px;
    
    position: relative;
    -webkit-animation: myfirst 5s linear 2s infinite alternate; /* Chrome, Safari, Opera */
    animation: myfirst 5s linear 2s infinite alternate;
}

/* Chrome, Safari, Opera */
@-webkit-keyframes myfirst {
    0%   { left:0px; top:0px;}
    25%  { left:50px; top:0px;}
    50%  { left:50px; top:50px;}
    75%  { left:0px; top:50px;}
    100% { left:0px; top:0px;}
}

/* Standard syntax */
@keyframes myfirst {
    0%   { left:0px; top:0px;}
    25%  { left:50px; top:0px;}
    50%  { left:100px; top:100px;}
    75%  { left:0px; top:200px;}
    100% { left:100px; top:0px;}
}


</style>
<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\db\Query;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="item-index">

<h2 >Product</h2>
 <!-- <h1 align="center" class="animasi" style="color: green; background-color:lightblue; font-weight: bold;">Welcome To DropShop</h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<p style="margin-top: 20px">

<?php
    echo "SORTING:".$sort->link('name');
?>
<?php Pjax::begin(); ?>
      
  
       <?php 
       $dataProvider->pagination->pageSize = 4;
       $query = new Query();
       $image = $query->select(['*'])->from('item')->all();
       $customer = $query->select(['id_customer'])
                  ->from('customer')
                  ->where(['user_id'=>Yii::$app->User->getId()])->one()['id_customer'];
       
        foreach ($dataProvider->getModels() as $model) {
          echo '<div class="card">'.'';
            echo'<h3 align="center">'.$model->name.'</h3>'.'';
              echo Html::img(Url::to('@web/../../backend/web/'.$model->image)).'';          
              echo '<h4 align="center"><b>Rp.'.$model->price.',00</b></h4>';
              echo'<p align="center">Diskon 5%</p>';echo'<center>';

              echo (Html::a('<span class="glyphicon glyphicon-eye-open"></span>',['view','id'=>$model->id,'name'=>$model->name],['class'=>'circle btn btn-success']));



              echo (Html::a('<span  class="glyphicon glyphicon-shopping-cart"></span>',['order','id'=>$model->id,'id_customer'=>$customer,'name'=>$model->name],['class'=>'circle btn btn-warning'])); echo'</center>';
          echo'</div>';
          }
       ?>

<?php Pjax::end(); ?></div>
<center>
<?php echo \yii\widgets\LinkPager::widget([
          'pagination' => $dataProvider->pagination,
        ]);
       ?>
</center>