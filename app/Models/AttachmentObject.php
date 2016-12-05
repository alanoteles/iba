<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class AttachmentObject extends Model
{
    protected $table = 'attachment_object';

    public function attachment(){
        return $this->belongsToMany('\Iba\Models\Attachment');
    }

    public function object()
    {
        return $this->belongsTo('Iba\Models\Object');
    }
}
