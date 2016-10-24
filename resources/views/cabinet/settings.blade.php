
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Настройки личного профиля</div>

                    <div class="panel-body">
                        <a class="btn btn-danger" href="{{ route('password.change') }}">Изменить пароль</a>
                        <a class="btn btn-danger" href="{{ route('email.change') }}">Изменить E-mail</a>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('cabinet.update', $user->login ) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <br>
                            <div class="col-sm-6">
                                <label for="img" class="uploadButton">Загрузить Аватар</label>
                                <input style="opacity: 0; z-index: -1;" type="file" multiple accept="avatar/*" name="avatar" id="img">

                                <img id="img-preview" src="/uploads/avatars/150/{{ $user->avatar }}" >
                                <br/>
                                <a href="#" id="reset-img-preview">Удалить изображения</a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>
                                        {{ $errors->first('name') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <label for="surname" class="col-md-4 control-label">Surname</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control" name="surname" value="{{ $user->surname }}" required>

                                    @if ($errors->has('surname'))
                                        <span class="help-block">
                                        <strong>
                                        {{ $errors->first('surname') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" {{ $errors->has('login') ? ' has-error' : ''  }}>
                                <label for="login" class="col-md-4 control-label">Login</label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control" name="login" value="{{ $user->login  }}" required>

                                    @if ($errors->has('login'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('login')  }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label for="age" class="col-md-4 control-label">Age</label>

                                <div class="col-md-6">
                                    <input id="age" type="number" class="form-control" name="age" value="{{ $user->age }}" required>

                                    @if ($errors->has('age'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">City</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city" value="{{ $user->city }}" required>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Change
                                    </button>
                                </div>
                            </div>
                        </form>
                        @if(session('warning'))
                            <br>
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <br>
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
