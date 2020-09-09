@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Create new blog</h3>

            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach

            @error('create')
                <div class="card bg-danger text-white">
                    <div class="card-body">{{ $message }}</div>
                </div>
            @enderror

            <form action="" method="post" enctype="multipart/form-data" class="mt-4">
                @csrf

                <div class="form-group">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span><br>
                    @enderror
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    @error('content')
                        <span class="text-danger">{{ $message }}</span><br>
                    @enderror
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content">{{ old('content') }}</textarea>
                </div>

                <small>First image is cover post</small><br>
                <small>Images don't save after reload</small>
                <div class="custom-file mb-3">
                    @error('files[]')
                        <span class="text-danger">{{ $message }}</span><br>
                    @enderror
                    <input type="file" class="custom-file-input" id="customFile" name="files[]" accept="image/*" multiple>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>

                <button class="btn btn-primary">Create</button>
                <button class="btn btn-danger">Close</button>
            </form>
        </div>
    </div>
@stop
