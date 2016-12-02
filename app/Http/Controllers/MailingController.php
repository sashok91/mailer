<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMailingRequest;
use App\Repositories\MailingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailingController extends Controller
{

    protected $mailings;

    public function __construct(MailingRepositoryInterface $mailings)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('noPermissionsForMailing');
        $this->mailings = $mailings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.adminpanel.mailinglist', [
            'mailings' => $this->mailings->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.adminpanel.mailingcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMailingRequest $request)
    {
        $this->mailings->create($request->all());
        return redirect()->route('mailing.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.adminpanel.mailingdetails', [
            'mailing' => $this->mailings->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mailing = $this->mailings->find($id);
        if ($mailing) {
            return view('pages.adminpanel.mailingedit', [
                'mailing' => $mailing
            ]);
        } else {
            return redirect()->back()
                ->withErrors([
                    'common' => Lang::get('appmessages.mailing_not_found'),
                ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = $this->mailings->update($id, $request->all());
        if ($result) {
            return redirect()->route('mailing.index');
        } else {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors([
                    'common' => Lang::get('appmessages.failed_mailing_saving'),
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->mailings->delete($id);
        if ($result) {
            return redirect()->route('mailing.index');
        } else {
            return redirect()->back()->withErrors([
                'common' => Lang::get('appmessages.failed_mailing_deleting'),
            ]);
        }
    }

    public function send(){

    }
}
