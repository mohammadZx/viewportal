<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use \App\Meta\MetaHandler, \App\Options\DateStructure;
    protected $fillable = ['transaction_id', 'title', 'content', 'status'];
    public function transactions(){
        return $this->belongsTo('\App\Transaction', 'transaction_id');
    }
}
