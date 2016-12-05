<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['title', 'locale'];
    protected $guarded = ['id'];


    public function topic(){
        return $this->hasMany('\Iba\Models\Topic')->where('topic_id', 0);
    }

    public function translation()
    {
        return $this->hasMany('\Iba\Models\ThreadTranslation');
    }
}
