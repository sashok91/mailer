<?php

namespace App\Logic;

use App\Models\Permissions;
use App\Models\User;
use App\Models\UserPermissions;

trait AdminLogicTrait
{
    protected function createAdmin(array $data)
    {
        $data['role'] = User::USER_ROLE_ADMIN;
        $user = User::create($data);
        $this->savePermissions($user->id, $data['permissions']);
        return $user;
    }

    protected function updateAdmin(array $data)
    {
        $result = false;
        $user = User::find($data->id);
        if ($user) {
            $result = $user->save($data);
            $userId = $user->id;
            UserPermissions::getByIdUser($userId)->delete();
            $this->savePermissions($userId, $data['permissions']);
        }
        return $result;
    }

    protected function savePermissions($userId, array $permissionsIds){
        if ($userId && count($permissionsIds)){
            foreach($permissionsIds as $permissionId){
                UserPermissions::firstOrCreate([
                    'id_user' => $userId,
                    'id_permissions' => $permissionId
                ]);
            }
        }
    }

    protected function deleteAdmin($id)
    {
        $result = false;
        $user = User::find($id);
        if ($user) {
            $user->delete($id);
        }
        return $result;
    }
}