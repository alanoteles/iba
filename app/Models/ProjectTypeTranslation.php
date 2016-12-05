<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTypeTranslation extends Model
{
    protected $fillable = ['name','locale','project_type_id'];
}
