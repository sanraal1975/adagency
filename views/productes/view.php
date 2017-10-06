<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Productes */

$this->title = "Veure Producte";
$this->params['breadcrumbs'][] = ['label' => 'Productes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute'=>'categoria_fk', 'label'=>'Categoria'],
            'descripcio',
        ],
    ]) ?>

</div>
