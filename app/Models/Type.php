<?php

namespace Iba\Models;


use Illuminate\Database\Eloquent\Model;


class Type extends Model
{

    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['type'];
    protected $guarded = ['id'];

    public function translation()
    {
        return $this->hasMany('\Iba\Models\TypeTranslation');
    }

}
