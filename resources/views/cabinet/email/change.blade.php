
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Измененить E-mail</div>

                    <div class="panel-body">
                        <a class="btn btn-danger" href="{{ route('cabinet.settings') }}">Настройки</a>
                        <a class="btn btn-danger" href="{{ route('password.change') }}">Изменить пароль</a>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('email.update') }}">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Текущий E-mail </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('new_email') ? ' has-error' : '' }}">
                                <label for="new_email" class="col-md-4 control-label">Новый E-mail </label>

                                <div class="col-md-6">
                                    <input id="new_email" type="email" class="form-control" name="new_email" value="{{ old('new_email') }}" required>

                                    @if ($errors->has('new_email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new_email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
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
                        <div class="alert alert-warning">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
