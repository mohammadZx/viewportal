<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \App\Meta\MetaHandler,\App\Options\DateStructure;

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function request(){
        return $this->belongsTo('\App\Request', 'request_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

}
