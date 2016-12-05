<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerGroupTranslation extends Model
{
    protected $fillable = ['name','locale','partner_group_id'];
}
