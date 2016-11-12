@extends('layouts.app')

@section('left-side-of-navbar')
    <ul class="nav navbar-nav">
        <?php $user = Auth::user(); ?>
        <li><a href="{{ url('/admin') }}">Admins</a></li>
        @if ($user->hasSubscriberPermissions())
            <li><a href="{{ url('/subscriber') }}">Subscribers</a></li>
        @endif
            @if ($user->hasMailingGroupPermissions())
                <li><a href="{{ url('/mailinggroup') }}">Mailing Groups</a></li>
            @endif
            @if ($user->hasMailingPermissions())
                <li><a href="{{ url('/mailing') }}">Mailings</a></li>
            @endif
    </ul>
@endsection
