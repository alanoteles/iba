<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectYear extends Model
{
    protected $fillable = ['year', 'value', 'project_id'];

    public function project()
    {
        return $this->belongsTo('\Iba\Models\Project');
    }
}
