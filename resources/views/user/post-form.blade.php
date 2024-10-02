@extends('layout.layout')

@section('posts')
    <div class="col-md-12">
        <form id="PostForm" action="{{ route('post.store') }}" enctype="multipart/form-data" method="POST"
            class="p-2 shadow-lg mt-5">
            @csrf
            <h1 class="text-secondary text-center m-2">Create New Post</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Post Title</label>
                    <input name="title" type="text" placeholder="Post Title"
                        class="form-control mt-2  @error('title')
                    is-invalid
                    @enderror">

                    <label class="form-label">Post Description</label>
                    <input name="description" type="text" placeholder="Post Description"
                        class="form-control mt-2 @error('description')
                    is-invalid
                    @enderror">
                    @error('description')
                        <span class="text-danger">{{ $message }}</span><br>
                    @enderror
                    <label class="form-label">Post
                        Category</label>
                    <select name="category" id="" class="form-select mt-2">
                        @foreach ($post_category as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date</label>
                    <input name="Date" type="date"
                        class="form-control mt-2 @error('Date')
                    is-invalid
                    @enderror"
                        placeholder="Date">
                    <label class="form-label">Post State</label>
                    <select name="state" id="" class="form-select mt-2">
                        <option value="publish">Publish</option>
                        <option value="draft">Draft</option>
                    </select>
                    <label class="form-label">Post Image</label>
                    <input name="image" type="file"
                        class="form-control mt-2 @error('image')
                    is-invalid
                    @enderror">
                </div>

            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success mt-2">Insert</button>
                </div>
            </div>
        </form>
    </div>
@endsection
