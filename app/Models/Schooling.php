<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class Schooling extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['order','created_by'];

    public function translation()
    {
        return $this->hasMany('\Iba\Models\SchoolingTranslation');
    }
}
