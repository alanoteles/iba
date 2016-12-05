<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class CmsObjectAttachment extends Model
{

    protected $fillable = ['fk_id', 'module', 'object_id'];

    public function object()
    {
        return $this->belongsTo('\Iba\Models\Object');
    }


    public function project()
    {
        return $this->belongsTo('\Iba\Models\Project','fk_id');
    }
}
