<?php

function addUniqueStrToArray(string $str, array &$arr): void
{
    $str = strtolower($str);

    if (!in_array($str, $arr)) {
        $arr[] = $str;
    }
}
