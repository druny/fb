@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Tags</div>

                    <div class="panel-body">
                        @foreach($tags as $tag)
                            <div class="col-sm-6">
                                <div class="thumbnail">

                                    <div class="caption">
                                        <h3>{{ $tag->name }}</h3>
                                        <h5>Slug: {{ $tag->slug }}</h5>
                                        <p>{!! $tag->description !!} </p>

                                        <a href="{{ route('tag.show', $tag->name) }}" class="btn btn-primary" role="button">Posts</a>

                                        <a href="{{ route('tags.edit', $tag->name) }}" class="btn btn-warning col-sm-4">Update</a>

                                        <form action="{{ route('tags.destroy', $tag->name) }}" method="post" class="col-sm-5">
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
            </div>
        </div>
    </div>
@endsection