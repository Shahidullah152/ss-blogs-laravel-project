@extends('layout.layout')

@section('posts')
    <div class="col-md-12">

        <form id="PostForm" action="{{ route('post.update', $posts->id) }}" enctype="multipart/form-data" method="POST"
            class="p-2 shadow-lg mt-5">
            @csrf
            @method('PUT')
            <h1 class="text-secondary text-center m-2">Update Your Draft Post</h1>
            <hr>
            <div class="row">
                <div class="col-md-4 offset-md-4 my-2">
                    <h5 class="text-center">Post Image</h5>
                    <img src="{{ asset('/storage/' . $posts->Image) }}" id="postImageUpdate" class="img-fluid img-thumbnail"
                        alt="">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Post Title</label>
                    <input name="title" value="{{ $posts->title }}" type="text" placeholder="Post Title"
                        class="form-control mt-2">
                    <label class="form-label">Post Description</label>
                    <input name="description" value="{{ $posts->description }}" type="text"
                        placeholder="Post Description" class="form-control mt-2">
                    <label class="form-label">Post Category</label>
                    <select name="category" id="" class="form-select mt-2">
                        @foreach ($postCategory as $Category)
                            <option value="{{ $Category->id }}"
                                {{ $posts->category === $Category->category ? 'selected' : '' }}>
                                {{ $Category->category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Date</label>
                    <input name="Date" type="date" value="{{ $posts->Date }}" class="form-control mt-2"
                        placeholder="Date">
                    <label class="form-label">Post State</label>
                    <select name="state" id="" class="form-select mt-2">
                        @if ($posts->state === 'publish')
                            <option value="publish">{{ $posts->state }}</option>
                            <option value="draft">draft</option>
                        @else
                            <option value="draft">{{ $posts->state }}</option>
                            <option value="publish">publish</option>
                        @endif
                    </select>
                    <label class="form-label">Post Image</label>
                    <input name="image" type="file" class="form-control mt-2"
                        onchange="document.querySelector('#postImageUpdate').src=window.URL.createObjectURL(this.files[0])">
                </div>

            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success mt-2">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
