<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ObjectAuthor extends Model
{
    protected $fillable = ['author_id', 'object_id'];

    public function object()
    {
        return $this->belongsTo('Iba\Models\Object');
    }

}
