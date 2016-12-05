<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'filename','path','hash','size','attachment_id','origin','locale'];
    protected $guarded = ['id'];

    public function translation()
    {
        return $this->hasMany('\Iba\Models\AttachmentTranslation');
    }

    public function attachment_object()
    {
        return $this->belongsTo('\Iba\Models\AttachmentObject');
    }
}
