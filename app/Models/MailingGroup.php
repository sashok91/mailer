<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailingGroup extends Model
{
    protected $table = 'mailing_group';

    protected $fillable = [
        'name'
    ];
}
