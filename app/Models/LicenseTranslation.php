<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseTranslation extends Model
{
    protected $fillable = ['name','summary','locale','license_id','created_by'];
}
