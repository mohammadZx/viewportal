<?php
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;

function arr_rand($arr){
    return $arr[array_rand($arr)];
}
function toJalali($date, $delimeter = '-', $concater = '-'){
    $de = explode(' ', $date);
    $getData = explode($delimeter, $de[0]);
    $Ndate = Verta::getJalali($getData[0], $getData[1], $getData[2]);
    return implode($concater, $Ndate)  .' ' . isset($de[1]) ? $de[1] : null;
}

function toGregorian($date, $delimeter = '-', $concater = '-'){
    $de = explode(' ', $date);
    $getData = explode($delimeter, $de[0]);
    $Ndate = Verta::getGregorian($getData[0], $getData[1], $getData[2]);
    return implode($concater, $Ndate)  .' ' . isset($de[1]) ? $de[1] : null;
}