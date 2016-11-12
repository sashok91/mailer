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
                            @if(isset($user))
                                {{ method_field('PUT') }}
                                <input type="hidden" name="id" value="{{ $user->id }}">
                            @endif
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label">First Name</label>

                                <div class="col-md-6">
                                    @if(isset($user))
                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                               value="{{ old('first_name') ? old('first_name') : $user->first_name  }}"
                                               required autofocus>
                                    @else
                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                               value="{{ old('first_name') }}" required autofocus>
                                    @endif
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                                <label for="middle_name" class="col-md-4 control-label">Middle Name</label>

                                <div class="col-md-6">
                                    @if(isset($user))
                                        <input id="middle_name" type="text" class="form-control" name="middle_name"
                                               value="{{ old('middle_name') ? old('middle_name') : $user->middle_name  }}">
                                    @else
                                        <input id="middle_name" type="text" class="form-control" name="middle_name"
                                               value="{{ old('middle_name') }}">
                                    @endif
                                    @if ($errors->has('middle_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-6">
                                    @if(isset($user))
                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                               value="{{ old('last_name') ? old('last_name') : $user->last_name  }}">
                                    @else
                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                               value="{{ old('last_name') }}">
                                    @endif
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    @if(isset($user))
                                        <input id="email" type="text" class="form-control" name="email"
                                               value="{{ $user->email  }}" >
                                    @else
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required>
                                    @endif
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
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
