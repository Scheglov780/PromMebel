<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'img')
        ->widget(alexantr\elfinder\InputFile::class, [
            'clientRoute' => 'slider/input',
            'filter' => ['image'],
            'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div><img id="prev-img" src="'.Yii::getAlias('@slider/'.$model->img).'" alt="">',
            'buttonText'       => 'Выберите изображение',
            'options'       => ['class' => 'form-control'],
            'buttonOptions' => ['class' => 'btn btn-default'],
        ]) ?>

    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
    #slider-img {
        display: none;
    }
    #prev-img {
        width: 200px;
        padding-top: 15px;
    }
</style>
<script>
    function afterInit() {
        $('#slider-img').on('change', function (e) {
            $('#prev-img').attr('src', $('#slider-img').val());
        });
        $('.select2').select2();
    }
</script>

<?php $this->registerJs('afterInit()', \yii\web\View::POS_LOAD) ?>