<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    //
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'summary'];
    protected $guarded = ['id'];


    public function translation()
    {
        return $this->hasMany('\Iba\Models\LicenseTranslation');
    }
}
