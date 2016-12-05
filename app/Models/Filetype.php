<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class Filetype extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['type','alt_image', 'alt_cover', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['icon_image','cover_image'];

    public function translation()
    {
        return $this->hasMany('\Iba\Models\FiletypeTranslation');
    }
}
