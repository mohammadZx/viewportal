<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use \App\Meta\MetaHandler,\App\Options\DateStructure;
}
