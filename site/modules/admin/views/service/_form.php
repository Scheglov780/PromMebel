<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ar\News;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ar\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')
        ->widget(alexantr\elfinder\InputFile::class, [
            'clientRoute' => 'service/input',
            'filter' => ['image'],
            'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div><img id="prev-img" src="'.Yii::getAlias('@service/'.$model->img).'" alt="">',
            'buttonText'       => 'Выберите изображение',
            'options'       => ['class' => 'form-control'],
            'buttonOptions' => ['class' => 'btn btn-default'],
        ]) ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
    #service-img {
        display: none;
    }
    #prev-img {
        width: 200px;
        padding-top: 15px;
    }
</style>
<script>
    function afterInit() {
        $('#service-img').on('change', function (e) {
            $('#prev-img').attr('src', $('#service-img').val());
        });
    }
</script>

<?php $this->registerJs('afterInit()', \yii\web\View::POS_LOAD) ?>
