<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    const PERMISSIONS_SUBSCRIBERS_ID = 1;
    const PERMISSIONS_MAILING_GROUPS_ID = 2;
    const PERMISSIONS_MAILINGS_ID = 3;

    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'description'
    ];
}
