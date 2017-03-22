<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailingGroup extends Model
{
    protected $table = 'mailing_group';

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_mailing_group', 'id_mailing_group', 'id_user');
    }
}
