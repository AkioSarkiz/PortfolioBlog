@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">{{ $post->title }}</h2>
            <a class="flex-row" href="{{ route('profile', $author->id) }}">
                <img width="25" height="25" class="rounded-circle cover" src="{{ secure_asset('storage/uploads/' . $author->avatar) }}" alt="image">
                <span>{{ $author->name }}</span>
            </a>
        </div>
        <div class="card-body">
            <p class="card-text text-break">{{ $post->content }}</p>
            @if($post->hasCover())
                <img class="img-fluid cover" src="{{ secure_asset('storage/uploads/' . $post->media['cover']) }}" alt="cover">
            @endif
        </div>

    </div>
@stop
