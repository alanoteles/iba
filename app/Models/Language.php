<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['title', 'name','short', 'iso','status','created_by'];

    public function user()
    {
        return $this->belongsTo('\Iba\Models\User', 'created_by');
    }
}
