<?php

namespace App\Repositories;


use App\Models\User;
use App\Models\UserPermissions;

class AdminRepository implements AdminRepositoryInterface
{
    public function all($columns = array('*'))
    {
        return User::where('role', User::USER_ROLE_ADMIN)->get($columns);
    }

    public function create(array $data)
    {
        $user = User::create([
            'first_name' => trim($data['first_name']),
            'middle_name' => trim($data['middle_name']),
            'last_name' => trim($data['last_name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => User::USER_ROLE_ADMIN
        ]);
        $this->savePermissions($user->id, $data['permissions']);
        return $user;
    }

    public function update($id, array $data)
    {
        $result = false;
        $user = $this->find($id);
        if ($user) {
            $user->fill([
                'first_name' => trim($data['first_name']),
                'middle_name' => trim($data['middle_name']),
                'last_name' => trim($data['last_name']),
                'password' => bcrypt($data['password'])
            ]);
            $result = $user->save();
            UserPermissions::getByIdUser($id)->delete();
            $this->savePermissions($id, $data['permissions']);
        }
        return $result;
    }

    private function savePermissions($userId, array $permissionsIds){
        if ($userId && count($permissionsIds)){
            foreach($permissionsIds as $permissionId){
                UserPermissions::firstOrCreate([
                    'id_user' => $userId,
                    'id_permissions' => $permissionId
                ]);
            }
        }
    }

    public function delete($id)
    {
        $result = false;
        $user = $this->find($id);
        if ($user) {
            $result = $user->delete($id);
        }
        return $result;
    }

    public function find($id, $columns = array('*'))
    {
        return User::where('role', User::USER_ROLE_ADMIN)->find($id, $columns);
    }

    public function getAdminWithPermissionsIdArray($idAdmin){
        $user = $this->find($idAdmin);
        if ($user){
            $arrayOfIds = [];
            $userPermissions = UserPermissions::getByIdUser($idAdmin)->get(['id_permissions']);
            foreach($userPermissions as $userPermission){
                $arrayOfIds[] = $userPermission->id_permissions;
            }
            $user->permissions = $arrayOfIds;
        }
        return $user;
    }

}