@extends('layout.layout');

@section('posts')
    <div class="container">
        <div class="row text-center">
            <div class="col-md-7 offset-md-2 p-2 shadow" id="accountSettingForm">

                <div class="col-md-12">
                    @if (session('CommentsError'))
                        <div class="alert alert-danger">
                            {{ session('CommentsError') }}
                        </div>
                    @endif
                </div>
                <h4 class=" text-secondary m-3">Add Your Comments</h4>

                <form class="p-3" action="{{ route('postCommentsProcess', $postId->id) }}" method="POST">
                    @csrf
                    <textarea name="comments" cols="30" rows="5"
                        class="form-control @error('comments')
                        is-invalid
                    @enderror"></textarea>


                    <button type="submit" class="btn btn-success mt-2 w-50 py-2 fw-bolder">Submit</button>
                </form>


            </div>
        </div>
    </div>
@endsection
