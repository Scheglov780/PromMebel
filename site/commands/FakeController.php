<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\ar\City;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FakeController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        $faker = \Faker\Factory::create('ru_RU');

        City::deleteAll(['>', 'lat', '57']);
        for ($i = 0; $i <= 60; $i++) {
            $city = new City();
            $city->alias = $faker->slug;
            $city->name = $faker->city;
            $city->address = $faker->address. ' ' . rand(5, 200);
            $city->lat = $faker->randomFloat(6, 57, 63);
            $city->lng = $faker->randomFloat(6, 30, 60);
            $city->save();
        }
    }
}
