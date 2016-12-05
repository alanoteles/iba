<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSituationTranslation extends Model
{
    protected $fillable = ['name','locale','project_situation_id'];

    public function project_situation()
    {
        return $this->belongsTo('\Iba\Models\ProjectSituation');
    }

}
