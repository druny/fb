@extends('layouts.app')

@section('content')
    <div class="container">


        <script>
            tinymce.init({
                selector: '#description',
                themes: "modern",
                plugins : 'advlist autolink link image lists charmap print preview ',
                a_plugin_option: true,
                a_configuration_option: 400,
            });
        </script>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-danger">
                    <div class="panel-heading">Edit tag</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('tags.update', $tag->name) }}"  enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{ $tag->id }}">

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            @if(session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif
                            @if(session('status'))
                                <div class="alert alert-warning">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-xs-12">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $tag->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>
                                        {{ $errors->first('name') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Text</label>

                                <div class="col-xs-12">
                                    <textarea id="description"  type="text" class="form-control" name="description" value="{{ $tag->description }}" >{{ $tag->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>
                                                {{ $errors->first('description') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection