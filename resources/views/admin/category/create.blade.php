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
                <div class="panel panel-default">
                    <div class="panel-heading">Added new category</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('categories.store') }}"  enctype="multipart/form-data">
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="slug" class="col-md-4 control-label">Url</label>

                                <div class="col-md-6">
                                    <input id="slug" type="slug" class="form-control" name="slug"  required>

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

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"  required autofocus>

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

                                <div class="col-md-6">
                                    <textarea id="description"  type="text" class="form-control" name="description" ></textarea>
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
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection