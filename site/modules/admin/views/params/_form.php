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
            <div class="box-body">

                <div class="box-body">

                    <div class="form-horizontal">
                        <div class="box-body">
                            <?php $form = ActiveForm::begin(); ?>

                            <?= $form->field($model, 'main_domain')->dropDownList(
                            //ArrayHelper::map(\app\models\ar\Category::find()->all(), 'id', 'name'),
                                ArrayHelper::map(\app\models\ar\City::find()->all(), 'id', 'name'),
                                [
                                    'class' => 'form-control select2'
                                ]
                            )?>

                            <?= $form->field($model, 'popup_banner_link')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'popup_banner')
                                ->widget(alexantr\elfinder\InputFile::class, [
                                    'clientRoute' => 'default/input',
                                    'filter' => ['image'],
                                    'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div><img id="prev-img" src="'.Yii::getAlias('@web/'.$model->popup_banner).'" alt="">',
                                    'buttonText'       => 'Выберите изображение',
                                    'options'       => ['class' => 'form-control'],
                                    'buttonOptions' => ['class' => 'btn btn-default'],
                                ]) ?>

                            <?= $form->field($model, 'popup_banner_link_2')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'popup_banner_2')
                                ->widget(alexantr\elfinder\InputFile::class, [
                                    'clientRoute' => 'default/input',
                                    'filter' => ['image'],
                                    'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div><img id="prev-img-2" src="'.Yii::getAlias('@web/'.$model->popup_banner_2).'" alt="">',
                                    'buttonText'       => 'Выберите изображение',
                                    'options'       => ['class' => 'form-control'],
                                    'buttonOptions' => ['class' => 'btn btn-default'],
                                ]) ?>

                            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'meta_title_main')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'meta_desc_main')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'meta_keywords_main')->textInput(['maxlength' => true])->label('Meta keywords главной страницы') ?>

                            <!--    --><?/*= $form->field($model, 'data')->textarea(['rows' => 6]) */?>

                            <div class="form-group">
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #params-popup_banner {
        display: none;
    }
    #params-popup_banner_2 {
        display: none;
    }
    #prev-img {
        width: 200px;
        padding-top: 15px;
    }
    #prev-img-2 {
        width: 200px;
        padding-top: 15px;
    }
</style>
<?php $this->registerJs('$(\'.select2\').select2();', \yii\web\View::POS_LOAD) ?>
<?php $this->registerJs("        
    $('#params-popup_banner').on('change', function (e) {
        $('#prev-img').attr('src', $('#params-popup_banner').val());
    }); 
    $('#params-popup_banner_2').on('change', function (e) {
        $('#prev-img-2').attr('src', $('#params-popup_banner_2').val());
    });
", \yii\web\View::POS_LOAD) ?>
