@extends('layouts.app')

@section('content')
    <section id="tag-show" class="container d-flex justify-content-center align-items-center">
        <div class="content row w-75">
            {{-- Tag Label --}}
            <div class="col-12 mb-3 d-flex align-items-center">
                <h1 class="mr-3">{{ $tag->label }}</h1>
                <span class="badge" style="background-color: {{ $tag->color }}; color: white;">{{ $tag->color }}</span>
            </div>
            {{-- Color --}}
            <div class="col-12">
                
            </div>
            {{-- Created at --}}
            <div class="col-12">
                @foreach ($tag->posts as $post)
                    <h5>ID: {{ $post->id }} - <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></h5>
                @endforeach
            </div>
            <div class="col-12 d-flex justify-content-end">
                {{-- Back --}}
                <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Back to Index</a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
      const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            const title = form.getAttribute('data-name');
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const accept = confirm(`Are you sure you want to delete ${title}?`);
                if (accept) e.target.submit();
            });
        })
    </script>
@endsection

@section('scripts')
    <script src="{{ asset('js/delete-confirmation.js') }}"></script>
@endsection