<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ObjectFaved extends Model
{

    public function object()
    {
        return $this->belongsTo('Iba\Models\Object');
    }

}
