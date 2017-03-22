@extends('layouts.adminpanel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">Mailings</h4>
                        <div class="btn-group pull-right">
                            <a href="{{ url('/mailing/create') }}" class="btn btn-default btn-sm">Create New Mailing</a>
                        </div>
                        <div class="btn-group pull-right">
                            <a href="{{ url('/mailing') }}" class="btn btn-default btn-sm">Show Drafts</a>
                        </div>
                    </div>
                    @if (isset($status))
                        <div class="alert alert-success">
                            {{ $status }}
                        </div>
                    @endif
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>

                            <tr>
                                <th>Status</th>
                                <th>Mailing Name</th>
                                <th>Date</th>
                                <th>More info</th>
                                <th>Send</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mailings as $mailing)
                                <tr>
                                    <td>
                                        {{$mailing->status}}
                                    </td>
                                    <td>
                                        {{$mailing->name}}
                                    </td>
                                    <td>
                                        {{$mailing->sending_date}}
                                    </td>
                                    <td>
                                        <a href="{{ url('/mailing/' . $mailing->id) }}">Show</a>
                                    </td>
                                    @if($mailing->status == \App\Models\Mailing::STATUS_DRAFT)
                                        <td>
                                            <a href="{{ url('/mailing/' . $mailing->id . '/send') }}">Send</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/mailing/' . $mailing->id . '/edit') }}">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/mailing/' . $mailing->id) }}"
                                               onclick="event.preventDefault(); document.getElementById('{{'delete-form' . $mailing->id}}').submit();">
                                                Delete
                                            </a>
                                            <form id="{{'delete-form' . $mailing->id}}" action="{{ url('/mailing/' . $mailing->id) }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </td>
                                    @endif
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
