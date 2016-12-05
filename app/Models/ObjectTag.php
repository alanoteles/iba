<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ObjectTag extends Model
{
    protected $fillable = ['object_id','tag_id'];
    
    public function object()
    {
        return $this->belongsTo('Iba\Models\Object');
    }

}
