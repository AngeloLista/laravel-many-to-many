@extends('layouts.app')

@section('content')
<section id="post-edit" class="d-flex justify-content-center align-items-center">
    
    <div class="container">
        <h1 class="mb-3">Edit -> {{ $post->title }}</h1>
        @include('admin.includes.form')
    </div>
</section>
@endsection