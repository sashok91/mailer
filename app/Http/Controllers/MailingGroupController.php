<?php

namespace App\Http\Controllers;

use App\Repositories\MailingGroupRepositoryInterface;
use App\Repositories\SubscriberRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class MailingGroupController extends Controller
{

    /**
     * The mailinggroup repository instance.
     */
    protected $mailingGroups;

    /**
     * The subscriber repository instance.
     */
    protected $subscribers;

    /**
     * AdminController constructor.
     * @param MailingGroupRepositoryInterface $mailingGroups
     * @param SubscriberRepositoryInterface $subscribers
     */
    public function __construct(MailingGroupRepositoryInterface $mailingGroups, SubscriberRepositoryInterface $subscribers)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('noPermissionsForMailingGroup');
        $this->mailingGroups = $mailingGroups;
        $this->subscribers = $subscribers;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSubscriber($id)
    {
        return view('pages.adminpanel.subscribersformailinggrouplist', [
            'subscribers' => $this->subscribers->all(),
            'mailingGroup' => $this->mailingGroups->find($id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.adminpanel.mailinggroupcreateedit',[
            'path' => url('/mailinggroup')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->mailingGroups->create($request->all());
        return redirect()->route('mailinggroup.index');
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
        $mailingGroup = $this->mailingGroups->getMailingGroupsWithSubscribers($id);
        if ($mailingGroup) {
            return view('pages.adminpanel.mailinggroupcreateedit', [
                'path' => url('/mailinggroup/' . $id),
                'mailingGroup' => $mailingGroup
            ]);
        } else {
            return redirect()->back()
                ->withErrors([
                    'common' => Lang::get('appmessages.mailing_group_not_found'),
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
        $result = $this->mailingGroups->update($id, $request->all());
        if ($result) {
            return redirect()->route('mailinggroup.index');
        } else {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors([
                    'common' => Lang::get('appmessages.failed_mailing_group_saving'),
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
        $result = $this->mailingGroups->delete($id);
        if ($result) {
            return redirect()->route('mailinggroup.index');
        } else {
            return redirect()->back()->withErrors([
                'common' => Lang::get('appmessages.failed_mailinggroup_deleting'),
            ]);
        }
    }

    public function deleteSubscriber($idMailingGroup, $idSubscriber){
        $result = $this->mailingGroups->deleteUserFromMailingGroup($idMailingGroup, $idSubscriber);
        if ($result) {
            return redirect()->route('mailinggroup.index');
        } else {
            return redirect()->back()->withErrors([
                'common' => Lang::get('appmessages.failed_mailinggroup_subscriber_deleting'),
            ]);
        }
    }

    public function addSubscriber($idMailingGroup, $idSubscriber){
        $result = $this->mailingGroups->addUserToMailingGroup($idMailingGroup, $idSubscriber);
        if ($result) {
            return redirect()->route('mailinggroup.index');
        } else {
            return redirect()->back()->withErrors([
                'common' => Lang::get('appmessages.failed_mailinggroup_subscriber_adding'),
            ]);
        }
    }
}
