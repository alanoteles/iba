<?php

/**
 * Created by PhpStorm.
 * User: alanoteles
 * Date: 10/05/16
 * Time: 17:13
 */

namespace Iba\Helpers;

class Helper
{

    /**
     * Retorna a última palavra completa próximo a quantidade de letras
     * que deseja truncar.
     * @param $string
     * @param $your_desired_width
     * @return string
     */
    public static function tokenTruncate($string, $your_desired_width, $string_end_signal='...') {
        $string_length = strlen($string);
        $parts = preg_split('/([\s\n\r]+)/u', $string, null, PREG_SPLIT_DELIM_CAPTURE);
        $parts_count = count($parts);

        $length = 0;
        $last_part = 0;
        for (; $last_part < $parts_count; ++$last_part) {
            $length += strlen($parts[$last_part]);
            if ($length > $your_desired_width) { break; }
        }

        $final = implode(array_slice($parts, 0, $last_part));
        if($string_length > $your_desired_width ) $final.=$string_end_signal;

        return $final;
    }

}