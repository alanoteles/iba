<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerTranslation extends Model
{
    protected $fillable = ['name', 'acronym', 'summary', 'content_data', 'locale', 'partner_id', 'url'];
}
