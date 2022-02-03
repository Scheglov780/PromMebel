<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ar\News;
use app\models\ar\Page;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 12, 'id' => 'ckeditor_desc']) ?>

            <?= $form->field($model, 'publish')->dropDownList(News::$statusNames) ?>


            <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>
			
            <?= $form->field($model, 'footercolumn')->dropDownList(Page::$statusMenu) ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>

    <script>
        function initCkeditor() {
            CKEDITOR.replace( 'ckeditor_desc' , {
                filebrowserUploadUrl: '/admin/news/upload-image',
                height: 700
            });
        }
    </script>
<?php $this->registerJs('initCkeditor()', \yii\web\View::POS_LOAD) ?>
<?php $this->registerJsFile('/js/ckeditor/ckeditor.js') ?>

<style>
    #news-img {
        display: none;
    }
    #prev-img {
        width: 200px;
        padding-top: 15px;
    }
</style>

