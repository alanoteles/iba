<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadTranslation extends Model
{
    protected $fillable = ['title', 'created_by', 'thread_id', 'locale'];
}
