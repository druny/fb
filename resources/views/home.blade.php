
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   Привет {{ $user->name }}
                   <p>Твой email: {{ $user->email }}</p>
                    <p>Уровень доступа: {{ $user->role_id }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
