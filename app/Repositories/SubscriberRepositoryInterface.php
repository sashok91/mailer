<?php

namespace App\Repositories;


interface SubscriberRepositoryInterface extends RepositoryInterface
{
    public function saveUserMailingGroup($idUser, array $mailingGroupsIds);
    public function getSubscriberWithMailingGroupsIdArray($id);
    public function findByEmail($email);
}