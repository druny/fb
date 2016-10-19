@extends('layouts.app')

@section('content')

    <script>
        tinymce.init({
            selector: '#create-text',
            themes: "modern",
            plugins : 'advlist autolink link image lists charmap print preview ',
            a_plugin_option: true,
            a_configuration_option: 400,
        });
    </script>

    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Added new post</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.store') }}"  enctype="multipart/form-data">
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="slug" class="col-md-4 control-label">Url</label>

                                <div class="col-md-6">
                                    <input id="slug" type="slug" class="form-control" name="slug" value="{{ old('slug') }}" required>

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
                            {{ method_field('POST') }}
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
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>
                                        {{ $errors->first('title') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="category col-sm-10  col-xs-12">
                                <label for="category">Select category</label>
                                <select name="category_id" class="form-control" id="category">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>

                            <div class="js-example-basic-multiple col-sm-2  col-xs-12 js-example-basic-multiple" multiple="multiple">
                                <label for="tags">
                                    Select tags
                                    <br>
                                    <select class="tags js-example-basic-multiple" id="tags" name="tags[]" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <br>
                            <div class="clearfix"></div>
                            <label for="img" class="uploadButton">Загрузить изображение</label>
                            <input style="opacity: 0; z-index: -1;" type="file" multiple accept="image/*" name="img" id="img">


                            <div>
                                <img id="img-preview" src="/img/f&b.jpg" >
                                <br/>
                                <a href="#" id="reset-img-preview">Удалить изображения</a>
                            </div>

                            <div class="form-group{{ $errors->has('short') ? ' has-error' : '' }}">
                                <label for="short" class="col-md-4 control-label">Short text</label>

                                <div class="col-md-6">
                                    <textarea id="short" type="text" class="form-control" name="short" value="{{ old('short') }}" required>{{ old('short') }}</textarea>
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
                                    <textarea id="create-text"  type="text" class="form-control" name="text" value="{{ old('text') }}" >{{ old('text') }}</textarea>
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
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection