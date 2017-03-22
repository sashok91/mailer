@extends('layouts.adminpanel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">Mailing Group</h4>
                        @if(isset($mailingGroup))
                            <div class="btn-group pull-right">
                                <a href="{{ url('/mailinggroup/' . $mailingGroup->id . '/subscriber') }}"
                                   class="btn btn-default btn-sm">Add Subscribers</a>
                            </div>
                        @endif
                    </div>

                    <div class="panel-body">
                        @if($errors->has('common'))
                            <div class="alert alert-danger">{{ $errors->first('common')}}</div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ $path }}">
                            {{ csrf_field() }}
                            @if(isset($mailingGroup))
                                {{ method_field('PUT') }}
                                <input type="hidden" name="id" value="{{ $mailingGroup->id }}">
                            @endif
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    @if(isset($mailingGroup))
                                        <input id="first_name" type="text" class="form-control" name="name"
                                               value="{{ old('name') ? old('name') : $mailingGroup->name  }}"
                                               required autofocus>
                                    @else
                                        <input id="first_name" type="text" class="form-control" name="name"
                                               value="{{ old('name') }}" required autofocus>
                                    @endif
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                        @if(isset($mailingGroup))
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mailingGroup->subscribers as $subscriber)
                                    <tr>
                                        <td>
                                            {{$subscriber->getFullName()}}
                                        </td>
                                        <td>
                                            {{$subscriber->email}}
                                        </td>
                                        <td>
                                            <a href="{{ url('/mailinggroup/' . $mailingGroup->id . '/subscriber/' . $subscriber->id) }}"
                                               onclick="event.preventDefault(); document.getElementById('{{'delete-form' . $subscriber->id}}').submit();">
                                                Delete
                                            </a>
                                            <form id="{{'delete-form' . $subscriber->id}}"
                                                  action="{{ url('/mailinggroup/' . $mailingGroup->id . '/subscriber/' . $subscriber->id) }}"
                                                  method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
