@extends('layout.layout')

@section('posts')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-dark text-light d-flex flex-row justify-content-between">
                <div class="user-img d-flex align-items-center">
                    <img class="img-fluid post-user-img" src="{{ asset('/storage/' . $posts->user->userImage) }}"
                        width="40px" alt="">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <span class="ms-3 fs-4 fw-bold">{{ $posts->user->userName }}</span>
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

            <div class="card-body" id="card-body">
                <h5 class="card-title">{{ $posts->title }}</h5>

                <p class="card-text">{{ $posts->description }}</p>
                <img src="{{ asset('/storage/' . $posts->Image) }}" class="img-fluid card-img  post-img" alt="">
            </div>

            <div class="card-footer justify-content-center align-items-center">
                <div class=" container row g-2">
                    @foreach ($comments as $comment)
                        <div class="col-md-4 py-2">
                            <div class="d-flex justify-content-center justify-content-md-start  align-items-center">
                                <img src="{{ asset('/storage/' . $comment->user->userImage) }}"
                                    style="width: 30px;height: 30px; border-radius: 50%" alt="">
                                <span class="ms-2 fw-bolder fs-5">{{ $comment->user->userName }}</span>
                            </div>
                            <div class="text-md-start text-center mt-2">
                                <p class="text-secondary">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>


    {{-- <div class="col-md-12">
        <p>{{ $posts->title }}</p>
        <p>{{ $posts->description }}</p>
        <p>{{ $posts->Date }}</p>
        <p>{{ $posts->state }}</p>
        <p>{{ $posts->category }}</p>
        <p>{{ $posts->Image }}</p>

        <p>{{ $posts->user->userName }}</p>

        @foreach ($users as $user)
            <img src="{{ asset('/storage/' . $user->userImage) }}" width="20px" alt="">
            <p>{{ $user->comment }}</p>
        @endforeach


    </div> --}}
@endsection
