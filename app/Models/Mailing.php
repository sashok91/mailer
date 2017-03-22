<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{
    const STATUS_SENT = 'sent';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_DRAFT = 'draft';

    protected $table = 'mailing';

    protected $fillable = [
        'name',
        'email_theme',
        'email_text',
        'scheduled_date',
        'sending_date',
        'status'
    ];

    protected $dates = [
        'scheduled_date',
        'sending_date'
    ];

    public function mailingGroups()
    {
        return $this->belongsToMany('App\Models\MailingGroup', 'mailing_mailing_group', 'id_mailing', 'id_mailing_group');
    }

    public function getScheduledDateHtmlAttribute($value)
    {
        $format = 'Y-m-d\Th:i';
        return Carbon::parse($value)->format($format);
    }
    public function setScheduledDateHtmlAttribute($value)
    {
        $format = 'Y-m-d\Th:i';
        $this->attributes['scheduled_date'] = Carbon::createFromFormat($format, $value);
    }

}
