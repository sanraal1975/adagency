<?php

use yii\helpers\Html;
use yii\helpers\URL;

use yii\widgets\DetailView;
use yii\grid\GridView;
use app\components\Debug;


/* @var $this yii\web\View */
/* @var $model app\models\Comandes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comandes', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Veure comanda";
?>
<div class="comandes-view">

    <h1><?= Html::encode("Comanda ".$this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'data',
            'estat_fk',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $linies,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'producte_fk',
            'quantitat_solicitada',
            'quantitat_servida',

            ['class' => 'yii\grid\ActionColumn', 
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function($model,$key,$index){
                        return HTML::a('<span class="glyphicon glyphicon-pencil"></span>',Yii::getalias('@web').'/linies-comandes/update?id='.$key->id);
                    },
                    'delete' => function($model,$key,$index){
                        return HTML::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['/linies-comandes/delete', "id"=>$key->id],
                            ['data' => [
                                'confirm' => "Segur que vols eliminar aquest producte?",
                                'method'=>'post',
                                ]
                            ]
                        );

                    }
                ],
            ],
        ],
    ]); ?>

    <p>
        <?= Html::a('Afegir Producte', ['/linies-comandes/create?id='.$model->id], ['class' => 'btn btn-success']) ?>
    </p>


</div>
