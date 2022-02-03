<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ar\Product;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Product */
/* @var $form yii\widgets\ActiveForm */

$update = Yii::$app->controller->action->id == 'update';
$id = $update ? 'product'.$model->id : 'create';
$propValue = ArrayHelper::map($model->propertyValue, 'property_id', 'value');
$allProducts = Product::getAll();
/** @var Product[]|array $allSeries Все серии товаров */
$allSeries = Product::getAll(['type' => Product::TYPE_SERIES]);
$recommendedPackages = \app\models\ar\ProductPackages::getRecommendedPackages();
$relatedPackages = \app\models\ar\ProductPackages::getRelatedPackages();
$this->registerJsVar('recommendedPackages', $recommendedPackages);
$this->registerJsVar('relatedPackages', $relatedPackages);

$propertiesArray = [];
/** @var $properties \app\models\ar\Property[] */
$properties = \app\models\ar\Property::find()->orderBy('type')->all();
foreach ($properties as $property) {
    $propertiesArray[$property->type][] = $property;
}

?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['id' => 'product-form']); ?>
    <div class="col-md-6 ">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    Основные параметры
                </div>
            </div>
            <div class="box-body">

                <?= $form->field($model, 'type')->hiddenInput(['value' => Product::TYPE_SERIES])->label(false)  ?>

                <?= $form->field($model, 'category_id')->dropDownList(
                //ArrayHelper::map(\app\models\ar\Category::find()->all(), 'id', 'name'),
                  ArrayHelper::map(\app\models\ar\Category::getCategoriesWithoutChild(false,true), 'id', 'name'),
                  [
                    'class' => 'form-control select2',
                  ]
                ) ?>
                <?= $form->field($model, 'brand_id')->dropDownList(
                    ArrayHelper::map(\app\models\ar\Brand::find()->all(), 'id', 'name'),
                    [
                        'prompt' => 'Без бренда',
                        'class' => 'form-control select2'
                    ]
                )?>
                <?= $form->field($model, 'manufacturer_id')->dropDownList(
                  ArrayHelper::map(\app\models\ar\Manufacturer::find()->all(), 'id', 'name'),
                  [
                    'prompt' => 'Без производителя',
                    'class' => 'form-control select2'
                  ]
                )?>
                <?= $form->field($model, 'video')->textInput(['maxlength' => true])  ?>
                <?= $form->field($model, 'img')
                    ->widget(app\widgets\InputFile::class, [
                        'clientRoute'   => 'product/input',
                        'hash'      => $update ? Yii::$app->controller->hashGen("product\\".$model->slug) : 'l1_dG1w' ,
                        'multiple'      => true,
                        'template'      => '<div class="form-group field-product-imgs">{input}<span class="input-group-btn">{button}</span></div><div class="imgs-cont"></div>',
                        'buttonText'       => 'Выберите изображение',
                        'options'       => ['class' => 'form-control img-input', 'id' => $id],
                        'buttonOptions' => ['class' => 'btn btn-default'],
                    ]) ?>
                <div class="form-group">
                    <ul id="sortable">
                        <?php foreach($model->getProductImgs()->orderBy('order')->all() as $img) { ?>
                            <li class="ui-state-default" data-id="<?= $img->id ?>" style="background-image: url('<?= Yii::getAlias('@web/static/product/upl/'.$img->name) ?>')">
                                <i class="delete fa fa-trash"></i>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <?= $form->field($model, 'alt')->textInput(['maxlength' => true])  ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description_short')->textInput(['maxlength' => true])  ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>

                <?= $form->field($model, 'price_eur')->textInput(['type' => 'number']) ?>

                <?= $form->field($model, 'price_gbp')->textInput(['type' => 'number']) ?>

                <?= $form->field($model, 'status')->dropDownList(Product::$statusNames) ?>

                <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

                <?= $form->field($model, 'meta_title')->textInput()  ?>

                <?= $form->field($model, 'meta_description')->textInput()  ?>

                <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'construct_link')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    <a href="/admin/<?= Yii::$app->controller->id ?>/index" class="btn btn-danger" id="back">Отмена</a>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    Свойства товаров
                </div>
            </div>
            <div class="box-body">

                <div class="form-horizontal">
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <?php foreach (\app\models\ar\Property::getTypes() as $k => $type) { ?>
                                    <li <?php if($k == 0) echo 'class="active"' ?>><a href="#tab_<?= $type ?>" data-toggle="tab"><?= empty($type) ? 'Без группы' : $type  ?></a></li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <?php foreach ($propertiesArray as $type => $properties) { ?>
                                    <div class="tab-pane <?php if($type == \app\models\ar\Property::getTypes()[0]) echo 'active' ?>" id="tab_<?= $type ?>">
                                        <?php foreach ($properties as $prop) { ?>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"><?= $prop->name ?></label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="Product[properties][<?= $prop->id ?>]" placeholder="<?= $prop->value_name ?>"
                                                           value="<?= @$propValue[$prop->id] ?>">
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    Рекомендованные товары
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?= Html::dropDownList('recommendedPackages', null, ArrayHelper::map($recommendedPackages, 'id', 'name'), [
                        'prompt' => 'Добавьте товары пакетно',
                        'class' => 'form-control select2',
                        'id' => 'recommendedPackagesSelect'
                    ]) ?>
                </div>
                <?= $form->field($model, 'recommendedProducts')->dropDownList(
                    ArrayHelper::map($allProducts, 'id', 'name'),
                    [
                        'class' => 'form-control select2',
                        'multiple' => 'multiple'
                    ]
                )->label('Товары пакета') ?>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    Сопутствующие товары
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?= Html::dropDownList('relatedPackages', null, ArrayHelper::map($relatedPackages, 'id', 'name'), [
                        'prompt' => 'Добавьте товары пакетно',
                        'class' => 'form-control select2',
                        'id' => 'relatedPackagesSelect'
                    ]) ?>
                </div>
                <?= $form->field($model, 'relatedProducts')->dropDownList(
                    ArrayHelper::map(array_merge($allSeries,$allProducts), 'id', 'name'),
                    [
                        'class' => 'form-control select2',
                        'multiple' => 'multiple'
                    ]
                )->label('Товары пакета') ?>

            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    Основа серии
                </div>
            </div>
            <div class="box-body">
                <?= $form->field($model, 'tables')->dropDownList(
                    ArrayHelper::map($allProducts, 'id', 'name'),
                    [
                        'class' => 'form-control select2',
                        'multiple' => 'multiple'
                    ]
                )->label('Товары пакета') ?>

            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    Список сопутствующих файлов
                </div>
            </div>
            <div class="box-body">
                <div class="form-group field-brand-docfiles has-success">
                    <?php
                    //@todo добавить потом файлы производителя
                    $dataProvider = new ActiveDataProvider([
                        'query' => \app\models\ar\FileToBrand::find()->where(['brand_id' => $model->id, 'type' =>
                          \app\models\ar\FileToBrand::TYPE_PRODUCT]),
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
                                'label' => 'Файлы',
                                'attribute' => 'name',
                                'format' => 'raw',
                                'value' => function($m) {
                                    return "<a href='/static/product/{$m->name}' target='_blank'>{$m->name}</a>";
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{delete}',
                                'buttons' => [
                                    'delete' => function ($url, $model, $key) {
                                        $url = Url::to(['/admin/product/delete-file', 'id' => $model->id]);
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

                    <?= $form->field($model, 'docFiles[]')->fileInput(['multiple' => true])->label('Добавьте файлы') ?>

                </div>


            </div>
        </div>


    </div>
    <?php ActiveForm::end(); ?>

</div>
    <div class="clearfix"></div>
<style>
    .img-input {
        display: none;
    }
    #sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 100%;
    }
    #sortable li {
        margin: 3px 3px 3px 0;
        padding: 1px; float: left;
        width: 200px;
        height: 180px;
        font-size: 4em;
        text-align: center;
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
        position: relative;
    }
    i.delete  {
        position: absolute;
        top: 10px;
        right: 10px;

        width: 20px;
        box-sizing: content-box;
        font-size: 22px;
        border: 1px solid #fff;
        padding: 5px;
        border-radius: 3px;
        background: #eeeeee;
        cursor: pointer;
        transition: 0.1s;
    }
    i.delete:hover {
        color: red;
        background: #cccccc;
    }
</style>
<script>

    function afterInit() {
        var sortable = $("#sortable");
        sortable.sortable({
            revert: true
        });
        sortable.disableSelection();

        var imgInput = $('input[name="Product[img]"]');
        if(imgInput.val() !== undefined && imgInput.val() !== '') {
            var arrayOfStrings = imgInput.val().split(',');
            $.each(arrayOfStrings, function (index, el) {
                sortable.append('<li class="ui-state-default" data-id="' + el +'" style="background-image: url('+el+')"><i class="delete fa fa-trash"></i></li>')
            });
        }
        imgInput.on('change', function (e) {
            var arrayOfStrings = $('input[name="Product[img]"]').val().split(',');
            $.each(arrayOfStrings, function (index, el) {
                if(el === '') return;
                if($('.ui-state-default[data-id="'+el+'"]').length == 0) {
                    sortable.append('<li class="ui-state-default" data-id="' + el +'" style="background-image: url('+el+')"><i class="delete fa fa-trash"></i></li>')
                }
            });
        });

        $('#product-form').on('beforeSubmit', function (e) {
            var items = sortable.sortable( "toArray", {'attribute' : 'data-id'});
            $.each(items, function (index, el) {
                $('#product-form').append('<input type="hidden" name="Product[imges][]" value="'+el+'">')
            });


            return true;
        });

        sortable.on('click', 'i.delete',function () {
            var oldStr = imgInput.val();
            var newstr = oldStr.replace($(this).parent().data('id'), "");
            imgInput.val(newstr);

            $(this).parent().remove();
        });

        $('.select2').select2();

        var recommendedPackagesSelect = $('#recommendedPackagesSelect');
        recommendedPackagesSelect.on('select2:select', function (e) {
            var id = $(this).val();
            var oldIds = $('#product-recommendedproducts').val();
            $(this).val(null);
            $(this).trigger('change');
            var ids = Object.keys(recommendedPackages[id].productsToPackages);
            ids = ids.concat(oldIds);
            $('#product-recommendedproducts').val(ids).trigger('change');
        });

        var relatedPackagesSelect = $('#relatedPackagesSelect');
        relatedPackagesSelect.on('select2:select', function (e) {
            var id = $(this).val();
            var oldIds = $('#product-relatedproducts')  .val();
            $(this).val(null);
            $(this).trigger('change');
            var ids = Object.keys(relatedPackages[id].productsToPackages);
            ids = ids.concat(oldIds);
            $('#product-relatedproducts').val(ids).trigger('change');
        });
    }
</script>
<?php $this->registerJs('afterInit()', \yii\web\View::POS_LOAD) ?>