<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    protected $fillable = ['title', 'content_data', 'locale', 'page_id'];

    public function page()
    {
        return $this->belongsTo('\Iba\Models\Page');
    }
}
