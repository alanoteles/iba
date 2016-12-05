<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class BannerPosition extends Model
{
    protected $fillable = ['position', 'banner_id'];

    public function banner()
    {
        return $this->hasOne('\Iba\Models\Banner', 'id', 'banner_id');
    }
}
