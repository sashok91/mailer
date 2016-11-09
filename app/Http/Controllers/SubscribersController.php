<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSubscribePage()
    {
        return view('pages.subscribe');
    }

    /**
     * Create new subscriber
     */
    public function createSubscriber(Request $request){
       $this->validate($request, [
           'first_name' => 'required| max:255',
           'middle_name' => 'max:255',
           'last_name' => 'max:255',
           'email' => 'email',
       ]);
       return view('pages.subscriptionresult');
    }


}