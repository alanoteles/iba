<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroupAdministrativeArea extends Model
{
    public function administrative_areas()
    {
        return $this->belongsTo('\Iba\Models\AdministrativeArea');
    }

}
