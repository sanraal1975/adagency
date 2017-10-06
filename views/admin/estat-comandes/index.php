<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estat Comandes';
$this->params['breadcrumbs'][] = ['label'=>'Administrador', 'url'=>Yii::getalias('@web')."/admin/site"];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estat-comandes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Estat Comandes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'descripcio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
