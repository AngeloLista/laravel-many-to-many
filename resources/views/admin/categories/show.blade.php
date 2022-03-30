@extends('layouts.app')

@section('content')
    <section id="category-show" class="container d-flex justify-content-center align-items-center">
        <div class="content row w-75">
            {{-- Title --}}
            <div class="col-12 mb-3">
                <h1>{{ $category->label }}</h1>
            </div>
            {{-- Color --}}
            <div class="col-12">
                <span class="mr-1">Color:</span><span class="badge badge-pill badge-{{ $category->color }}">{{ $category->label }}</span>
            </div>
            {{-- Created at --}}
            <div class="col-12">
                <span>Created at: {{ $category->created_at }}</span>
            </div>
            <div class="col-12 d-flex justify-content-end">
                {{-- Edit --}}
                <a class="btn btn-primary mr-1" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                {{-- Delete --}}
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="delete-form" data-name="{{ $category->title }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-1" type="submit">Delete</button>
                </form>
                {{-- Back --}}
                <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}">Back to Index</a>
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