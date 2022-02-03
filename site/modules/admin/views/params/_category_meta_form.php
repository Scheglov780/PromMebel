<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Params */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="row">

    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                Стандартные метатеги для категорий
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'meta_title_category')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'meta_desc_category')->textInput(['maxlength' => true]) ?>

                <!--    --><?/*= $form->field($model, 'data')->textarea(['rows' => 6]) */?>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить мета', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>