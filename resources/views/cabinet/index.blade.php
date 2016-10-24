
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
                    <br>
                    <h4>Выберете теги, по которым вы бы отели видеть новости в вашей ленте</h4>

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
