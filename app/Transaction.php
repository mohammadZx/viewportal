<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use \App\Meta\MetaHandler,\App\Options\DateStructure;
    protected $fillable = ['name', 'option_var_id', 'option_type_id', 'price', 'coupon_id', 'status', 'authority_code', 'date_way', 'comment'];

    public function user(){
        return $this->belongsTo('App/User', 'user_id');
    }

    public function optionVar(){
        return $this->belongsTo('App/OptionVar', 'option_var_id');
    }

    public function optionType(){
        return $this->belongsTo('App/OptionType', 'option_type_id');
    }

    public function coupon(){
        return $this->belongsTo('App/Coupon', 'coupon_id');
    }

}
