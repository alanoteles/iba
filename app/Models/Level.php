<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'locale'];
    protected $guarded = ['id'];
}
