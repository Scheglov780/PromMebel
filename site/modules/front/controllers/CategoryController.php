<?php

namespace app\modules\front\controllers;

use app\models\ar\Brand;
use app\models\ar\Manufacturer;
use app\models\ar\Category;
use app\models\ar\News;
use app\models\ar\Product;
use app\models\ar\PropertyToProduct;
use Yii;
use yii\data\Sort;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `front` module
 */
class CategoryController extends BaseController
{
    public function actionIndex()
    {

        /** @var $category Category */
        $category = Category::find()
          ->where(['parent_id' => 0])
          ->with(['products', 'parent.parent', 'childs.childs'])->all();
        if (!isset($category)) {
            throw new NotFoundHttpException();
        }
        $breadcrumbs = ['Все категории'];/* ['label' => 'Все категории', 'url' => '/catalog']; */
        $title = $this->params->meta_title_category;
        $desc = $this->params->meta_desc_category;
        $keywords = $this->params->meta_keywords_category;
        $this->setMeta($title, $desc, $keywords, ['{category_name}'], ['Все категории']);
        if (!Yii::$app->request->isAjax) {
            return $this->render(
              'view',
              [
                'category'            => $category,
                'breadcrumbs'         => $breadcrumbs,
              ]
            );
        } else {
            return $this->renderPartial(
              'view',
              [
                'category'            => $category,
                'breadcrumbs'         => $breadcrumbs,
              ]
            );
        }
    }

    /**
     * Renders the index view for the module
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        /** @var $category Category */
        $category = Category::find()
          ->where(['slug' => $slug])
          ->with(['products', 'parent.parent', 'childs.childs'])
          ->one();
        if (!isset($category)) {
            throw new NotFoundHttpException();
        }
        $breadcrumbs = array_reverse(Category::getBreadcrumbs($category));
        $last = array_pop($breadcrumbs);
        array_push($breadcrumbs, $last['label']);

        $title = $category->meta_title ?? $this->params->meta_title_category;
        $desc = $category->meta_description ?? $this->params->meta_desc_category;
        $keywords = $category->meta_keywords ?? $this->params->meta_keywords_category;
        $this->setMeta($title, $desc, $keywords, ['{category_name}'], [$category->name]);

        //  Если дочерняя категория то выводим список товаров
        if (count($category->childs) == 0) {
            $sort = new Sort(
              [
                'attributes'   => [
                  'price',
                  'order',
                ],
                'defaultOrder' => [
                  'order' => SORT_ASC
                ]
              ]
            );

            $query = Product::find()
              ->with('propertyValue', 'properties')
              ->andWhere(['category_id' => $category->id])
              ->orderBy($sort->orders);

            //  Select of brands
            $q = clone $query;
            $brandIds = $q->select('brand_id')->distinct()->column();
            $brands = Brand::find()->andWhere(['id' => $brandIds])->all();

            //  Select of manufacturers
            $q = clone $query;
            $manufacturerIds = $q->select('manufacturer_id')->distinct()->column();
            $manufacturers = Manufacturer::find()->andWhere(['id' => $manufacturerIds])->all();

            //  Select of size
            $qSize = clone $query;
            $productIds = $qSize->select('id')->column();
            $sizes = PropertyToProduct::find()
              ->select('value')
              ->andWhere(['property_id' => 4])
              ->andWhere(['product_id' => $productIds])
              ->distinct()
              ->column();

            $uri = Yii::$app->request->getQueryParams();

            if (!empty($uri['size'])) {
                $sizeProductIds = PropertyToProduct::find()
                  ->select('product_id')
                  ->andWhere(['property_id' => 4])
                  ->andWhere(['value' => $uri['size']])
                  ->column();
                $query->andFilterWhere(['id' => $sizeProductIds]);
            }

            $query->andFilterWhere(['brand_id' => Yii::$app->request->getQueryParam('brand')]);
            $query->andFilterWhere(['manufacturer_id' => Yii::$app->request->getQueryParam('manufacturer')]);
            $query->andFilterWhere(['execution' => Yii::$app->request->getQueryParam('execution')]);
            $query->andFilterWhere(['delivery_type' => Yii::$app->request->getQueryParam('delivery_type')]);
            $pages = new Pagination(
              [
                'totalCount' => $query->count(),
              ]
            );
            if ((int) \Yii::$app->request->getQueryParam('per-page')) {
                $pageSize = (int) \Yii::$app->request->getQueryParam('per-page');
            } else {
                $pageSize = 30;
            }
            $pages->pageSize = $pageSize;
           /* if ($pageSize == 30) {
                $pages->pageSizeParam = false;
            } */
            $products = $query->offset($pages->offset)
              ->limit($pages->limit)->all();

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_HTML;
                $this->layout = false;
                //echo "<pre>5</pre>";
                return $this->render(
                  '/product/_products',
                  [
                    'category'            => $category,
                    'breadcrumbs'         => $breadcrumbs,
                    'products'            => $products,
                    'pages'               => $pages,
                    'showExtActionsBlock' => false,
                  ]
                );
            }
//            return "<pre>2</pre>";
            return $this->render(
              'index',
              [
                'category'            => $category,
                'breadcrumbs'         => $breadcrumbs,
                'products'            => $products,
                'pages'               => $pages,
                'brands'              => $brands,
                'manufacturers'       => $manufacturers,
                'sizes'               => $sizes,
              ]
            );
        }
//        return "<pre>3</pre>";
        return $this->render(
          'view',
          [
            'category'            => $category,
            'breadcrumbs'         => $breadcrumbs,
          ]
        );
    }

}
