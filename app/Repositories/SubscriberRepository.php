<?php

namespace App\Repositories;


use App\Models\User;
use App\Models\UserMailingGroup;

class SubscriberRepository implements SubscriberRepositoryInterface
{
    public function all($columns = array('*'))
    {
        return User::where('role', User::USER_ROLE_SUBSCRIBER)->get($columns);
    }

    public function create(array $data)
    {
        $user = User::create([
            'first_name' => trim($data['first_name']),
            'middle_name' => trim($data['middle_name']),
            'last_name' => trim($data['last_name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => User::USER_ROLE_SUBSCRIBER
        ]);
        $this->saveUserMailingGroup($user->id, $data['mailing_groups']);
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
                'email' => $data['email'],
                'last_name' => trim($data['last_name']),
                'password' => bcrypt($data['password'])
            ]);
            $result = $user->save();
            UserMailingGroup::getByIdUser($id)->delete();
            $this->saveUserMailingGroup($id, $data['mailing_groups']);
        }
        return $result;
    }

    private function saveUserMailingGroup($idUser, array $mailingGroupsIds){
        foreach($mailingGroupsIds as $mailingGroupsId){
            UserMailingGroup::firstOrCreate([
                'id_user' => $idUser,
                'id_mailing_group' => $mailingGroupsId
            ]);
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
        return User::where('role', User::USER_ROLE_SUBSCRIBER)->find($id, $columns);
    }

    public function getSubscriberWithMailingGroupsIdArray($id){
        $user = $this->find($id);
        if ($user){
            $arrayOfIds = [];
            $mailingGroups = UserMailingGroup::getByIdUser($id)->get(['id_mailing_group']);
            foreach($mailingGroups as $mailingGroup){
                $arrayOfIds[] = $mailingGroup->id_mailing_group;
            }
            $user->mailing_groups = $arrayOfIds;
        }
        return $user;
    }

}