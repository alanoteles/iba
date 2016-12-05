<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class NewsEditorialTranslation extends Model
{
    protected $fillable = ['name','locale','news_editorial_id','created_by'];
}
