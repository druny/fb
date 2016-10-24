
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Изменение пароля</div>

                    <div class="panel-body">
                        <a class="btn btn-danger" href="{{ route('cabinet.settings') }}">Настройки</a>
                        <a class="btn btn-danger" href="{{ route('email.change') }}">Изменить E-mail</a>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.update') }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}


                            <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                <label for="old_password" class="col-md-4 control-label">Old Password</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control" name="old_password" required>

                                    @if ($errors->has('old_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <label for="new_password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" required>

                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                                <label for="new_password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                                <div class="col-md-6">
                                    <input id="new_password-confirm" type="password" class="form-control" name="new_password_confirmation" required>

                                    @if ($errors->has('new_password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Change
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if(session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
