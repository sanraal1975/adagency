<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comandes */

$this->title = 'Update Comandes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label'=>'Administrador', 'url'=>Yii::getalias('@web')."/admin/site"];
$this->params['breadcrumbs'][] = ['label' => 'Comandes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comandes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
