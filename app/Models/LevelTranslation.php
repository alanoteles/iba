<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class LevelTranslation extends Model
{
    public function user()
    {
        return $this->belongsTo('\Iba\Models\User', 'created_by');
    }
}
