<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMailingGroup extends Model
{
    protected $table = 'user_mailing_group';

    protected $fillable = [
        'id_user',
        'id_mailing_group'
    ];
}
