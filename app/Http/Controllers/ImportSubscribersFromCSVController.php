<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportSubscribersFromCSVRequest;
use App\Repositories\MailingGroupRepositoryInterface;
use App\Services\ImportSubscribersFromCSVService;
use Illuminate\Support\Facades\Lang;

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
            return back()->with('error', Lang::get('failed_import_csv_subscribers'));
        }
    }

}
