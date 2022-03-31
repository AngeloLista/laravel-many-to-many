@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($post->exists)
    <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" novalidate>
        @method('PUT')
    @else
    <form method="POST" action="{{ route('admin.posts.store') }}" novalidate>
@endif
    @csrf
        <div class="row">
            {{-- Title --}}
            <div class="col-8 mb-3 form-group">
                <label for="title">Title: </label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
                {{-- Display error --}}
                @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            {{-- Categories Select --}}
            <div class="col-4 mb-3 form-group">
                <label for="category">Category: </label>
                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                    <option value="">No Category</option>
                    @foreach($categories as $category)
                    <option @if(old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">{{ $category->label }}</option>
                    @endforeach
                </select>
                {{-- Display error --}}
                @error('category_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            {{-- Content --}}
            <div class="col-12 mb-3 form-group">
                <div class="label">Content: </div>
                <textarea class="form-control @error('content') is-invalid @enderror" type="text"
                rows="5"  name="content" id="content">{{ old('content', $post->content) }}</textarea>
                {{-- Display error --}}
                @error('content')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            {{-- Image --}}
            <div class="col-12 mb-3 form-group">
                <label for="image">Image Url: </label>
                <input class="form-control @error('content') is-invalid @enderror" type="text" name="image" id="image" value="{{ old('image', $post->image) }}">
                {{-- Display error --}}
                @error('category_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            {{-- Tags --}}
            <div class="col-12">
                <hr>
                    <div class="tags-wrapper @error('tags') is-invalid @enderror">
                        @foreach ($tags as $tag)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" name="tags[]"
                            @if(in_array($tag->id, old('tags', $post_tags_ids ?? []))) checked @endif>
                            <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->label }}</label>
                        </div>
                        @endforeach
                    </div>
                    @error('tags')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                <hr>
            </div>
            
            <div class="d-flex justify-content-end col-12">
                {{-- Back to List --}}
                <a class="btn btn-secondary mr-3" href="{{ route('admin.posts.index')}}">Back</a>
                {{-- Save --}}
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </div>

    </form>