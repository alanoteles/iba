<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerGroup extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name'];
    protected $guarded = ['id'];

    protected $fillable = ['status'];

    public function partner_group_translation()
    {
        return $this->hasMany('\Iba\Models\PartnerGroupTranslation');
    }


    public function partner()
    {
        return $this->hasMany('\Iba\Models\Partner');
    }
}
