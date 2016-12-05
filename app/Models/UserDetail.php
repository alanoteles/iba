<?php

namespace Iba\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{

    protected $fillable = [ 'user_id', 'avatar', 'document', 'birthday', 'locale', 'address', 'number', 'zip', 'neighborhood', 'complement', 'mobile_phone',
                            'city_id', 'about', 'facebook', 'twitter', 'youtube', 'blog', 'schooling_id', 'occupation', 'lattes', 'employer',
                            'notifications_my_objects', 'privacy', 'notifications_other_objects'];

    public function user()
    {
        return $this->belongsTo('\Iba\Models\User');
    }




    public function city()
    {
        return $this->belongsTo('\Iba\Models\City');
    }
}
