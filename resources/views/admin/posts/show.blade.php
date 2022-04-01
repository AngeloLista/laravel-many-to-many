@extends('layouts.app')

@section('content')
    <section id="post-show" class="container d-flex justify-content-center align-items-center">
        <div class="content row w-75">
            {{-- Title --}}
            <div class="col-12 mb-3">
                <h1>{{ $post->title }}</h1>
            </div>
            {{-- Content --}}
            <div class="col-10 mb-3">{{ $post->content }}</div>
            {{-- Image --}}
            <div class="col-2 mb-3"><img class="img-fluid" src="{{ asset("storage/$post->image") }}" alt="{{ $post->slug }}"></div>
            {{-- Author --}}
            @if ($post->author)
                <div class="col-12 d-flex justify-content-end">
                    <address>
                        Author: {{ $post->author->name }}
                    </address>
                </div>
            @endif
            {{-- Category --}}
            <address class="col-12 d-flex justify-content-end">
                @if($post->category)
                <span class="badge badge-pill badge-{{$post->category->color}}">{{ $post->category->label }}</span>
                @else - 
                @endif
            </address>
            {{-- Tags --}}
                <div class="col-12">
                    <span>Tags: </span>
                    @forelse($post->tags as $tag)
                        <span class="badge" style="background-color: {{ $tag->color }}; color: white;">{{ $tag->label }}</span>
                        @empty <span>-</span>
                    @endforelse
                </div>

            <div class="col-12 d-flex justify-content-end">
                {{-- Edit --}}
                <a class="btn btn-primary mr-1" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                {{-- Delete --}}
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form" data-name="{{ $post->title }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-1" type="submit">Delete</button>
                </form>
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