@extends('layouts.adminpanel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">subscribers</h4>
                        <div class="btn-group pull-right">
                            <a href="{{ url('/mailinggroup/create') }}" class="btn btn-default btn-sm">Add New Mailing Group</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mailinggroups as $mailinggroup)
                                <tr>
                                    <td>
                                        {{$mailinggroup->name()}}
                                    </td>
                                    <td>
                                        <a href="{{ url('/mailinggroup/' . $mailinggroup->id . '/edit') }}">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/mailinggroup/' . $mailinggroup->id) }}"
                                           onclick="event.preventDefault(); document.getElementById('{{'delete-form' . $mailinggroup->id}}').submit();">
                                            Delete
                                        </a>
                                        <form id="{{'delete-form' . $mailinggroup->id}}" action="{{ url('/mailinggroup/' . $mailinggroup->id) }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
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
