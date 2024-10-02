@extends('layout.layout')

@section('posts')
    <div class="col-md-12">
        @if ($users->isEmpty() && $posts->isEmpty())
            <h1>Record Not Found</h1>
        @else
            @foreach ($users as $user)
                <div class="col-md-8 offset-md-2">
                    <div class="searchUserBox">
                        <img src="{{ asset('/storage/' . $user->userImage) }}" width="100px" alt="">
                        <div class="searchUserInfo">
                            <h4>{{ $user->userName }}</h4>

                            <a href="">
                                <span>{{ $user->email }}</span>
                            </a>
                        </div>
                    </div>
            @endforeach
            @foreach ($posts as $post)
                <div class="col-md-8 offset-md-2">
                    <div class="card my-2">
                        <div class="card-header bg-dark text-light d-flex flex-row justify-content-between">
                            <div class="user-img d-flex align-items-center">
                                <img class="img-fluid post-user-img" src="{{ asset('/storage/' . $post->user->userImage) }}"
                                    width="40px" alt="">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <span class="ms-3 fs-4 fw-bold">{{ $post->user->userName }}</span>
                                    <span class='text-secondary fst-normal'>{{ $post->Date }}</span>
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
                        <a href="{{ route('post_likes_comments_shares_views', $post->id) }}"
                            class="text-decoration-none text-dark">
                            <div class="card-body" id="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::limit($post->description, 50, ' More...') }}
                                </p>
                                <img src="{{ asset('/storage/' . $post->Image) }}" class="img-fluid card-img  post-img"
                                    alt="">
                            </div>
                        </a>

                        <div class="card-footer bg-dark text-light d-flex flex-row justify-content-around">
                            <div class="post-like">
                                <a href="{{ route('postsLikes', $post->id) }}" class="text-decoration-none">
                                    <button type="submit" id="like-btn" class="fs-5">
                                        <span
                                            class="fa fa-thumbs-up {{ $post->likes()->where('user_id', Auth::id())->exists() ? 'text-primary' : 'text-light' }} "></span>
                                    </button>
                                </a>
                                <span class="post-like-count text-secondary">{{ $post->likes_count }}</span>
                            </div>

                            <div class="post-comment">
                                <a href="{{ route('postComments', $post->id) }}"
                                    class="text-decoration-none text-secondary fs-5">
                                    <span
                                        class="fa fa-comment {{ $post->comments()->where('user_id', Auth::id())->exists() ? 'text-warning' : 'text-light' }}"></span>
                                </a>
                                <span class="post-comment-count text-secondary">{{ $post->comments_count }}</span>
                            </div>
                            <div class="post-viewers">
                                <a href="{{ route('postViews', $post->id) }}"
                                    class="text-decoration-none text-secondary fs-5">
                                    <span
                                        class="fa  {{ $post->views()->where('user_id', Auth::id())->exists() ? 'fa-eye text-info' : 'fa-eye-slash text-light' }}"></span>
                                </a>
                                <span class="post-like-count text-secondary">{{ $post->views_count }}</span>
                            </div>
                            <div class="post-share">
                                <a href="{{ route('postShares', $post->id) }}"
                                    class="text-decoration-none text-secondary fs-5">
                                    <span
                                        class="fa fa-share {{ $post->shares()->where('user_id', Auth::id())->exists() ? 'text-success' : 'text-light' }}"></span>
                                </a>
                                <span class="post-like-count text-secondary">{{ $post->shares_count }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif
    </div>
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
