<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'locale'];
    protected $guarded = ['id'];

    protected $fillable = ['status'];

    public function project_type_translation()
    {
        return $this->hasMany('\Iba\Models\ProjectTypeTranslation');
    }

    public function translation()
    {
        return $this->hasMany('\Iba\Models\ProjectTypeTranslation');
    }
}
