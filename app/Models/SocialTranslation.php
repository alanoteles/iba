<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class SocialTranslation extends Model
{
    protected $fillable = ['image_alt', 'locale', 'social_id'];

}
