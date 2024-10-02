@extends('layout.layout')

@section('posts')
    @foreach ($posts as $post)
        <div class="col-md-12">
            <form id="PostForm" action="{{ route('postShareProcess', $post->id) }}" enctype="multipart/form-data"
                method="POST" class="p-2 shadow-lg mt-5">
                @csrf
                <h1 class="text-secondary text-center m-2">Share This Post</h1>
                <hr>

                <div class="row">
                    <div class="col-md-4 offset-md-4 my-2">
                        <h5 class="text-center">Post Image</h5>
                        <img src="{{ asset('/storage/' . $post->Image) }}" id="postImageUpdate"
                            class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Post Title</label>
                        <input name="title" value="{{ $post->title }}" type="text" placeholder="Post Title"
                            class="form-control mt-2">
                        <label class="form-label">Post Description</label>
                        <input name="description" value="{{ $post->description }}" type="text"
                            placeholder="Post Description" class="form-control mt-2">
                        <label class="form-label">Post Category</label>
                        <select name="category" id="" class="form-select mt-2">
                            @foreach ($post_category as $Category)
                                <option value="{{ $Category->id }}"
                                    {{ $post->category === $Category->category ? 'selected' : '' }}>
                                    {{ $Category->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date</label>
                        <input name="Date" value="{{ $post->Date }}" type="date" class="form-control mt-2"
                            placeholder="Date">
                        <label class="form-label">Post State</label>
                        <select name="state" id="" class="form-select mt-2">
                            @if ($post->state == 'publish')
                                <option value="publish">{{ $post->state }}</option>
                                <option value="draft">Draft</option>
                            @else
                                <option value="draft">{{ $post->state }}</option>
                                <option value="publish">Publish</option>
                            @endif

                        </select>
                        <label class="form-label">Post Image</label>
                        <input type="file" name="image"
                            class="form-control @error('image')
                        is-invalid
                        @enderror"
                            onchange="document.querySelector('#postImageUpdate').src=window.URL.createObjectURL(this.files[0])">
                        {{-- <input name="image" type="file" class="form-control mt-2"
                            onchange="document.querySelector('#postImageUpdate').src=window.URL.createObjectURL(this.files[0])"> --}}
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-info py-2 fs-4 fw-bold mt-2 w-50">Share</button>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
@endsection
