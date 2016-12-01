<?php

namespace App\Repositories;


use App\Models\User;
use App\Models\UserMailingGroup;
use Illuminate\Support\Facades\Validator;

class SubscriberRepository implements SubscriberRepositoryInterface
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    protected $rulesForCreate = [
        'first_name' => 'required|max:255',
        'middle_name' => 'max:255',
        'last_name' => 'max:255',
        'email' => 'required|email|max:255',
        'password' => 'required',
        'mailing_groups' => 'required|array',
        'role' => 'in:' . User::USER_ROLE_SUBSCRIBER
    ];

    protected $rulesForUpdate = [
        'first_name' => 'max:255',
        'middle_name' => 'max:255',
        'last_name' => 'max:255',
        'email' => 'email|max:255',
        'mailing_groups' => 'array',
        'role' => 'in:' . User::USER_ROLE_SUBSCRIBER
    ];

    public function all($columns = array('*'))
    {
        return User::getSubscribers()->get($columns);
    }

    public function create(array $data)
    {
        $user = null;
        if ($this->isValidForCreate($data)){
            $dataForSave = [
                'first_name' => trim($data['first_name']),
                'middle_name' => trim($data['middle_name']),
                'last_name' => trim($data['last_name']),
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => User::USER_ROLE_SUBSCRIBER
            ];
            $user = User::create($dataForSave);
            $this->saveUserMailingGroup($user->id, $data['mailing_groups']);
        }
        return $user;
    }

    public function update($id, array $data)
    {
        $result = false;
        $user = $this->find($id);
        if ($user && $this->isValidForUpdate($data)) {
            $dataForSave = [];
            $fillableAttr = $user->getFillable();
            foreach ($fillableAttr as $key => $attrName) {
                if (array_key_exists($attrName, $data)){
                    if ($attrName === 'password'){
                        $value = bcrypt($data[$attrName]);
                    } else {
                        $value = trim($data[$attrName]);
                    }
                    $dataForSave[$attrName] = $value;
                }
            }
            $user->fill($dataForSave);
            $result = $user->save();
            UserMailingGroup::getByIdUser($id)->delete();
            $this->saveUserMailingGroup($id, $data['mailing_groups']);
        }
        return $result;
    }

    public function saveUserMailingGroup($idUser, array $mailingGroupsIds){
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
        return User::getSubscribers()->find($id, $columns);
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

    public function findByEmail($email){
        return User::getByEmail($email)->first();
    }

    public function isValidForCreate($data){
        return $this->isValid($data, $this->rulesForCreate);
    }

    public function isValidForUpdate($data){
        return $this->isValid($data, $this->rulesForUpdate);
    }

    private function isValid($data, $rules){
        $result = false;
        $validator = Validator::make($data, $rules);
        if (!$validator->fails()){
            $result = true;
        }
        return $result;
    }
}