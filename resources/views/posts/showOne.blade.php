
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
                        &nbsp
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tag.show', $tag->name) }}" class="label label-danger">
                                {{ $tag->name }}
                            </a>
                            &nbsp;
                        @endforeach
                        <div class="clearfix"></div>
                            <br>
                        <img style="width: 100%;" src="/uploads/original/{{ $post->img }}" alt="">
                        <p>{{ $post->short }}</p>
                        <div class="jumbotron">
                            {!! $post->text !!}
                        </div>

                        <p class="col-sm-offset-10">
                            <button onclick="history.go(-1)" class="btn btn-primary" role="button">Back</button>
                        </p>

                        <h3 class="title-section">
                            <span class="heading-line">Комментарии</span>
                        </h3>
                        <hr>
                        <div class="col-xs-12">
                            <h4 class="title-section">
                                <span class="heading-line">Оставить комментарий</span>
                            </h4>

                            @if (Auth::check())
                                <img style="border-radius: 50%;" class=" col-sm-2" src="/uploads/avatars/150/{{ (Auth::user()->avatar) }}">
                                <form action="{{ route('comment.store') }}" method="post" class="text-center col-sm-10 post-comment-field">
                                    {{ csrf_field() }}
                                    <div class="col-sm-9">
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <div class="form-group" id="add-comment-group">
                                            <textarea class="form-control comment-field" name="text" placeholder="Текст комментария" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-danger col-sm-3 post-comment-field">Отправить</button>
                                </form>
                            @else
                                <div class="alert alert-warning">
                                    Войдите, чтобы иметь возможность оставлять комментарии или голосовать
                                </div>
                            @endif
                            <div class="clearfix"></div>
                            <hr>
                            <div class="comments">
                                @foreach($comments as $comment)
                                    <div class="comment">
                                        <a class="comment-user-info col-sm-2">
                                            <img src="/uploads/avatars/60/{{ $comment->user->avatar }}" alt="" class="avatar ">
                                            <p>{{ $comment->user->name }}</p>
                                        </a>
                                        <div class="comment-text col-sm-7">
                                            {{ $comment->text }}
                                        </div>
                                        <div class="date sol-sm-3">
                                            {{ $comment->created_at }}
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                @endforeach
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
