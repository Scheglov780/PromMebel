<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ar\City */
/* @var $modelName string */
/* @var $update bool */

$this->title = "Основные параметры сайта";
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="city-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
