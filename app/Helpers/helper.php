<?php
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;

define('PRE_PAGE', 20);
define('IMAGECOUNT', 30);
function arr_rand($arr){
    return $arr[array_rand($arr)];
}
function toJalali($date, $delimeter = '-', $concater = '-'){
    $de = explode(' ', Carbon::parse($date)->format('Y-m-d h:i:s'));
    $getData = explode($delimeter, $de[0]);
    $Ndate = Verta::getJalali($getData[0], $getData[1], $getData[2]);
    $h = isset($de[1]) ? $de[1] : null;
    return implode($concater, $Ndate)  .' ' . $h;
}

function toGregorian($date, $delimeter = '-', $concater = '-'){
    $de = explode(' ', Carbon::parse($date)->format('Y-m-d h:i:s'));
    $getData = explode($delimeter, $de[0]);
    $Ndate = Verta::getGregorian($getData[0], $getData[1], $getData[2]);
    $h = isset($de[1]) ? $de[1] : null;
    return implode($concater, $Ndate)  .' ' . $h;

}
function getAttachmentById($id){
    $attachment = \App\Attachment::find($id);
    if($attachment) return "/uploads/"  . $attachment->src;
    return null;
}
function getUserTumbnail(){
    $thumbnail = auth()->user()->getMeta('thumbnail', true);
    if($thumbnail && getAttachmentById($thumbnail->meta_value)){
        $src = getAttachmentById($thumbnail->meta_value);
        return "<img src='$src' class='user-thumbnail'>";  
    }
    echo "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTri7KMd1dVXK-iVV6g6nH1A_HFMyL5vKtLjY8y_nuNYeLr5EMM5QA0eOj6zkEJhI8qtpk&usqp=CAU' class='user-thumbnail'>";
}
