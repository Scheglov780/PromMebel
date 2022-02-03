<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="news-form">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'excel')->fileInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    Поля загрузки
                </div>
                <div class="box-body">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Исполнение</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><td>0</td><td>Общепромышленное</td></tr>
                            <tr><td>1</td><td>Антистатическое</td></tr>
                            </tbody>
                            <thead>
                            <tr>
                                <th>Срок поставки</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><td>0</td><td>Со склада</td></tr>
                            <tr><td>1</td><td>Под заказ</td></tr>
                            </tbody>
                        </table>
                        <!--
                         <table class="table table-striped">
                             <thead>
                             <tr>
                                 <th>Общие</th>
                                 <th></th>
                             </tr>
                             </thead>
                             <tbody>
                             <tr><td>{city_name}</td><td>название города</td></tr>
                             <tr><td>{city_name_1}</td><td>название города в родительном падеже</td></tr>
                             <tr><td>{city_name_2}</td><td>название города в дательном падеже</td></tr>
                             <tr><td>{city_name_3}</td><td>название города в предложном падеже</td></tr>
                             </tbody>
                             <thead>
                             <tr>
                                 <th>В товарах</th>
                                 <th></th>
                             </tr>
                             </thead>
                             <tbody>
                             <tr><td>{product_name}</td><td>название товара</td></tr>
                             <tr><td>{category_name}</td><td>название категории</td></tr>
                             <tr><td>{price}</td><td>цена товара</td></tr>
                             </tbody>
                             <thead>
                             <tr>
                                 <th>В категории</th>
                                 <th></th>
                             </tr>
                             </thead>
                             <tbody>
                             <tr><td>{category_name}</td><td>название категории</td></tr>
                             </tbody>
                         </table>-->
                    </div>
                </div>
            </div>

            <!--            <div class="box">
                            <div class="box-header">
                                Sitemap и robots
                            </div>
                            <div class="box-body">
                                sitemap.xml - заливать в корень, и он будет для поддоменов генериться сам <br>
                                robots.txt - <b>ПЕРЕИМЕНОВЫВАТЬ</b> в robots_template.txt и тоже в корень сайта
                            </div>
                        </div>-->
        </div>
    </div>


</div>
