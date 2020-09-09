<div class="col-sm-6">
    <div class="card mb-2">
        @if($post->hasCover())
            <img class="img-fluid cover" src="{{ secure_asset('storage/uploads/' . $post->media['cover']) }}" alt="cover">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                <a href="{{ route('profile', \App\Models\User::find($post->id_author)->id) }}">{{ \App\Models\User::find($post->id_author)->name }}</a>
            </h6>
            <div class="card-text">{{ $post->description }}</div>
        </div>
        <div class="card-footer">
            <a class="btn btn-primary"
               href="{{ route('post', $post->id) }}">{{ __('home.read_more') }}</a>
        </div>
    </div>
</div>
