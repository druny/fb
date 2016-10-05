@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @foreach($posts as $post => $post_value)
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="..." alt="{{ $post_value->img_path }}">
                                    <div class="caption">
                                        <h3>{{ $post_value->title }}</h3>
                                        <h5>Slug: {{ $post_value->slug }}</h5>
                                        <p>{{ $post_value->short }}</p>
                                        <p>
                                            <a href="#!" class="btn btn-primary" role="button">More</a>
                                        </p>
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