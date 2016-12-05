<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['title', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['thread_id', 'topic_id'];

    public function subtopic()
    {
        //return $this->belongsTo('\Iba\Models\Topic', 'topic_id');
        return $this->hasMany('\Iba\Models\Topic', 'topic_id');

    }

    public function translation()
    {
        return $this->hasMany('\Iba\Models\TopicTranslation');
    }
}
