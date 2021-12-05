<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    protected $fillable = [
        'meta_key', 'meta_value', 'parent_id'
    ];
    public function attachment(){
        return $this->belongsTo('App/Attachment', 'meta_value')
        ->where('meta_key', 'attachment');
    }
}
