<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class TypeTranslation extends Model
{
    protected $guarded = ['id'];

    protected $fillable =['type','locale','type_id'];
}
