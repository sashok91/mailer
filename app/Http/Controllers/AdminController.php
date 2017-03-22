<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\User;
use App\Repositories\AdminRepository;
use App\Repositories\AdminRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;

class AdminController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $admins;

    /**
     * AdminController constructor.
     * @param AdminRepository $admins
     */
    public function __construct(AdminRepositoryInterface $admins)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->admins = $admins;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.adminpanel.adminslist', [
            'admins' => $this->admins->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.adminpanel.admincreateedit',[
            'path' => url('/admin')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAdminRequest $request)
    {
        $this->admins->create($request->all());
        return redirect()->route('admin.index');
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
        $user = $this->admins->getAdminWithPermissionsIdArray($id);
        if ($user) {
            return view('pages.adminpanel.admincreateedit', [
                'path' => url('/admin/' . $id),
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
     * @param UpdateAdminRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAdminRequest $request, $id)
    {

        $result = $this->admins->update($id, $request->all());
        if ($result) {
            return redirect()->route('admin.index');
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
        $result = $this->admins->delete($id);
        if ($result) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()->withErrors([
                'common' => Lang::get('appmessages.failed_user_deleting'),
            ]);
        }
    }
}
