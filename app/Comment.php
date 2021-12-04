<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \App\Meta\MetaHandler,\App\Options\DateStructure;

}
