<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['tags', 'locale'];

    public function translation()
    {
        return $this->hasMany('\Iba\Models\TagTranslation');
    }

    public function news()
    {
        return $this->belongsToMany('\Iba\Models\News', 'news_tags', 'tag_id', 'news_id');
    }

    public function object()
    {
        return $this->belongsToMany('\Iba\Models\Object', 'object_tags', 'tag_id', 'object_id');
    }
}
