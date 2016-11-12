@extends('layouts.adminpanel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">Subscriber</h4>
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
                                <label for="mailing-groups" class="col-md-4 control-label">Mailing Groups</label>
                                <div class="col-md-6">
                                    <select id="mailing-groups" class="form-control" name="mailing_groups[]" multiple required>
                                        @if(isset($user) && !old('mailing_groups'))
                                            @foreach (\App\Models\MailingGroup::all() as $mailingGroup)
                                                <option value="{{ $mailingGroup->id }}" {{$user->mailing_groups && in_array($mailingGroup->id, $user->mailing_groups)? 'selected':'' }}>
                                                    {{ $mailingGroup->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach (\App\Models\MailingGroup::all() as $mailingGroup)
                                                <option value="{{ $mailingGroup->id }}" {{old('mailing_groups') && in_array($mailingGroup->id,old('mailing_groups'))? 'selected':'' }}>
                                                    {{ $mailingGroup->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('mailing_groups'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mailing_groups') }}</strong>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
