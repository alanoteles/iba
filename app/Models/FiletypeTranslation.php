<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class FiletypeTranslation extends Model
{
    protected $fillable = ['type','alt_image','alt_cover','locale','filetype_id'];
}
