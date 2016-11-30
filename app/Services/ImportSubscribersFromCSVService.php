<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\SubscriberRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ImportSubscribersFromCSVService
{
    protected $users;

    protected $rules = [
        'first_name' => 'required|max:255',
        'middle_name' => 'max:255',
        'last_name' => 'max:255',
        'email' => 'required|email|max:255',
        'password' => 'required',
        'mailing_groups' => 'required|array'
    ];

    public function __construct(SubscriberRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function import(Request $request)
    {
        $result = false;
        $mailingGroupsIds = $request->input('mailing_groups');
        if ($request->hasFile('csv')) {
            $path = $request->file('csv')->getRealPath();
            $data = Excel::load($path)->get();
            foreach ($data->toArray() as $key => $value) {
                $dataForSave = [
                    'first_name' => trim($value['f_name']),
                    'middle_name' => trim($value['m_name']),
                    'last_name' => trim($value['l_name']),
                    'email' => trim($value['email']),
                    'password' => bcrypt((string)time()),
                    'mailing_groups' => $mailingGroupsIds
                ];
                $validator = Validator::make($dataForSave,  $this->rules);
                if (!$validator->fails()){
                    $existingUser = $this->users->findByEmail($dataForSave['email']);
                    if ($existingUser){
                        $this->users->saveUserMailingGroup($existingUser->id, $dataForSave['mailing_groups']);
                    } else {
                        $this->users->create($dataForSave);
                    }
                }
            }
            $result = true;
        }
        return $result;
    }
}