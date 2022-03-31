@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="d-flex justify-content-between align-items-center">
            <h1>I miei post</h1>
            <div>
              <a class="btn btn-light mr-1"href="{{ route('admin.posts.by_category') }}">Posts by Category</a>
              {{-- Create --}}
              <a class="btn btn-warning mr-1" href="{{ route('admin.posts.create') }}">Create</a>
            </div>
        </header>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                <th scope="col">Tags</th>
                <th scope="col">Created at</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>

                @forelse($posts as $post)

                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    {{-- Title --}}
                    <td>{{ $post->title }}</td>
                    {{-- Author --}}
                    <td>
                    @if ($post->author)
                      {{ $post->author->name }}
                    @endif
                    </td>
                    {{-- Category --}}
                    <td>
                      @if($post->category)
                      <span class="badge badge-pill badge-{{$post->category->color}}">{{ $post->category->label }}</span>
                      @else - 
                      @endif
                    </td>
                    {{-- Tags --}}
                    <td>
                      @forelse($post->tags as $tag)
                        <a href="{{ route('admin.tags.show', $tag->id) }}">
                          <span class="badge" style="background-color: {{ $tag->color }}; color: white;">{{ $tag->label }}</span>
                        </a>
                        @empty <span>-</span>
                      @endforelse
                    </td>
                    {{-- Created At --}}
                    <td>{{ $post->created_at }}</td>
                    <td class="d-flex justify-content-end align-items-center">
                      {{-- Details --}}
                      <a class="btn btn-secondary mr-1" href="{{ route('admin.posts.show', $post->id) }}">Details</a>
                      {{-- Edit --}}
                      <a class="btn btn-primary mr-1"href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                      {{-- Delete --}}
                      <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form" data-name="{{ $post->title }}">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger mr-1" type="submit">Delete</button>
                      </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5"> Non ci sono Post</td></tr>
                @endforelse
            </tbody>
          </table>

          @if ($posts->hasPages())
          <div class="d-flex justify-content-center">
            {!! $posts->links() !!}
          </div>
          @endif

    </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/delete-confirmation.js') }}"></script>
@endsection