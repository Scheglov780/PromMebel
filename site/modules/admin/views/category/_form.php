<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ar\Category;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Category */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="category-form">

    <div class="box">
        <div class="box-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    <?php // if($model->id > 3 || is_null($model->id)) { ?>


    <?= $form->field($model, 'parent_id')->dropDownList(
        ArrayHelper::map($model->getWithoutSelfCategories(), 'id', 'name'),
        [
            //'prompt' => 'Без родительской категории',
            'class' => 'form-control select2'
        ]
    )?>
    <?php // } ?>
    <?= $form->field($model, 'status')->dropDownList(Category::$statusNames) ?>
    <?= $form->field($model, 'img')
        ->widget(alexantr\elfinder\InputFile::class, [
            'clientRoute' => 'category/input',
            'filter' => ['image'],
            'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div><img id="prev-img" src="'.Yii::getAlias('@cat/'.$model->img).'" alt="">',
            'buttonText'       => 'Выберите изображение',
            'options'       => ['class' => 'form-control'],
            'buttonOptions' => ['class' => 'btn btn-default'],
        ]) ?>
    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'price_from')->textInput(['type' => 'number'])  ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_short')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>





    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <a href="/admin/<?= Yii::$app->controller->id ?>/index" class="btn btn-danger">Отмена</a>
    </div>

    <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>
<style>
    #category-img {
        display: none;
    }
    #prev-img {
        width: 200px;
        padding-top: 15px;
    }
</style>
<script>
    function afterInit() {
        $('#category-img').on('change', function (e) {
            $('#prev-img').attr('src', $('#category-img').val());
        });
        $('.select2').select2();
    }
</script>

<?php $this->registerJs('afterInit()', \yii\web\View::POS_LOAD) ?>