<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class CmsHighlight extends Model
{
    protected $fillable = ['module', 'position', 'page', 'record_id'];

    public function news()
    {
        return $this->belongsTo('\Iba\Models\News', 'record_id');
    }


    public function project()
    {
        return $this->belongsTo('\Iba\Models\Project','record_id');
    }
}
