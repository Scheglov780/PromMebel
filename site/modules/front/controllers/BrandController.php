<?php

namespace app\modules\front\controllers;

use app\models\ar\Brand;
use app\models\ar\Category;
use app\models\ar\Product;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Сontroller for the `front` module
 */
class BrandController extends BaseController
{
    /**
     * Action (действие, ссылка), возвращающая html-рендеринг страницы списка всех брендов
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        // Выбираем список всех брендов
        /** @var Brand[] $brands */
        $brands = Brand::find()
          ->where(['status' => 1]) // которые включены, status=1
          ->all();
        // Если список брендов пуст, возвращаем ошибку 404 Not found
        if (!isset($brands)) {
            throw new NotFoundHttpException();
        }
        // Формируем "хлебную крошку"
        $breadcrumbs = [
          [
            'label' => 'Все бренды',
              // 'url' => Url::toRoute('/front/brand/index'),
          ],
        ];
        // Перебираем в цикле все бренды и для каждого из них выбираем Серии
        /** @var Brand $brand */
        foreach ($brands as $brand) {
// Всего-то одним запросом выбираем АВТОНОМНЫЕ КАТЕГОРИИ, к которым принадлежат СЕРИИ, принадлежащие заданному бренду
            $sql = <<<CATS
select cc.id,  
  cc.name,
  cc.slug,
  cc.parent_id,
  cc.description,
  cc.order,
  cc.type,
  cc.status,
  cc.img,
  cc.meta_title,
  cc.meta_description,
  cc.meta_keywords,
  cc.description_short,
  cc.alt,
  cc.price_from /* тут нужно отметить, что в модели данных зачем-то введено поле price_from, хотяпо уму вилку цен 
                   нужно бы считать автоматически, на лету, по значениям стоимости товаров в выборке */    
  from product pp 
join category cc on cc.id = pp.category_id
where pp.type =1 -- найденные товары могут быть и товарами, и сериями
  and pp.brand_id = :brand_id -- и должны принадлежать задданному в цикле бренду
  and pp.status = 1 -- и должны быть включены
and cc.parent_id = -1
and cc.status = 1
group by cc.id
order by cc.order asc, pp.order -- сортируем список по полю order 
CATS;
            // Ну и получаем список категорий, к которым принадлежат товары и серии заданного бренда
            /** @var Category[] $categories */
            $categories = Category::findBySql($sql, [
              ':brand_id' => $brand->id,
            ])->with( // Вот тут на самом деле получаем серии в поле products
              [
                'products' => function (\yii\db\ActiveQuery $query) use ($brand) {
                    return $query->where([
                      'brand_id' => $brand->id,
                      'status'   => 1,
                      'type'     => [Product::TYPE_SERIES],
                    ]);
                },
              ]
            )->all();
            $data[] = [$brand, $categories];
        }

        // Это вообще непонятно, что такое было и зачем.
        //$promMebel = Category::find()->andWhere(['id' => 2])->one();

        // Заполняем и устанавливаем meta
        $title = $this->params->meta_title_brand;
        $desc = $this->params->meta_desc_brand;
        $keywords = $this->params->meta_keywords_brand;

        $this->setMeta(
          $title,
          $desc,
          $keywords,
          ['{brand_name}'],
          ['Все бренды']
        );
        // Собственно, формируем html-выдачу по заданному набору данных
        return $this->render(
          'index',
          [
            'data' => $data, // Массив, содержащий наборы данных [$brand,$categories] для каждого из
              // найденных брендов
            'breadcrumbs' => $breadcrumbs, // Хлебная крошка
          ]
        );
    }

    /**
     * Action (действие, ссылка), возвращающая html-рендеринг страницы просмотра одного бренда и сопутствующих серий,
     * товаров, категорий и т.п.
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        // Выбираем нужный бренд из таблицы brand - тут всё верно
        $brand = Brand::find()->where(['slug' => $slug])->one();
        if (!isset($brand)) {
            // если не находим - бросаем исключение
            throw new NotFoundHttpException();
        }

        // Формируем крошки
        $breadcrumbs = [
          [
            'label' => 'Все бренды',
            'url'   => Url::toRoute('/front/brand/index'),
          ],
          [
            'label' => $brand->name,
              //'url' => Url::toRoute(['/front/brand/view', 'slug' => $slug]),
          ],
        ];

// Всего-то одним запросом выбираем АВТОНОМНЫЕ КАТЕГОРИИ, к которым принадлежат СЕРИИ, принадлежащиезаданному бренду
        $sql = /** @lang MySQL */
          <<<CATS
select cc.id,  
  cc.name,
  cc.slug,
  cc.parent_id,
  cc.description,
  cc.order,
  cc.type,
  cc.status,
  cc.img,
  cc.meta_title,
  cc.meta_description,
  cc.meta_keywords,
  cc.description_short,
  cc.alt,
  cc.price_from /* тут нужно отметить, что в модели данных зачем-то введено поле price_from, хотяпо уму вилку цен 
                   нужно бы считать автоматически, на лету, по значениям стоимости товаров в выборке */    
  from product pp 
join category cc on cc.id = pp.category_id
where pp.type =1 -- найденные товары могут быть и товарами, и сериями
  and pp.brand_id = :brand_id -- и должны принадлежать задданному в цикле бренду
  and pp.status = 1 -- и должны быть включены
and cc.parent_id = -1
and cc.status = 1
group by cc.id
order by cc.order, cc.name, pp.order, pp.name -- сортируем список по полю order 
CATS;
        // Ну и получаем список категорий, к которым принадлежат товары и серии заданного бренда
        /** @var Category[] $categories */
        $categories = Category::findBySql($sql, [
          ':brand_id' => $brand->id,
        ])->with( // Вот тут на самом деле получаем серии в поле products
          [
            'products' => function (\yii\db\ActiveQuery $query) use ($brand) {
                return $query->where([
                  'brand_id' => $brand->id,
                  'status'   => 1,
                  'type'     => [Product::TYPE_SERIES],
                ]);
            },
          ]
        )->all();
        /* И, собственно, всё!
        $categories содержит список автономных категорий, а в поле products - список серий этих категорий.
        ПОЛНОСТЬЮ аналогично по формату предстоящего далее вывода тому, что "предыдущим программистом".
        НО ВЕРНО ПО УСЛОВИЯМ ВЫБОРКИ И СОДЕРЖИТ ПРАВИЛЬНЫЕ ДАННЫЕ .ЧЁРТ ВОЗЬМИ!!!
        */

        $title = $brand->meta_title ?? $this->params->meta_title_brand;
        $desc = $brand->meta_description ?? $this->params->meta_desc_brand;
        $keywords = $brand->meta_keywords ?? $this->params->meta_keywords_brand;

        $this->setMeta(
          $title,
          $desc,
          $keywords,
          ['{brand_name}'],
          [$brand->name]
        );
        // Ну и передаём на страничку найденные данные.
        // А именно
        // $categories - автономные категории с сериями заданного бренда
        // $brand - собственно заданный бренд

        return $this->render('view', [
          'categories' => $categories,
          'brand'      => $brand,
        ]);
    }
}