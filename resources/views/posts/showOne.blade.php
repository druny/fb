
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <h1 class="panel-heading">{{ $post->title }}</h1>
    
                    <div class="panel-body">
                        <span class="label label-primary">
                            {{ $post->created_at }}
                        </span>

                        <div class="clearfix"></div>
                            <br>
                        <img style="width: 100%;" src="/uploads/original/{{ $post->img }}" alt="">
                        <p>{{ $post->short }}</p>
                        <div class="jumbotron">
                            {!! $post->text !!}
                        </div>
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tag.show', $tag->name) }}" class="label label-danger">
                                {{ $tag->name }}
                            </a>
                            &nbsp;
                        @endforeach

                        <p class="col-sm-offset-10">
                            <button onclick="history.go(-1)" class="btn btn-primary" role="button">Back</button>
                        </p>
                        <h2 class="title-section">
                            <span class="heading-line">Комментарии</span>
                        </h2>
                        <div class="col-xs-12">
                            <h2 class="title-section">
                                <span class="heading-line">Оставить комментарий</span>
                            </h2>

                            @if (Auth::check())
                                <img src="/uploads/avatars/150/{{ (Auth::user()->avatar) }}">
                                <form action="{{ route('comment.store') }}" method="post" class="text-center">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="form-group" id="add-comment-group">
                                        <textarea class="form-control comment-field" name="text" placeholder="Текст комментария" ></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger">Отправить</button>
                                </form>
                            @else
                                <div class="alert alert-warning">
                                    Войдите, чтобы иметь возможность оставлять комментарии или голосовать
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
