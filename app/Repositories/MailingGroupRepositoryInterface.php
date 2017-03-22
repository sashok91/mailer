<?php

namespace App\Repositories;


interface MailingGroupRepositoryInterface extends RepositoryInterface
{
    public function getMailingGroupsWithSubscribers($id);
    public function addUserToMailingGroup($idMailingGroup, $idUser );
    public function deleteUserFromMailingGroup($idMailingGroup, $idUser);
}