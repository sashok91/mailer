<?php

namespace App\Services;


use App\Mail\CustomMail;
use App\Models\Mailing;
use App\Repositories\MailingRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class MailService
{
    protected $mailings;

    public function __construct(MailingRepositoryInterface $mailings)
    {
        $this->mailings = $mailings;
    }

    public function sendMails(Mailing $mailing){
        foreach ($mailing->mailingGroups as $mailingGroup){
            foreach($mailingGroup->users as $user){
                Mail::to($user->email)
                    ->queue(new CustomMail($mailing));
            }
        }
        $this->mailings->changeStatus($mailing, Mailing::STATUS_SENT, Carbon::now());
    }}