@extends('layout.layout')

@section('posts')
    <div class="container">
        <div class="row position-relative">
            <div class="col-md-12 d-flex justify-content-between align-items-center my-1 w-100"
                id="PostCategoryDraftPublishTitle">
                <h1 class="mb-2 text-secondary" id="PostCategoryDraftPublishTitle">My All Posts</h1>
                <button type="button" id="filterbtn">Filter By State
                    <span class="fa fa-angle-down" id="filterIcon"></span>
                </button>
                <div class="" id="filterContent">
                    <a href="{{ route('MyPost') }}" class="">
                        All Posts
                    </a>
                    <hr>
                    <a href="{{ route('draftPosts') }}" class="">
                        Draft Posts
                    </a>
                    <a href="{{ route('publishPosts') }}" class="">
                        Publish Posts
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Pblished Date</th>
                            <th>State</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        {{-- @foreach ($users as $user) --}}
                        @foreach ($users as $posts)
                            <tr>
                                <td>{{ $posts->id }}</td>
                                <td>{{ $posts->title }}</td>
                                <td>{{ $posts->category }}</td>
                                <td>{{ $posts->Date }}</td>
                                <td>{{ $posts->state }}</td>
                                <td>
                                    <img src="{{ asset('/storage/' . $posts->Image) }}" width="20px" class="img-fluid"
                                        alt="">
                                </td>
                                <td>

                                    <a href="{{ route('post.edit', $posts->id) }}"
                                        class="text-decoration-none text-warning ms-2"><span
                                            class="fa fa-pen-to-square"></span></a>

                                    <form action="{{ route('post.destroy', $posts->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border-0 bg-transparent ms-3">
                                            <span class="fa fa-trash-alt text-danger"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
                <div class="col-md-12 text-center">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('JavaScript_code')
    <script>
        // Filtraion in My Posts JS code
        let filterbtn = document.querySelector('#filterbtn');
        let filterconyent = document.querySelector('#filterContent');
        let filterIcon = document.querySelector('#filterIcon');

        filterbtn.addEventListener('click', () => {
            filterconyent.classList.toggle('show');
            filterIcon.classList.toggle('fa-angle-up');
        });
    </script>
@endpush
