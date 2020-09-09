@extends('layouts.app')

@section('content')

    <div class="row">
        @foreach($posts as $post)
            @include('components.post_preview', ['post' => $post])
        @endforeach
    </div>



    {{--        TODO --}}
    <div class="container">
        <nav aria-label="pages">
            <ul class="pagination mt-1">
                @for($i = 1; $i < $max_posts; $i++)
                    <li class="page-item"><a class="page-link" href="{{ route('home') . "?page=$i" }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </nav>
    </div>
@endsection
