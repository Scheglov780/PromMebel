<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ar\BaseAR */
/* @var $modelName string */
/* @var $update bool */

$this->title = $update ? "Обновление $modelName: " . $model->name : "Создание нового $modelName";
$this->params['breadcrumbs'][] = ['label' => $modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="update">
    <div class="form-group">
        <div class="btn btn-success" id="same-save">Сохранить</div>
        <a href="/admin/<?= Yii::$app->controller->id.'/index';?>" class="btn btn-danger">Отмена</a>
    </div>
    <?= $this->render('/'.Yii::$app->controller->id.'/_form', [
        'model' => $model,
    ]) ?>
</div>
<script>
    function saveBtn() {
        $('#same-save').on('click', function (e) {
            $('form').submit();
        });
    }
</script>

<?php $this->registerJs('saveBtn()', \yii\web\View::POS_LOAD) ?>
