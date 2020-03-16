<?php

class Utils
{
    public static function capitalizeText($string, $everyWord = false)
    {
        if ($everyWord) {
            $explodedString = preg_split("/\s/", $string);
            foreach ($explodedString as $key => $value) {
                $explodedString[$key][0] = strtoupper($value[0]);
            }
            $string = implode(" ", $explodedString);
        } else {
            $string[0] = strtoupper($string[0]);
        }

        return $string;
    }

    public static function getCleanedData($var)
    {
        if (Utils::exists($var)) {
            $tmp = strip_tags(self::sinEspacios($_REQUEST[$var]));
        } else {
            $tmp = "";
        }

        return $tmp;
    }

    public static function exists($var)
    {
        return isset($_REQUEST[$var]);
    }

    public static function sinEspacios($frase)
    {
        $texto = trim(preg_replace('/ +/', ' ', $frase));
        return $texto;
    }

    public static function generateRandomKey($length = 75)
    {
        $token = '';
        $keys = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

        for ($i = 0; $i < $length; $i++) {
            $token .= $keys[array_rand($keys)];
        }

        return $token;
    }

    public static function ifExistsShowError($array, $name)
    {
        ?> <div> <?php
if (isset($array[$name])) {
            foreach ($array[$name] as $value) {
                ?>
    <small class="text-muted"><?php echo $value ?></small>
    <?php
}
        }
        ?> </div> <?php
}
}