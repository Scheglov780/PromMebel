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
    <div class="box">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'img')
                ->widget(alexantr\elfinder\InputFile::class, [
                    'clientRoute' => 'news/input',
                    'filter' => ['image'],
                    'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div><img id="prev-img" src="'.Yii::getAlias('@news/'.$model->img).'" alt="">',
                    'buttonText'       => 'Выберите изображение',
                    'options'       => ['class' => 'form-control'],
                    'buttonOptions' => ['class' => 'btn btn-default'],
                ]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 12, 'id' => 'ckeditor_desc']) ?>

            <?= $form->field($model, 'publish')->dropDownList(News::$statusNames) ?>

            <?= $form->field($model, 'created_at')->widget(\yii\jui\DatePicker::class, [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
                'options' => [
                    'class' => 'form-control'
                ]
            ]) ?>


            <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

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
<script>
    function afterInit() {
        $('#news-img').on('change', function (e) {
            $('#prev-img').attr('src', $('#news-img').val());
        });
        $('.select2').select2();
    }
</script>

<?php $this->registerJs('afterInit()', \yii\web\View::POS_LOAD) ?>
