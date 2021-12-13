<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionRole extends Model
{
    use \App\Meta\MetaHandler,\App\Options\DateStructure;
    protected $fillable = ['role_key', 'role_value'];
    public function option(){
        return $this->belongsTo('App/Option', 'option_id');
    }
}
