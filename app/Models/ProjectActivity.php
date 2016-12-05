<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectActivity extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['status'];

    public function translation()
    {
        return $this->hasMany('\Iba\Models\ProjectActivityTranslation');
    }
}
