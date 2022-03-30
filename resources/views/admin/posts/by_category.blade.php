@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <h1>Posts By Category</h1>
            <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">Back to Index</a>
        </header>
        {{-- Categories index --}}
        <div class="row">
            @foreach ($categories as $category)
              <div class="col-3 mb-3">
                  {{-- Label --}}
                <h3>{{ $category->label }}</h3>
                <hr>
                {{-- Posts --}}
                @foreach ($category->posts as $post)
                  <h5><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></h5>
                @endforeach
              </div>
            @endforeach
          </div>
    </div>
@endsection