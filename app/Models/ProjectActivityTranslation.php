<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectActivityTranslation extends Model
{
    protected $fillable = ['name','locale','project_activity_id'];

    public function project_activity()
    {
        return $this->belongsTo('\Iba\Models\ProjectActivity');
    }

}
