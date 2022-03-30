@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($category->exists)
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" novalidate>
        @method('PUT')
    @else
    <form method="POST" action="{{ route('admin.categories.store') }}" novalidate>
@endif
    @csrf
        <div class="row">
            {{-- Label --}}
            <div class="col-8 mb-3 form-group">
                <label for="label">Label: </label>
                <input class="form-control @error('label') is-invalid @enderror" type="text" name="label" id="label" value="{{ old('label', $category->label) }}">
                {{-- Display error --}}
                @error('label')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            {{-- Color Select --}}
            <div class="col-4 mb-3 form-group">
                <label for="color">Color: </label>
                <select class="form-control @error('color') is-invalid @enderror" id="color" name="color">
                    <option value="">No Color</option>
                    @foreach($categories as $c)
                    <option @if(old('color', $category->color) === $c->color ) selected @endif value="{{ $c->color }}">{{ $c->color }}</option>
                    @endforeach
                </select>
                {{-- Display error --}}
                @error('color')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end col-12">
                {{-- Back to List --}}
                <a class="btn btn-secondary mr-3" href="{{ route('admin.categories.index')}}">Back</a>
                {{-- Save --}}
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </div>

    </form>