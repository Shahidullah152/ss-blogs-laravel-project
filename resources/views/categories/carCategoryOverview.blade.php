@extends('layout.layout')

@section('category_navbar')
    <div class="col-md-12 d-flex justify-content-between align-items-center position-relative">
        <h1 class="mb-2 text-secondary" id="category_title">Cars Categories
            
        </h1>
        <button type="button" id="categoryFilterBtn">Categories
            <span class="fa fa-angle-down" id="categoryFilterIcon"></span>
        </button>
        <div class="" id="categoryFilterContent">
            <a href="{{ route('welcomePage') }}" class="">
                All Categories
            </a>
            <hr class=" text-secondary">
            <a href="{{ route('MobileCategoryOverview') }}" class="">
                Mobile
            </a>
            <a href="{{ route('ComputerCategoryOverview') }}" class="">
                Computer
            </a>
            <a href="{{ route('CarCategoryOverview') }}" class="">
                Car
            </a>
            <a href="{{ route('SopportCategoryOverview') }}" class="">
                Sopport
            </a>
        </div>
    </div>
    <hr class=" text-secondary my-2">
@endsection

@section('posts')
    <div class="col-md-6 offset-md-3">
        @if (session('updatePostSuccess'))
            <div class="alert alert-success">
                {{ session('updatePostSuccess') }}
            </div>
        @endif
    </div>
    @foreach ($users as $user)
        @foreach ($user->posts as $posts)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-light d-flex flex-row justify-content-between">
                        <div class="user-img d-flex align-items-center">
                            <img class="img-fluid post-user-img" src="{{ asset('/storage/' . $user->userImage) }}"
                                width="40px" alt="">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <span class="ms-3 fs-4 fw-bold">{{ $user->userName }}</span>
                                <span class='text-secondary fst-normal'>{{ $posts->Date }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between gap-3">
                            <a href="" class="text-decoration-none text-secondary">
                                <span class="fa fa-ellipsis fs-4"></span>
                            </a>
                            <a href="" class="text-decoration-none text-secondary">
                                <span class="fa fa-close fs-4"></span>
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('post_likes_comments_shares_views', $posts->id) }}"
                        class="text-decoration-none text-dark">
                        <div class="card-body" id="card-body">
                            <h5 class="card-title">{{ $posts->title }}</h5>
                            <p class="card-text"> {{ \Illuminate\Support\Str::limit($posts->description, 50, ' More...') }}
                            </p>
                            <img src="{{ asset('/storage/' . $posts->Image) }}" class="img-fluid card-img  post-img"
                                alt="">
                        </div>
                    </a>

                    <div class="card-footer bg-dark text-light d-flex flex-row justify-content-around">
                        <div class="post-like">
                            <a href="{{ route('postsLikes', $posts->id) }}" class="text-decoration-none">
                                <button type="submit" id="like-btn" class="fs-5">
                                    <span
                                        class="fa fa-thumbs-up {{ $posts->likes()->where('user_id', Auth::id())->exists() ? 'text-primary' : 'text-light' }} "></span>
                                </button>
                            </a>
                            <span class="post-like-count text-secondary">{{ $posts->likes_count }}</span>
                        </div>

                        <div class="post-comment">
                            <a href="{{ route('postComments', $posts->id) }}"
                                class="text-decoration-none text-secondary fs-5">
                                <span
                                    class="fa fa-comment {{ $posts->comments()->where('user_id', Auth::id())->exists() ? 'text-primary' : 'text-light' }}"></span>
                            </a>
                            <span class="post-comment-count text-secondary">{{ $posts->comments_count }}</span>
                        </div>
                        <div class="post-viewers">
                            <a href="{{ route('postViews', $posts->id) }}"
                                class="text-decoration-none text-secondary fs-5">
                                <span
                                    class="fa  {{ $posts->views()->where('user_id', Auth::id())->exists() ? 'fa-eye text-primary' : 'fa-eye-slash text-light' }}"></span>
                            </a>
                            <span class="post-like-count text-secondary">{{ $posts->views_count }}</span>
                        </div>
                        <div class="post-share">
                            <a href="{{ route('postShares', $posts->id) }}"
                                class="text-decoration-none text-secondary fs-5">
                                <span class="fa fa-share text-light"></span>
                            </a>
                            <span class="post-like-count text-secondary">12</span>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    @endforeach
@endsection


@push('JavaScript_code')
    <script>
        // Filtrarion in Categories Home Page

        let categoryFilterBtn = document.getElementById('categoryFilterBtn');
        let categoryFilterContent = document.getElementById('categoryFilterContent');
        let categoryFilterIcon = document.getElementById('categoryFilterIcon');

        categoryFilterBtn.addEventListener('click', () => {
            categoryFilterContent.classList.toggle('show');
            categoryFilterIcon.classList.toggle('fa-angle-up');
        });
    </script>
@endpush
