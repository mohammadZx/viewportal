<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionRole extends Model
{
    use \App\Meta\MetaHandler,\App\Options\DateStructure;

    public function option(){
        return $this->belongsTo('App/Option', 'option_id');
    }
}
