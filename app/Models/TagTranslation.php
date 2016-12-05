<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    protected $fillable = ['name', 'locale', 'tag_id', 'created_by'];

}
