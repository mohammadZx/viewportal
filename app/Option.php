<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use \App\Meta\MetaHandler,\App\Options\DateStructure;

    public function vars(){
        return $this->hasMany('\App\OptionVar', 'option_id');
    }
    public function types(){
        return $this->hasMany('\App\OptionType', 'option_id');
    }
    public function roles(){
        return $this->hasMany('\App\OptionRole', 'option_id');
    }
}
