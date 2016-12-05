<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTag extends Model
{
    protected $fillable = ['news_id','tag_id'];
    
    public function news()
    {
        return $this->belongsTo('Iba\Models\News');
    }

}
