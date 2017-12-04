<center>
<style>
    img{
        width: 30%;
        height:300px;
    }
</style>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Item */

$this->title = $model->name;
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>
<?php
echo(Html::img(Url::to('@web/../../backend/web/'.$model->image)));
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'price',
        ],
        
    ]) ?>


</div>
</center>