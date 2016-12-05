<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['title', 'image_alt', 'image', 'url', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['status', 'comment'];

    public function positions()
    {
        return $this->hasOne('\Iba\Models\BannerPosition', 'banner_id');
    }


    public function translation()
    {
        return $this->hasMany('\Iba\Models\BannerTranslation');
    }
}
