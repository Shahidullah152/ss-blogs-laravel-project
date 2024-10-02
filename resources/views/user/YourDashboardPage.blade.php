@extends('layout.layout')

@section('posts')
    {{-- All Users Information Section --}}

    @if (Auth::user()->role == 'admin')
        <div class="col-md-12">
            <h4 class="text-secondary">All Information </h4>
            <hr>
            <div class="row  d-flex align-items-center justify-content-between">
                <div
                    class="col-md-3  mb-3 shadow p-2 d-flex align-items-center justify-content-center bg-success text-light">
                    <p class="fw-bolder">Totel Users</p>
                    <p class=" fw-bolder fs-3 text-dark ms-4">{{ $allUsers }}</p>
                </div>
                <div
                    class="col-md-3  mb-3 shadow p-2 d-flex align-items-center justify-content-center bg-primary text-light">
                    <p class="fw-bolder">Totel Posts</p>
                    <p class=" fw-bolder fs-3 text-dark ms-4">{{ $allPostsCount }}</p>
                </div>

                <div
                    class="col-md-3  mb-3 shadow p-2 d-flex align-items-center justify-content-center bg-warning text-light">
                    <p class="fw-bolder">Post Categories</p>
                    <p class=" fw-bolder fs-3 text-dark ms-4">{{ $allCategory }}</p>
                </div>
                <div class="col-md-6  mb-3  p-2 d-flex align-items-center justify-content-center bg-dark text-light">
                    <p class="fw-bolder">Male Users</p>
                    <p class=" fw-bolder fs-3 text-info ms-4">{{ $allMaleUser }}</p>
                </div>
                <div class="col-md-6  mb-3  p-2 d-flex align-items-center justify-content-center bg-dark text-light">
                    <p class="fw-bolder">Female Users </p>
                    <p class=" fw-bolder fs-3 text-info ms-4">{{ $allFemaleUser }}</p>
                </div>
            </div>

        </div>

        <div class="col-md-12">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="text-secondary">Users Information </h4>
                <a href="{{ route('registerPage') }}" id="addBtn">
                    Add User
                </a>
            </div>
            <hr>
            <div class=" table-responsive">
                <table class=" table table-bordered table-hover table-striped text-center">
                    <tr class="bg-info text-dark ">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Image</th>
                        <th>Role</th>
                        <th>Posts</th>

                    </tr>

                    @foreach ($allUsersInfo as $userInfo)
                        <tr>
                            <td>{{ $userInfo->userName }}</td>
                            <td>{{ $userInfo->email }}</td>
                            <td>{{ $userInfo->userGander }}</td>
                            <td>
                                <img src="{{ asset('/storage/' . $userInfo->userImage) }}" class="img-fluid" width="30px"
                                    height="30px" style="border-radius: 10px" alt="">
                            </td>
                            <td>{{ $userInfo->role }}</td>
                            <td>{{ $userInfo->posts_count }}</td>

                        </tr>
                    @endforeach ()


                </table>

                <div>
                    {{ $allUsersInfo->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="text-secondary">Admins </h4>
                <a href="{{ route('add.admin') }}" id="addBtn">
                    Add Admin
                </a>
            </div>
            <hr>
            <div class=" table-responsive">
                <table class=" table table-bordered table-hover table-striped text-center">
                    <tr class="bg-danger text-light ">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Image</th>
                        <th>Role</th>
                        <th>Posts</th>
                    </tr>

                    @foreach ($allUsersInfo as $userInfo)
                        @if ($userInfo->role == 'admin')
                            <tr>
                                <td>{{ $userInfo->userName }}</td>
                                <td>{{ $userInfo->email }}</td>
                                <td>{{ $userInfo->userGander }}</td>
                                <td>
                                    <img src="{{ asset('/storage/' . $userInfo->userImage) }}" class="img-fluid"
                                        width="30px" height="30px" style="border-radius: 10px" alt="">
                                </td>
                                <td>{{ $userInfo->role }}</td>
                                <td>{{ $userInfo->posts_count }}</td>

                            </tr>
                        @endif
                    @endforeach ()


                </table>
                <div>
                    {{ $allUsersInfo->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif



    {{-- add logo  form --}}

    <div class="col-md-12">
        <h4 class="text-secondary">Add Logo</h4>
        <hr>
        <div class="col-md-6 offset-md-3 shadow p-4" style="border-radius: 15px">

            <div class="text-center ">
                <img src="" id="logoupdate" width="150" alt="" class="shadow">

            </div>
            <form action="{{ route('addLogo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="logo" class="fw-bold my-2 text-center">Upload New Logo</label>
                    <input type="file"
                        onchange="document.querySelector('#logoupdate').src=window.URL.createObjectURL(this.files[0])"
                        class="form-control" id="logo" name="logo">
                </div>
                <div class="my-2 text-center">
                    <button type="submit" class="btn btn-primary">Upload Logo</button>

                </div>
            </form>
            </form>
        </div>
    </div>





    {{-- My Posts Information --}}
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="text-secondary">My Information</h4>

            <a href="{{ route('post-category.index') }}" id="addBtn">
                Add Post
            </a>
        </div>
        <hr>
        <div class="col-md-12  mb-3 shadow p-2 d-flex align-items-center justify-content-center bg-dark text-light">
            <p class="fw-bolder">My Totel Posts</p>
            <p class=" fw-bolder fs-3 text-info ms-4">{{ $allPosts }}</p>
        </div>

        <div class=" table-responsive">
            <table class="table table-striped table-bordered table-hover text-center">
                <tr class="bg-dark text-light">
                    <th>Title</th>
                    <th>Category</th>
                    <th>PDate</th>
                    <th>Image</th>
                    <th>Likes</th>
                    <th>Comments</th>
                    <th>Shares</th>
                    <th>Views</th>
                    <th>Actions</th>
                </tr>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->Date }}</td>
                        <td>
                            <img src="{{ asset('/storage/' . $post->Image) }}" width="30px" alt=""
                                class="img-fluid">
                        </td>
                        <td>{{ $post->likes_count }}</td>
                        <td>{{ $post->comments_count }}</td>
                        <td>{{ $post->shares_count }}</td>
                        <td>{{ $post->views_count }}</td>
                        <td>

                            <a href="{{ route('post.edit', $post->id) }}"
                                class="text-decoration-none text-warning ms-2"><span class="fa fa-pen-to-square"></span></a>

                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="d-inline">
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
    </div>
@endsection
