<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comandes */

$this->title = 'Actualitzar Comanda: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comandes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualitzar';
?>
<div class="comandes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fromUser' => TRUE,
    ]) ?>

</div>
