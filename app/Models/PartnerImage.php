<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerImage extends Model
{
    protected $fillable = ['image', 'partner_id'];

    public function partner()
    {
        return $this->belongsTo('\Iba\Models\Partner');
    }
}
