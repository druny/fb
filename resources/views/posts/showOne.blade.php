
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <h1 class="panel-heading">{{ $post->title }}</h1>
    
                    <div class="panel-body">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tag.show', $tag->name) }}" class="label label-danger">
                                {{ $tag->name }}
                            </a>
                            &nbsp;
                        @endforeach
                        <div class="clearfix"></div>
                            <br>
                        <img src="/uploads/800/{{ $post->img }}" alt="">
                        <p>{{ $post->short }}</p>
                        <div class="jumbotron">
                            {!! $post->text !!}
                        </div>
                        <span class="label label-primary">
                            {{ $post->created_at }}
                        </span>
                    </div>
                    <p class="col-sm-offset-10">
                        <button onclick="history.go(-1)" class="btn btn-primary" role="button">Back</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
