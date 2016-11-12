@extends('layouts.adminpanel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">Mailing group</h4>
                    </div>

                    <div class="panel-body">
                        <div>
                            <h5>{{ $mailingGroup->name }}</h5>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subscribers as $subscriber)
                                <tr>
                                    <td>
                                        {{$subscriber->getFullName()}}
                                    </td>
                                    <td>
                                        {{$subscriber->email}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
