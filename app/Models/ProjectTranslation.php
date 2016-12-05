<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{

    //protected $fillable = ['project_value'];
    protected $fillable = ['title', 'summary', 'comment', 'results', 'locale', 'project_id'];

    public function project()
    {
        return $this->belongsTo('\Iba\Models\Project');
    }


    public function user()
    {
        return $this->belongsTo('\Iba\Models\User');
    }
}
