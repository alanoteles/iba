<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    protected $fillable = ['title', 'featured_title', 'source', 'content_data', 'locale', 'news_id'];

    public function news()
    {
        return $this->belongsTo('\Iba\Models\News');
    }
}
