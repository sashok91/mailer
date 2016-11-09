@extends('layouts.app')

@section('left-side-of-navbar')
    <ul class="nav navbar-nav">
        <li><a href="{{ url('/adminpanel/admins') }}">Admins</a></li>
        <li><a href="{{ url('/adminpanel/subscribers') }}">Subscribers</a></li>
        <li><a href="{{ url('/adminpanel/mailinggroups') }}">Mailing Groups</a></li>
        <li><a href="{{ url('/adminpanel/mailing') }}">Mailings</a></li>
    </ul>
@endsection
