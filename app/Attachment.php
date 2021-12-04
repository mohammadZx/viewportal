<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use \App\Meta\MetaHandler,\App\Options\DateStructure;
}
