<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Models\User;
use App\Repositories\SubscriberRepositoryInterface;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $subscribers;

    /**
     * AdminController constructor.
     * @param SubscriberRepositoryInterface $subscribers
     */
    public function __construct(SubscriberRepositoryInterface $subscribers)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('noPermissionsForSubscriber');
        $this->subscribers = $subscribers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.adminpanel.subscriberlist', [
            'subscribers' => $this->subscribers->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.adminpanel.subscribercreateedit',[
            'path' => url('/subscriber')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubscriberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSubscriberRequest $request)
    {
        $this->subscribers->create($request->all());
        return redirect()->route('subscriber.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->subscribers->getSubscriberWithMailingGroupsIdArray($id);
        if ($user) {
            return view('pages.adminpanel.subscribercreateedit', [
                'path' => url('/subscriber/' . $id),
                'user' => $user
            ]);
        } else {
            return redirect()->back()
                ->withErrors([
                    'common' => Lang::get('appmessages.user_not_found'),
                ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSubscriberRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSubscriberRequest $request, $id)
    {

        $result = $this->subscribers->update($id, $request->all());
        if ($result) {
            return redirect()->route('subscriber.index');
        } else {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors([
                    'common' => Lang::get('appmessages.failed_user_saving'),
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $result = $this->subscribers->delete($id);
        if ($result) {
            return redirect()->route('subscriber.index');
        } else {
            return redirect()->back()->withErrors([
                'common' => Lang::get('appmessages.failed_user_deleting'),
            ]);
        }
    }
}
