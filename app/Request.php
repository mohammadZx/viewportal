<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use \App\Meta\MetaHandler, \App\Options\DateStructure;
}
