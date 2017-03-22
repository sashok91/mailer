<?php

namespace App\Repositories;


interface MailingRepositoryInterface extends RepositoryInterface
{
    public function allSent();
    public function allDraft();
    public function changeStatus($mailing, $status, $sendingDate = null);
}