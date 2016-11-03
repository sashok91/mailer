<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{
    protected $table = 'mailing';

    protected $fillable = [
        'name',
        'email_theme',
        'email_text',
        'scheduled_date',
        'sending_date',
        'status'
    ];
}
