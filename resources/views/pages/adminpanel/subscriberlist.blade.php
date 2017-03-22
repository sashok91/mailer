@extends('layouts.adminpanel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">subscribers</h4>
                        <div class="btn-group pull-right">
                            <a href="{{ url('/subscriber/create') }}" class="btn btn-default btn-sm">Add New Subscriber</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Edit</th>
                                <th>Delete</th>
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
                                        <a href="{{ url('/subscriber/' . $subscriber->id . '/edit') }}">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/subscriber/' . $subscriber->id) }}"
                                           onclick="event.preventDefault(); document.getElementById('{{'delete-form' . $subscriber->id}}').submit();">
                                            Delete
                                        </a>
                                        <form id="{{'delete-form' . $subscriber->id}}" action="{{ url('/subscriber/' . $subscriber->id) }}" method="POST"
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
