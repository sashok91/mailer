<?php

namespace App\Http\Controllers;

use App\Repositories\MailingGroupRepositoryInterface;
use Illuminate\Http\Request;

class MailingGroupController extends Controller
{

    /**
     * The user repository instance.
     */
    protected $mailingGroups;

    /**
     * AdminController constructor.
     * @param MailingGroupRepositoryInterface $mailingGroups
     */
    public function __construct(MailingGroupRepositoryInterface $mailingGroups)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('noPermissionsForMailingGroup');
        $this->mailingGroups = $mailingGroups;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.adminpanel.mailinggrouplist', [
            'mailingGroups' => $this->mailingGroups->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->mailingGroups->delete($id);
        if ($result) {
            return redirect()->route('mailinggroup.index');
        } else {
            return redirect()->back()->withErrors([
                'common' => Lang::get('appmessages.failed_mailinggroup_deleting'),
            ]);
        }
    }
}
