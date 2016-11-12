<?php

namespace App\Repositories;


interface SubscriberRepositoryInterface extends RepositoryInterface
{
    public function getSubscriberWithMailingGroupsIdArray($id);
}