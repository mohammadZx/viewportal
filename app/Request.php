<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use \App\Meta\MetaHandler, \App\Options\DateStructure;
    protected $fillable = ['transaction_id', 'title', 'content', 'status'];
    protected $with = ['transaction'];
    public function transaction(){
        return $this->belongsTo('\App\Transaction', 'transaction_id');
    }
    public function comments(){
        return $this->hasMany('\App\Comment', 'request_id')->where('parent_id', 0);
    }
}
