<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ar\City */
/* @var $modelName string */
/* @var $update bool */

$this->title = $update ? "Обновление $modelName: " . $model->name : "Создание нового $modelName";
$this->params['breadcrumbs'][] = ['label' => $modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
