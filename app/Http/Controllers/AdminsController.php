<?php

namespace App\Http\Controllers;


use App\Logic\AdminLogicTrait;
use App\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    use AdminLogicTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAdminListView()
    {
        $admins = User::getAdminsList()->get();
        return view('pages.adminpanel.adminslist', [
            'admins' => $admins
        ]);
    }

    public function showAdminCreateView()
    {
        return view('pages.adminpanel.admincreateedit',[
            'path' => url('/admin/create')
        ]);
    }

    public function showAdminUpdateView($id)
    {
        $user = User::find($id);
        return $user ?
            view('pages.adminpanel.admincreateedit', [
                'path' => url('/admin/update'),
                'user' => $user
            ]) :
            redirect()->back()
                ->withErrors([
                    'common' => Lang::get('appmessages.user_not_found'),
                ]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'middle_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'required|email|max:255|unique:user',
            'password' => 'required|min:6|confirmed',
            'permissions' => 'required|array'
        ]);
        $this->createAdmin($request->all());
        return $this->showAdminListView();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'first_name' => 'required|max:255',
            'middle_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'permissions' => 'required|array'
        ]);
        $result = $this->updateAdmin($request->all());
        return $result ? $this->showAdminListView() : redirect()->back()
            ->withInput($request->all())
            ->withErrors([
                'common' => Lang::get('appmessages.failed_user_saving'),
            ]);
    }

    public function delete($id)
    {
        $result = $this->deleteAdmin($id);
        return $result ? $this->showAdminListView() : redirect()->back()
            ->withErrors([
                'common' => Lang::get('appmessages.failed_user_deleting'),
            ]);
    }
}