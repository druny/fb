@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Home Page</div>

                    <div class="panel-body">
                        @foreach($posts as $post => $post_value)
                            <div class="col-sm-6">
                                <div class="thumbnail">
                                    <span class="label label-primary">
                                        {{ $post_value->created_at }}
                                    </span>
                                    &nbsp;
                                    <a href="{{ route('category.show', $post_value->category->slug) }}">{{ $post_value->category->name }}</a>
                                    <img class="img-rounded" src="/uploads/original/{{ $post_value->img }}" alt="{{ $post_value->img_path }}">
                                    <div class="caption">
                                        <h3>{{ $post_value->title }}</h3>
                                        <h5>Slug: {{ $post_value->slug }}</h5>
                                        <p>{{ $post_value->short }}</p>
                                        <p>
                                            <a href="/post/{{ $post_value->slug }}" class="btn btn-primary" role="button">More</a>
                                        </p>

                                        @foreach($post_value->tags as $tag)
                                            <a href="{{ route('tag.show', $tag->name) }}" class="label label-danger">
                                                {{ $tag->name }}
                                            </a>
                                            &nbsp;
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
                    {{ isset($path) ? $posts->setPath($path)->links() : $posts->links() }}
            </div>
        </div>
    </div>
@endsection