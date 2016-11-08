@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if($user && $user->isAdmin())
                            You are Admin
                        @elseif($user && $user->isSubscriber())
                            You are Subscriber
                        @else
                            You are neither nor admin nor subscriber
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
