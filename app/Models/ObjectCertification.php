<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ObjectCertification extends Model
{


    public function object()
    {
        return $this->belongsTo('Iba\Models\Object');
    }

}
