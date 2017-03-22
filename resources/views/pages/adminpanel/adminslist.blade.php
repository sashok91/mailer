@extends('layouts.adminpanel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">Admins</h4>
                        <div class="btn-group pull-right">
                            <a href="{{ url('/admin/create') }}" class="btn btn-default btn-sm">Add New Admin</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>
                                        {{$admin->getFullName()}}
                                    </td>
                                    <td>
                                        {{$admin->email}}
                                    </td>
                                    <td>
                                        <a href="{{ url('/admin/' . $admin->id . '/edit') }}">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/admin/' . $admin->id) }}"
                                           onclick="event.preventDefault(); document.getElementById('{{'delete-form' . $admin->id}}').submit();">
                                            Delete
                                        </a>
                                        <form id="{{'delete-form' . $admin->id}}" action="{{ url('/admin/' . $admin->id) }}" method="POST"
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
