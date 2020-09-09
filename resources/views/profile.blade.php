@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body row">
            <div class="col-auto">
                <img class="cover" src="{{ secure_asset('storage/uploads/' . $profile->avatar) }}" alt="avatar"
                     width="82" height="82">
            </div>
            <div class="col-sm">
                <h3 class="mb-0">{{ $profile->name }}</h3>
                <small class="text-muted">
                    #{{ $profile->id }}<br>
                    {{ __('profile.account_created', ['year' => $profile->created_at->year]) }}
                </small>
            </div>
        </div>
    </div>

    <h4 class="mt-4">Записи пользователя</h4>
    <div class="row">
        @if(count($posts) === 0)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @lang('profile.not_exists_posts')
                        <img class="mx-2" src="{{ secure_asset('storage/uploads/thought.png') }}" alt="icon" width="32"
                             height="32">
                    </div>
                </div>
            </div>
        @endif

        @foreach($posts as $post)
            @include('components.post_preview')
        @endforeach
    </div>
@stop
