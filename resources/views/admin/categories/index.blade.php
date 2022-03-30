@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="d-flex justify-content-between align-items-center">
            <h1>Categories</h1>
            {{-- Create --}}
            <a class="btn btn-warning mr-1" href="{{ route('admin.categories.create') }}">Create</a>
        </header>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Label</th>
                <th scope="col">Color</th>
                <th scope="col">Created at</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>

                @forelse($categories as $category)

                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    {{-- Label --}}
                    <td>{{ $category->label }}</td>
                    {{-- Color --}}
                    <td><span class="badge badge-pill badge-{{$category->color}}">{{ $category->color }}</span></td>
                    {{-- Created At --}}
                    <td>{{ $category->created_at }}</td>
                    <td class="d-flex justify-content-end align-items-center">
                      {{-- Details --}}
                      <a class="btn btn-secondary mr-1" href="{{ route('admin.categories.show', $category->id) }}">Details</a>
                      {{-- Edit --}}
                      <a class="btn btn-primary mr-1"href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                      {{-- Delete --}}
                      <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="delete-form" data-name="{{ $category->title }}">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger mr-1" type="submit">Delete</button>
                      </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5"> No Category</td></tr>
                @endforelse
            </tbody>
          </table>

    </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/delete-confirmation.js') }}"></script>
@endsection