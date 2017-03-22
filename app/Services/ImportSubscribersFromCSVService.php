<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\SubscriberRepositoryInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportSubscribersFromCSVService extends AbstractImportFromCSV
{
    protected $users;

    public function __construct(SubscriberRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function import(Request $request)
    {
        $result = false;
        $mailingGroupsIds = $request->input('mailing_groups');
        $data = $this->parseFileFromRequest($request, 'csv');
        if ($data){
            foreach ($data->toArray() as $key => $item) {
                $dataForSave = [
                    'first_name' => isset($item['f_name']) ? $item['f_name'] : '',
                    'middle_name' => isset($item['m_name']) ? $item['m_name'] : '',
                    'last_name' => isset($item['l_name']) ? $item['l_name'] : '',
                    'email' => isset($item['email']) ? $item['email'] : '',
                    'password' => str_random(6),
                    'mailing_groups' => $mailingGroupsIds
                ];
                $existingUser = $this->users->findByEmail($dataForSave['email']);
                if ($existingUser) {
                    $this->users->saveUserMailingGroup($existingUser->id, $dataForSave['mailing_groups']);
                } else {
                    $this->users->create($dataForSave);
                }
            }
            $result = true;
        }
        return $result;
    }

}