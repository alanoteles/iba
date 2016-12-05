<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    protected $fillable = ['title', 'image_alt', 'image', 'url', 'locale', 'banner_id'];
}
