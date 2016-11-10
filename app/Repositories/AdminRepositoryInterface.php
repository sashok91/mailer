<?php

namespace App\Repositories;


interface AdminRepositoryInterface extends RepositoryInterface
{
    public function getAdminWithPermissionsIdArray($idAdmin);
}