<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class AttachmentTranslation extends Model
{
    protected $fillable = ['name','filename','attachment_id','path','size','hash','origin','locale'];
}
