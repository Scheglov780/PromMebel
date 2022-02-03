<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

class Currency
{
    protected static $_srcCurrRate = false;
    protected static $_srcCurr = false;
    protected static $_destCurrRate = false;
    protected static $_destCurr = false;

    /**
     * Универсальный конвертер валют
     * @param number|float $srcVal Сумма в исходной валюте
     * @param string $srcCurr Код alpha3 исходной валюты, например usd, rur, eur
     * @param string $destCurr Код alpha3 конечной валюты, например usd, rur, eur
     * @param false $digitsNum Количество десятичных знаков (после запятой)
     * @param false $forDate Дата, на которую должен использоваться курс валют
     * @return float Сумма в конечной валюте
     */
    public static function convertCurrency($srcVal, $srcCurr, $destCurr = 'rur', $digitsNum = false, $forDate = false)
    {
        if ($srcCurr == $destCurr) {
            $res = self::cRound($srcVal, $destCurr, $digitsNum);
            return (float) $res;
        }
        if ((self::$_srcCurr != $srcCurr) && !$forDate) {
            $srcCurrRate = self::getCurrencyRate($srcCurr, $forDate);
            self::$_srcCurr = $srcCurr;
            self::$_srcCurrRate = $srcCurrRate;
        } else {
            $srcCurrRate = (($forDate) ? self::getCurrencyRate($srcCurr, $forDate) : self::$_srcCurrRate);
        }
        if ((self::$_destCurr != $destCurr) && !$forDate) {
            $destCurrRate = self::getCurrencyRate($destCurr, $forDate);
            self::$_destCurr = $destCurr;
            self::$_destCurrRate = $destCurrRate;
        } else {
            $destCurrRate = (($forDate) ? self::getCurrencyRate($destCurr, $forDate) : self::$_destCurrRate);
        }
        if ($destCurrRate != 0) {
            if (extension_loaded('bcmath')) {
                bcscale(30);
                $res = self::cRound(
                  bcmul(bcdiv($srcCurrRate, $destCurrRate), self::cRound($srcVal, $srcCurr)),
                  $destCurr,
                  $digitsNum
                );
            } else {
                $res = self::cRound(
                  ($srcCurrRate / $destCurrRate) * self::cRound($srcVal, $srcCurr),
                  $destCurr,
                  $digitsNum
                );
            }
        } else {
            if (extension_loaded('bcmath')) {
                bcscale(30);
                $res = self::cRound(bcmul($srcCurrRate, self::cRound($srcVal, $srcCurr)), $destCurr, $digitsNum);
            } else {
                $res = self::cRound(($srcCurrRate / 1) * self::cRound($srcVal, $srcCurr), $destCurr, $digitsNum);
            }
        }
        return (float) $res;
    }

    /** Функция для однообразного форматирования вывода на обтображение любых денежных сумм
     * @param number|float $price Сумма (в рублях или иных валютах)
     * @param bool|int $digitsNum Количество знаков после запятой
     * @return string Отформатированная сумма
     */
    public static function priceWrapper($price, $digitsNum = false)
    {
        if (empty($price)) {
            $result = 'По запросу';
        } else {
            $result = '<span>' .
              number_format(
                Currency::cRound($price, 'rur', 0),
                0,
                '.',
                ' '
              )
              . '</span>' . '<span>&nbsp;&#8381;</span>'; // собственно, символ рубля ₽
        }
        return $result;
    }

    public static function cRound($val, $currency = false, $digitsNum = false)
    {
        if (!$currency) {
            $currency = 'rur';//DSConfig::getSiteCurrency();
        } else {
            $currency = $currency;
        }
        $res = (float) $val;
        if (!$digitsNum) {
            if (in_array($currency, array('rur', 'kzt', 'uah'))) {
                $res = round($val, 0, PHP_ROUND_HALF_UP);
            } elseif (($currency == 'byr')) {
                $res = round($val, -1, PHP_ROUND_HALF_UP);
            } else {
                $res = round($val, 2, PHP_ROUND_HALF_UP);
                $res = sprintf("%01.2f", $res);
            }
        } else {
            $res = round($val, $digitsNum, PHP_ROUND_HALF_UP);
            $res = sprintf("%01.{$digitsNum}f", $res);
        }
        return (float) $res;
    }

    public static function getCurrencyRate($currency, $forDate = false)
    {
            $iCurrency = $currency;
            if (is_numeric($forDate)) {
                $iForDate = (int)$forDate;
            } else {
                $iForDate = strtotime($forDate);
                if (!is_numeric($iForDate)) {
                    $iForDate = time();
                }
            }
            $res = Yii::$app->db->createCommand(
              "SELECT rate FROM currency_log ll
                                                WHERE ll.currency=:currency AND ll.date<=FROM_UNIXTIME(:forDate)
                                                ORDER BY ll.date DESC LIMIT 1",
              array(
                ':currency' => $iCurrency,
                ':forDate'  => $iForDate,
              )
            )->queryScalar();
            if (!$res) {
                $res = Yii::$app->db->createCommand(
                  "SELECT rate FROM currency_log ll
                                                WHERE ll.currency=:currency ORDER BY ll.date DESC LIMIT 1"
                  ,                   array(
                    ':currency' => $iCurrency,
                  )
                )->queryScalar();
            }
                $result = (float) $res;
        return $result;
    }
}
