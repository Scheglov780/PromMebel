<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

class ScheduledJobs
{
    public static function getCurrencyRatesFromBank($currencies = ['usd', 'eur', 'gbp'])
    {
        $update = (Yii::$app->cache->get('rates_auto_update_last_time') == false);
        if ($update) {
//  http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='||TO_CHAR(sysdate,'dd/mm/yyyy')
            $cache = @Yii::$app->cache->get('currency-rates-from-bank');
            if (($cache == false)) {
                //http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req=24/12/2013
                $resp = file_get_contents('http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req=' . date("d/m/Y"));
                $res = array();
                if ($resp) {
                    $resp_xml = @simplexml_load_string($resp);
                    if (isset($resp_xml->Valute)) {
                        foreach ($resp_xml->Valute as $val) {
                            $res[strtolower((string) $val->CharCode)] = (float) str_replace(
                                ",",
                                ".",
                                (string) $val->Value
                              ) / (float) $val->Nominal;
                        }
                    }
                    Yii::$app->cache->set('currency-rates-from-bank', $res, 8 * 60 * 60);
                }
            } else {
                $res = $cache;
            }
            echo VarDumper::dumpAsString($res);
            Yii::$app->cache->set('rates_auto_update_last_time', true, 8 * 60 * 60);
            if (is_array($res) && (count($res) > 0)) {
                if ($update) {
                    $sql = "insert into currency_log (currency, [[date]], rate) values (:id,Now(),:value)";
                    foreach ($res as $currName => $curr) {
                        if (in_array($currName,$currencies)) {
                            Yii::$app->db->createCommand(
                              $sql,
                              [':id' => $currName, ':value' => $curr]
                            )->execute();
                        }
                    }
                }
            }
            return 1;
        } else {
            return 0;
        }
    }

    public static function schedulerEvent()
    {
        return self::getCurrencyRatesFromBank();
    }

}
