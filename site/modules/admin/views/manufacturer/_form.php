<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Manufacturer */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="manufacturer-form">
    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


            <?= $form->field($model, 'img')
                ->widget(alexantr\elfinder\InputFile::class, [
                    'clientRoute' => 'manufacturer/input',
                    'filter' => ['image'],
                    'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div><img id="prev-img" src="'.Yii::getAlias('@manufacturer/'.$model->img).'" alt="">',
                    'buttonText'       => 'Выберите изображение',
                    'options'       => ['class' => 'form-control'],
                    'buttonOptions' => ['class' => 'btn btn-default'],
                ]) ?>

            <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

            <div class="form-group field-manufacturer-docfiles has-success">

                <?php
                $dataProvider = new ActiveDataProvider([
                    'query' => \app\models\ar\FileToManufacturer::find()->where(['manufacturer_id' => $model->id, 'type' => \app\models\ar\FileToManufacturer::TYPE_MANUFACTURER]),
                    'pagination' => [
                      'pageSize' => 100,
                    ],
                ]);

                ?>
                <?= GridView::widget([
                  'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
                  'layout'       => "{summary}{pager}\n{items}\n{pager}",
                    'dataProvider' => $dataProvider,
                    'columns' => [
                      ['class' => 'yii\grid\SerialColumn'],
                        [
                            'label' => 'Список сопутствующих файлов',
                            'attribute' => 'name',
                            'format' => 'raw',
                            'value' => function($m) {
                                return "<a href='/static/manufacturer/{$m->name}' target='_blank'>{$m->name}</a>";
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model, $key) {
                                    $url = Url::to(['/admin/manufacturer/delete-file', 'id' => $model->id]);
                                    $options = array_merge([
                                        'title' => 'Delete',
                                        'aria-label' => 'Delete',
                                        'data-pjax' => '0',
                                    ],  [
                                        'data-confirm' => Yii::t('app', 'Удалить файл?'),
                                        'data-method' => 'post',
                                    ]);
                                    $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-trash"]);
                                    return Html::a($icon, $url, $options);
                                },
                            ],
                        ],
                    ],
                ]); ?>


            </div>

            <?= $form->field($model, 'docFiles[]')->fileInput(['multiple' => true])->label('Добавьте файлы') ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>



</div>
    <style>
        #manufacturer-img {
            display: none;
        }
        #prev-img {
            width: 200px;
            padding-top: 15px;
        }
    </style>
<script>
    function afterInit() {
        $('#manufacturer-img').on('change', function (e) {
            $('#prev-img').attr('src', $('#manufacturer-img').val());
        });
    }
</script>

<?php $this->registerJs('afterInit()', \yii\web\View::POS_LOAD) ?>