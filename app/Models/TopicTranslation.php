<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class TopicTranslation extends Model
{
    protected $fillable = ['title', 'created_by', 'topic_id', 'subtopic_id', 'locale'];
}
