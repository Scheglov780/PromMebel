<?php

namespace app\modules\front\controllers;

use app\models\ar\Category;
use app\models\ar\News;
use app\models\ar\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `front` module
 */
class SeriesController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionView($slug)
    {
        /** @var $product Product */
        $product = Product::find()
            ->andWhere(['type' => Product::TYPE_SERIES])
            ->andWhere(['slug' => $slug])
            ->with([
                'productImgs',
                'brand',
                'tables',
                'recommendedProducts.category',
                'relatedProducts.category',
                'relatedProducts.propertyValue.property',
                'relatedProducts.productImgs',
                'propertyValue.property'
            ])
            ->one();
        if(!isset($product)) {
            throw new NotFoundHttpException();
        }
//@todo По аналогии можно вывести $product->manufacturer
        $breadcrumbs = [[
            'label' => "Торговая марка ".$product->brand->name,
            'url' => Url::toRoute(['/front/brand/view', 'slug' => $product->brand->slug]),
        ]];

        $title = $product->meta_title ?? $this->params->meta_title_product;
        $desc = $product->meta_description ?? $this->params->meta_desc_product;
        $keywords = $product->meta_keywords ?? $this->params->meta_keywords_product;

        $this->setMeta(
            $title,
            $desc,
            $keywords,
            ['{product_name}', '{product_price}'],
            [ $product->name, $product->actualPrice]
        );
        return $this->render('view', [
            'product' => $product,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
