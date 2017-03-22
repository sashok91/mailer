@extends('layouts.adminpanel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">Mailing Details</h4>
                    </div>
                    <div class="panel-body">
                        <p><b> Mailing name: </b>{{ $mailing->name }}</p>
                        <p><b> Mailing theme: </b>{{ $mailing->email_theme }}</p>
                        <p><b> Mailing text: </b>{{ $mailing->email_text }}</p>
                        <p>
                            <b> Mailing groups: </b>
                        <ul>
                            @foreach($mailing->mailingGroups()->get() as $item)
                                <li> {{$item->name}} </li>
                            @endforeach
                        </ul>
                        </p>
                        <p><b> Sending date: </b>{{ $mailing->sending_date }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
