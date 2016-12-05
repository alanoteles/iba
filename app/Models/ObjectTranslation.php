<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ObjectTranslation extends Model
{
    protected $fillable = ['title','preamble','source','locale','object_id','created_by'];
}
