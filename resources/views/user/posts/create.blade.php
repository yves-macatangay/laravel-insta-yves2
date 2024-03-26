@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

<form action="{{ route('post.store')}}" method="post" enctype="multipart/form-data">
    @csrf 

    <span class="form-label fw-bold">Category <span class="fw-light">(up to 3)</span></span>
    <div>
        @forelse($all_categories as $category)
        <div class="form-check form-check-inline">
            <input type="checkbox" name="categories[]" id="{{$category->name}}" value="{{$category->id}}" class="form-check-input">
            <label for="{{$category->name}}" class="form-check-label">{{$category->name}}</label>
        </div>
        @empty 
            <span class="text-muted fst-italic">No categories.</span>
        @endforelse
    </div>
    @error('categories')
        <span class="d-block text-danger small">{{ $message }}</span>
    @enderror

    <label for="description" class="form-label mt-3 fw-bold">Description</label>
    <textarea name="description" id="description" rows="3" placeholder="What's on your mind" class="form-control">{{ old('description') }}</textarea>
    @error('description')
        <span class="d-block text-danger small">{{ $message }}</span>
    @enderror

    <label for="image" class="form-label mt-3 fw-bold">Image</label>
    <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
    <p class="form-text" id="image-info">
        Acceptable formats: jpeg, jpg, png, gif only <br>
        Max size is 1048 KB
    </p>
    @error('image')
    <span class="d-block text-danger small">{{ $message }}</span>
    @enderror

    <button type="submit" class="btn btn-primary mt-4 px-4">Post</button>
</form>

@endsection