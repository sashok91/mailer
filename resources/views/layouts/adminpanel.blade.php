@extends('layouts.app')

@section('left-side-of-navbar')
    <ul class="nav navbar-nav">
        <li><a href="{{ url('/admin') }}">Admins</a></li>
        <li><a href="{{ url('/subscriber') }}">Subscribers</a></li>
        <li><a href="{{ url('/mailinggroup') }}">Mailing Groups</a></li>
        <li><a href="{{ url('/mailing') }}">Mailings</a></li>
    </ul>
@endsection
