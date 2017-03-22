@extends('layouts.adminpanel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">New Mailing</h4>
                    </div>

                    <div class="panel-body">
                        @if($errors->has('common'))
                            <div class="alert alert-danger">{{ $errors->first('common')}}</div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/mailing') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Mailing Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email_theme') ? ' has-error' : '' }}">
                                <label for="email_theme" class="col-md-4 control-label">E-Mail Theme</label>

                                <div class="col-md-6">
                                    <input id="email_theme" type="text" class="form-control" name="email_theme"
                                           value="{{ old('email_theme') }}" autofocus>

                                    @if ($errors->has('email_theme'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email_theme') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email_text') ? ' has-error' : '' }}">
                                <label for="email_text" class="col-md-4 control-label">E-Mail Text</label>

                                <div class="col-md-6">
                                    <textarea rows="10" id="email_text" class="form-control" name="email_text">{{ old('email_text') }}</textarea>
                                    @if ($errors->has('email_text'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email_text') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('scheduled_date') ? ' has-error' : '' }}">
                                <label for="scheduled_date" class="col-md-4 control-label">Delivery date</label>

                                <div class="col-md-6">
                                    <input id="scheduled_date" type="datetime-local" class="form-control"
                                           name="scheduled_date"
                                           value="{{ old('scheduled_date') }}" >

                                    @if ($errors->has('scheduled_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('scheduled_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mailing-groups" class="col-md-4 control-label">Mailing Groups</label>
                                <div class="col-md-6">
                                    <select id="mailing-groups" class="form-control" name="mailing_groups[]" multiple
                                            required>
                                        @foreach (\App\Models\MailingGroup::all() as $mailingGroup)
                                            <option value="{{ $mailingGroup->id }}" {{old('mailing_groups') && in_array($mailingGroup->id,old('mailing_groups'))? 'selected':'' }}>
                                                {{ $mailingGroup->name }}
                                            </option>
                                        @endforeach
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
                                    <button type="submit" class="btn btn-primary">Save draft</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
