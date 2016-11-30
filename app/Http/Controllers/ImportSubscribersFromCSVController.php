<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportSubscribersFromCSVRequest;
use App\Repositories\MailingGroupRepositoryInterface;
use App\Services\ImportSubscribersFromCSVService;

class ImportSubscribersFromCSVController extends Controller
{
    protected $importService;
    protected $mailingGroups;

    public function __construct(ImportSubscribersFromCSVService $importSubscribersFromCSVService, MailingGroupRepositoryInterface $mailingGroups)
    {
        $this->importService = $importSubscribersFromCSVService;
        $this->mailingGroups = $mailingGroups;
    }

    public function showImportView(){
        return view('pages.adminpanel.importsaubscribers');
    }

    public function import(ImportSubscribersFromCSVRequest $request){
        $result = $this->importService->import($request);
        if ($result){
            return view('pages.adminpanel.mailinggrouplist', [
                'mailingGroups' => $this->mailingGroups->all()
            ]);
        } else {
            return back()->with('error','Please Check your file. Something is wrong there.');
        }
    }

}
