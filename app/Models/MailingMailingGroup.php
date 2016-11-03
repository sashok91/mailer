<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailingMailingGroup extends Model
{
    protected $table = 'mailing_mailing_group';

    protected $fillable = [
        'id_mailing',
        'id_mailing_group'
    ];

}
