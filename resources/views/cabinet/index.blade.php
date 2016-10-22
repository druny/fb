
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   Привет {{ $user->name }} {{ $user->surname }}
                   <p>Твой email: {{ $user->email }}</p>
                    <p>Возраст: {{ $user->age }}</p>
                    <p>Город: {{ $user->city }}</p>
                    <p>Тип пользователя: {{ $user->role->role }}</p>
                    <p>Дата регистрации: {{ $user->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
