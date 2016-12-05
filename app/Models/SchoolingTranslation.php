<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolingTranslation extends Model
{
    protected $fillable =['name','locale','schooling_id','created_by'];
}
