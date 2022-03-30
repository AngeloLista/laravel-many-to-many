@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-3">Create a new category</h1>
        
        @include('admin.includes.categories.form')
    </div>
@endsection