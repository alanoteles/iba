<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{


    public function user_profile()
    {
        return $this->belongsTo('\Iba\Models\UserProfile');
    }


    public function state()
    {
        return $this->belongsTo('\Iba\Models\State');
    }


    public function sealer()
    {
        return $this->belongsTo('\Iba\Models\Sealer');
    }

    public function user_group_administrative_areas()
    {
        return $this->hasMany('\Iba\Models\UserGroupAdministrativeArea');
    }
}
