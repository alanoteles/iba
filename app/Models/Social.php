<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['image_alt', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['url', 'image', 'status', 'locale'];

    public function translation()
    {
        return $this->hasMany('\Iba\Models\SocialTranslation');
    }

}
