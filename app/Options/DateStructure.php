<?php
namespace App\Options;
trait DateStructure{
    
    public function getCreatedAtAttribute($value){
        return toJalali($value);
    }

    public function getUpdatedAtAttribute($value){
        return toJalali($value);
    }
}