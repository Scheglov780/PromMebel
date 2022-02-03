<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ar\ProductPackages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-packages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(\app\models\ar\ProductPackages::$typeNames) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'products')->dropDownList(
        ArrayHelper::map(\app\models\ar\Product::find()->all(), 'id', 'name'),
        [
            'class' => 'form-control select2',
            'multiple' => 'multiple'
        ]
    )->label('Товары пакета') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    <script>
        function afterInit() {
            $('.select2').select2();
        }
    </script>

<?php $this->registerJs('afterInit()', \yii\web\View::POS_LOAD) ?>