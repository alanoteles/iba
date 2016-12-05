<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerProject extends Model
{
    public function project()
    {
        return $this->belongsTo('\Iba\Models\Project');
    }


    public function partner()
    {
        return $this->belongsTo('\Iba\Models\Partner');
    }

}
