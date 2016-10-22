@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin page</div>

                    <div class="panel-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @foreach($posts as $post => $post_value)
                            <div class="col-sm-6">
                                <div class="thumbnail">
                                    <span class="label label-primary">
                                        {{ $post_value->created_at }}
                                    </span>

                                    <a href="{{ route('category.show', $post_value->category->slug) }}">&nbsp;{{ $post_value->category->name }}</a>
                                    <img class="img-rounded" src="/uploads/original/{{ $post_value->img }}" alt="{{ $post_value->img_path }}">
                                    <div class="caption">
                                        <h3>{{ $post_value->title }}</h3>
                                        <h5>Slug: {{ $post_value->slug }}</h5>
                                        <p>{{ $post_value->short }}</p>
                                        @foreach($post_value->tags as $tag)
                                            <a href="{{ route('tag.show', $tag->name) }}" class="label label-danger">
                                                {{ $tag->name }}
                                            </a>
                                            &nbsp;
                                        @endforeach
                                        <div class="clearfix"></div>
                                        <br>
                                        <a href="{{ route('post.show', $post_value->slug) }}" class="btn btn-primary" role="button">More</a>

                                        <a href="{{ route('admin.edit', $post_value->slug) }}" class="btn btn-warning col-sm-4">Update</a>

                                        <form action="{{ route('admin.destroy', $post_value->slug) }}" method="post" class="col-sm-5">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger" type="submit">
                                                Delete
                                            </button>
                                        </form>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection