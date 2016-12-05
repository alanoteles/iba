<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ObjectLevel extends Model
{

    public function object()
    {
        return $this->belongsTo('Iba\Models\Object');
    }

}
