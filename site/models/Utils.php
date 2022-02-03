<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

class Utils
{

    public static function getEmbeddedImage($imagePath, $size=false, $stratch = false, $rootPathAlias = '@app/web') {
        $path = Yii::getAlias($rootPathAlias.$imagePath);
        if (!file_exists($path)) {
            return $imagePath;
        }
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $neededWidht = $size;
        $neededHeight = $size;
        $result =$imagePath;
        try {
            $img = file_get_contents($path);
            if ($img) {
                $im = @imagecreatefromstring($img);
                if ($im) {
                    unset($img);
                    $width = imagesx($im);
                    $height = imagesy($im);
                    if (!$neededWidht) {
                        $neededWidht = $width;
                    }
                    if (!$neededHeight) {
                        $neededHeight = $height;
                    }
                    if ($width >= $height && $width >= $neededWidht) {
                        $newwidth = $neededWidht;
                        $newheight = round($height * $newwidth / $width);

                    } elseif ($height > $width && $height > $neededHeight) {
                        $newheight = $neededHeight;
                        $newwidth = round($width * $newheight / $height);

                    } elseif ($width <= $height && $width < $neededWidht && $stratch) {
                        $newwidth = $neededWidht;
                        $newheight = round($height * $newwidth / $width);

                    } elseif ($height < $width && $height < $neededHeight && $stratch) {
                        $newheight = $neededHeight;
                        $newwidth = round($width * $newheight / $height);

                    }
                    if (isset($newheight) && isset($newwidth)) {
                        $thumb = imagecreatetruecolor($newwidth, $newheight);
                        imagealphablending($thumb, false);
                        imagesavealpha($thumb, true);
                        imagecopyresampled($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                        $im = $thumb;
                        unset($thumb);
                    }
                    ob_start();
                    if ($type == 'png') {
                        imagepng($im); //save image as png
                    } else {
                        imagejpeg($im); //save image as jpg
                    }
                    $contents = ob_get_contents();
                    ob_end_clean();
                    imagedestroy($im);
                    $result = 'data:image/' . $type . ';base64,' . base64_encode($contents);
                }
            } else {
                $result = $imagePath;
            }
        } catch (Exception $e) {
            return $result;
        }
        return $result;
    }

    /*
    * Outputs a color (#000000) based Text input
    *
    * @param $text String of text
    * @param $min_brightness Integer between 0 and 100
    * @param $spec Integer between 2-10, determines how unique each color will be
    */

    public static function genColorCodeFromText($text, $min_brightness = 100, $spec = 10)
    {
        // Check inputs
        if (!is_int($min_brightness)) {
            throw new Exception("$min_brightness is not an integer");
        }
        if (!is_int($spec)) {
            throw new Exception("$spec is not an integer");
        }
        if ($spec < 2 or $spec > 10) {
            throw new Exception("$spec is out of range");
        }
        if ($min_brightness < 0 or $min_brightness > 255) {
            throw new Exception("$min_brightness is out of range");
        }

        $hash = md5($text);  //Gen hash of text
        $colors = array();
        for ($i = 0; $i < 3; $i++) {
            $colors[$i] = max(
              array(
                round(((hexdec(substr($hash, $spec * $i, $spec))) / hexdec(str_pad('', $spec, 'F'))) * 255),
                $min_brightness
              )
            );
        } //convert hash into 3 decimal values between 0 and 255

        if ($min_brightness > 0)  //only check brightness requirements if min_brightness is about 100
        {
            while (array_sum(
                $colors
              ) / 3 < $min_brightness)  //loop until brightness is above or equal to min_brightness
            {
                for ($i = 0; $i < 3; $i++) {
                    $colors[$i] += 10;
                }
            }
        }    //increase each color by 10

        $output = '';

        for ($i = 0; $i < 3; $i++) {
            $output .= str_pad(dechex($colors[$i]), 2, 0, STR_PAD_LEFT);
        }  //convert each color to hex and append to output

        return '#' . $output;
    }

    public static function purifyMetaText($text)
    {
        return trim(preg_replace('/[\r\n\s]+/ism', ' ', htmlspecialchars(strip_tags(html_entity_decode($text)))));
    }

    /**
     * @param string $text - контент
     * @param int $length - максимальная длина текста
     * @return mixed|string - подготовленный исходный код контента
     */
    public static function textSnippet($text, $length = 0)
    {
        if (empty($text)) {
            return '';
        }
        $textLength = strlen($text);
        // http://api.html-tidy.org/tidy/quickref_5.1.25.html
        if (extension_loaded('tidy')) {
            $config = array(
              'clean'          => 'yes',
              'output-html'    => 'yes',
              'hide-comments'  => 'yes',
              'show-body-only' => true,
            );
            $tidy = @tidy_parse_string($text, $config, 'utf8');
            if (isset($tidy) && $tidy) {
                $tidy->cleanRepair();
                if (isset($tidy->value) && $tidy->value) {
                    $text = $tidy->value;
                }
            }
        }
        if ($length > 0) {
            ini_set('pcre.backtrack_limit', 4 * 1024 * 1024);
            ini_set('pcre.recursion_limit', 1024 * 1024);
            $text = preg_replace('/src\s*=\s*["\']\s*data:.*?["\']/isu', 'src=""', $text);
            $path = Yii::getAlias('application.extensions.simple_html_dom.simple_html_dom') . '.php';
            if (file_exists($path)) {
                include_once($path);
                $Html = @str_get_html($text);
                if ($Html) {
                    $text = $Html->plaintext;
                    if (mb_strlen($text) > $length) {
                        $res = preg_match('/(.{' . $length . ',}?)(?:[><\s]|$)/s', $text, $matches);
                        if ($res) {
                            $text = trim($matches[1]) . '...';
                        }
                    }
                    $Html->clear();
                }
                unset($Html);
            } else {
                    $text = strip_tags($text);
                    if (mb_strlen($text) > $length) {
                        $res = preg_match('/(.{' . $length . ',}?)(?:[><\s]|$)/s', $text, $matches);
                        if ($res) {
                            $text = trim($matches[1]) . '...';
                        }
                    }
            }
            $text = trim(html_entity_decode($text), " \t\n\r\0\x0B\xC2\xA0");//trim(htmlspecialchars($text));
        }
       if (!strlen($text)) {
            $text = "<pre>HTML: {$textLength} байт</pre>";
        }
        return $text;
    }

}

