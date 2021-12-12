<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use \App\Meta\MetaHandler,\App\Options\DateStructure;
    public function use(){
        return Transaction::where('coupon', $this->attributes['code']);
    }
    public function valid(){
        if(!$this->attributes['role'] || !json_decode($this->attributes['role']) || count(json_decode($this->attributes['role'], true)) == 0) return 'برای همه';
        $r = '';
        foreach(json_decode($this->attributes['role'], true)['options'] as $role){
            $r .= (Option::find($role))->name . ' و ';
        }
        return $r;
    }
}
