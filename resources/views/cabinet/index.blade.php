
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Личный кабинет</div>

                <div class="panel-body">
                    <table class="table-responsive table">
                        <div class="col-sm-9">
                            <h3>Привет {{ $user->name }} {{ $user->surname }}</h3>
                        </div>
                        <div class="col-sm-3">
                            <img style="border-radius: 50%; "  src="/uploads/avatars/150/{{ $user->avatar }}" >
                        </div>
                        <tr>
                            <th>
                                <p>Твой email: </p>
                            </th>
                            <td>
                                <p>{{ $user->email }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p>Логин: </p>
                            </th>
                            <td>
                                <p>{{ $user->login }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p>Возраст: </p>
                            </th>
                            <td>
                                <p>{{ $user->age }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p>Город:</p>
                            </th>
                            <td>
                                <p>{{ $user->city }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p>Тип пользователя: </p>
                            </th>
                            <th>
                                <p>{{ $user->role->role }}</p>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <p>Дата регистрации: </p>
                            </th>
                            <td>
                                <p>{{ $user->created_at }}</p>
                            </td>
                        </tr>
                    </table>


                    <br>
                    <h4>Выберете теги, по которым вы бы хотели видеть новости в вашей ленте</h4>

                    <form class="form-horizontal" role="form" action="{{ route('feed.feed') }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('POST') }}

                        @foreach($tags as $tag)

                        <input id="{{ $tag->name }}" type="checkbox" name="tag[]" value="{{ $tag->id }}"  @foreach($feeds as $feed)@if($feed->tag_id == $tag->id) checked @endif @endforeach>
                            <label for="{{ $tag->name }}">{{ $tag->name }}</label>
                            <br>
                        @endforeach

                        <br>

                        <input class="btn btn-danger" type="submit" value="Update">

                    </form>
                    <br>
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
</div>
@endsection
