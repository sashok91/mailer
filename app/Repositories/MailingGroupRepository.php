<?php

namespace App\Repositories;


use App\Models\MailingGroup;
use App\Models\User;
use App\Models\UserMailingGroup;

class MailingGroupRepository implements MailingGroupRepositoryInterface
{
    public function all($columns = array('*'))
    {
        return MailingGroup::get($columns);
    }

    public function create(array $data)
    {
        $mailingGroup = MailingGroup::create([
            'name' => trim($data['name'])
        ]);
        return $mailingGroup;
    }

    public function update($id, array $data)
    {
        $result = false;
        $mailingGroup = $this->find($id);
        if ($mailingGroup) {
            $mailingGroup->fill([
                'name' => trim($data['name'])
            ]);
            $result = $mailingGroup->save();
        }
        return $result;
    }

    public function delete($id)
    {
        $result = false;
        $mailingGroup = $this->find($id);
        if ($mailingGroup) {
            $result = $mailingGroup->delete($id);
        }
        return $result;
    }

    public function find($id, $columns = array('*'))
    {
        return MailingGroup::find($id, $columns);
    }

    public function addUserToMailingGroup($idMailingGroup, $idUser )
    {
        $result = false;
        $user = User::find($idUser);
        $mailingGroup = $this->find($idMailingGroup);
        if ($user && $mailingGroup){
            UserMailingGroup::firstOrCreate([
                'id_user' => $idUser,
                'id_mailing_group' => $idMailingGroup
            ]);
            $result = true;
        }
        return $result;
    }

    public function deleteUserFromMailingGroup($idMailingGroup, $idUser)
    {
        return UserMailingGroup::getByIdUserAndIdMailingGroup($idUser, $idMailingGroup)->delete();
    }

    public function getMailingGroupsWithSubscribers($id)
    {
        $mailingGroup = $this->find($id);
        if ($mailingGroup){
            $subscribers = User::getByMailingGroupId($id)->get();
            $mailingGroup->subscribers = $subscribers ? $subscribers : [];
        }
        return $mailingGroup;
    }
}