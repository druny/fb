@extends('layouts.app')

@section('content')
    <div class="container">


    <script>
        tinymce.init({
            selector: '#create-text',
            themes: "modern",
            plugins : 'advlist autolink link image lists charmap print preview ',
            a_plugin_option: true,
            a_configuration_option: 400,
        });
    </script>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Added new post</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.update', $post->slug) }}"  enctype="multipart/form-data">
                            <input type="text" value="{{ $post->id }}" name="id" hidden required>
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="slug" class="col-md-4 control-label">Url</label>

                                <div class="col-md-6">
                                    <input id="slug" type="slug" class="form-control" name="slug" value="{{ $post->slug }}" required>

                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>
                                        {{ $errors->first('slug') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
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

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $post->title }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>
                                        {{ $errors->first('title') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <label for="img" class="uploadButton">Загрузить изображение</label>
                            <input style="opacity: 0; z-index: -1;" type="file" multiple accept="image/*" name="img" id="img">

                            {{ $post->img }}
                            <div>
                                <img id="img-preview" src="/uploads/original/{{ $post->img }}" >
                                <br/>
                                <a href="#" id="reset-img-preview">удалить изображения</a>
                            </div>

                            <div class="form-group{{ $errors->has('short') ? ' has-error' : '' }}">
                                <label for="short" class="col-md-4 control-label">Short text</label>

                                <div class="col-md-6">
                                    <textarea id="short" type="text" class="form-control" name="short" value="{{ $post->short }}" required>{{ $post->short }}</textarea>
                                    @if ($errors->has('short'))
                                        <span class="help-block">
                                        <strong>
                                        {{ $errors->first('short') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                                <label for="create-text" class="col-md-4 control-label">Text</label>

                                <div class="col-md-6">
                                    <textarea id="create-text"  type="text" class="form-control" name="text" value="{{ $post->text }}" >{{ $post->text }}</textarea>
                                    @if ($errors->has('text'))
                                        <span class="help-block">
                                            <strong>
                                                {{ $errors->first('text') }}
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