@extends('layouts.adminpanel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">Subscribers for Adding to {{$mailingGroup->name}}</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Add</th>
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
                                    <td>
                                        <a href="{{ url('/mailinggroup/' . $mailingGroup->id . '/subscriber/' . $subscriber->id) }}"
                                           onclick="event.preventDefault(); document.getElementById('{{'add-form' . $subscriber->id}}').submit();">
                                            Add
                                        </a>
                                        <form id="{{'add-form' . $subscriber->id}}" action="{{ url('/mailinggroup/' . $mailingGroup->id . '/subscriber/' . $subscriber->id) }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
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
