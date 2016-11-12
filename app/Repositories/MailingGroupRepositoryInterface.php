<?php

namespace App\Repositories;


interface MailingGroupRepositoryInterface extends RepositoryInterface
{
    public function addUserToMailingGroup($idUser, $idMailingGroup);
    public function deleteUserFromMailingGroup($idUser, $idMailingGroup);
}