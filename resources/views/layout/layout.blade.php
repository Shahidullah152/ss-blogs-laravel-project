<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SS Blogs Layout</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/fontawesome.min.css') }}">
</head>

<body>


    <!-- Navbar Start  -->
    <nav class="post-navbar">
        <div class="navbar-logo-item">
            <img src="{{ asset('img/logo.png') }}" class="logo img-fluid" alt="">
            <div id="search_hide_icon">
                <span class="fa fa-search"></span>
            </div>

            <form action="{{ route('search') }}" id="search-form" method="GET">
                @csrf
                <input type="search" placeholder="Enter Your Mind" name="search">
            </form>

            <form action="{{ route('search') }}" id="search-form-hide" method="GET">
                @csrf
                <input type="search" placeholder="Enter Your Mind" name="search">
            </form>

        </div>
        <div class="navbar-item-menus">
            <ul>
                <a class="text-dark" href="{{ route('welcomePage') }}">
                    <li><span class="fa fa-home"></span></li>
                </a>
                <li><span class="fa fa-video"></span></li>
                <li><span class="fa fa-user-friends"></span></li>
                <a class="text-dark" href="{{ route('profileSetting') }}">
                    <li><span class="fa fa-user"></span></li>
                </a>
            </ul>
        </div>

        <div class="navbar-item-account position-relative">

            <a href="" class="text-dark text-decoration-none">
                <div>
                    <span class="fa fa-bell"></span>
                </div>
            </a>
            <div id="account-img-toggle" class="position-relative" title="account">

                <img src="{{ asset('/storage/' . Auth::user()->userImage) }}" class="img-fluid account-img"
                    alt="">

            </div>
            <div class="d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling">
                <span class="fa fa-bars"></span>
            </div>
        </div>

    </nav>
    <!-- Navbar end -->
    <div class="account-content">
        <span class="fa fa-close fs-4" id="acount-content-close-btn"></span>
        <div class="userImage text-center">
            <img src="{{ asset('/storage/' . Auth::user()->userImage) }}" id="userImage"
                class="
            img-fluid
            " alt="">
            <h4>{{ Auth::user()->userName }}</h4>
            <p>{{ Auth::user()->email }}</p>
            <hr>
        </div>
        <div class="account-menus">
            <a href="{{ route('profileSetting') }}" class="fw-bolder">
                Profile Setting
            </a>
            <a href="{{ route('accountSetting') }}" class="fw-bolder">
                Account Setting
            </a>
            <a href="{{ route('changePassword') }}" class="fw-bolder">
                Change Password
            </a>
            <a href="{{ route('logout') }}" class="fw-bolder logout">
                Logout
                <span class="fa fa-arrow-right-to-bracket ms-1"></span>
            </a>
        </div>
    </div>
    <!-- hide sidebar start -->

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <div class="sidebar-user-img userImage">
                <img src="{{ asset('/storage/' . Auth::user()->userImage) }}" id="userImage" class="img-fluid"
                    alt="" width="50px">
                <p class="ms-2 fw-bold fs-5 text-success">{{ Auth::user()->userName }} </p>
                {{-- <p class="ms-1   text-secondary">| {{ Auth::user()->email }}</p> --}}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr>

        <div class="offcanvas-body">
            <div class="offcanvas-navbar-item-menus">
                <ul class="d-flex justify-content-around list-unstyled ">
                    <a class="text-dark" href="{{ route('welcomePage') }}">
                        <li><span class="fa fa-home"></span></li>
                    </a>
                    <li><span class="fa fa-video"></span></li>
                    <li><span class="fa fa-user-friends"></span></li>
                    <a class="text-dark" href="{{ route('profileSetting') }}">
                        <li><span class="fa fa-user"></span></li>
                    </a>
                </ul>
            </div>
            <hr>
            <div class="sidebar-menus">
                <a href="{{ route('overviewPosts') }}">Overview Section</a>
                <a href="{{ route('MyPost') }}">My Posts</a>
                <a href="{{ route('post-category.index') }}">Create New Post</a>
                <a href="{{ route('profileSetting') }}">Profile</a>
                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('YourDashboardPage') }}">All Users Dashboard </a>
                    <a href="{{ route('admin.dashboard') }}">Layout Setting</a>
                @else
                    <a href="{{ route('YourDashboardPage') }}">Dashboard</a>
                @endif

            </div>
        </div>
    </div>
    </div>
    <!-- hide sidebar end -->

    <!-- Sidebar Section start -->
    <section class="main-section">
        <div class="post-sidebar">
            <a href="{{ route('HomePage') }}" class="text-decoration-none text-success">
                <div class="sidebar-user-img userImage">
                    <img src="{{ asset('/storage/' . Auth::user()->userImage) }}" id="userImage" class="img-fluid"
                        alt="" width="50px">
                    <div class="">
                        <span class="fw-bolder fs-4">{{ Auth::user()->userName }}</span>
                        <span class="text-secondary fw-lighter">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            </a>
            <hr>
            <div class="sidebar-menus">
                <a href="{{ route('overviewPosts') }}">Overview Section</a>
                <a href="{{ route('MyPost') }}">My Posts</a>
                <a href="{{ route('post-category.index') }}">Create New Post</a>
                <a href="{{ route('profileSetting') }}">Profile</a>
                @if (Auth::user()->role == 'admin')
                    <a href="{{ route('YourDashboardPage') }}">All Users Dashboard </a>
                    <a href="{{ route('admin.dashboard') }}">Layout Setting</a>
                @else
                    <a href="{{ route('YourDashboardPage') }}">Dashboard</a>
                @endif

            </div>
        </div>
        <div class="post-main-content">
            <div class="container">
                @if (session('success'))
                    <div class="container bg-transparent message">
                        <div class="row">
                            <div class="col-md-6 offset-2 my-2">
                                <div class="alert alert-success ">
                                    {{ session('success') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row position-relative">
                    @yield('category_navbar')
                </div>
                <div class="row gy-4">
                    @yield('posts')
                </div>
            </div>
        </div>
    </section>
    <!-- Main Section end -->







    @stack('JavaScript_code')

    <script>
        // navbar user account content  hide and show JS code
        let account_img_toggle = document.querySelector('#account-img-toggle');
        let account_content = document.querySelector('.account-content');
        let acount_content_close_btn = document.querySelector('#acount-content-close-btn');
        account_img_toggle.addEventListener('click', () => {
            account_content.classList.toggle('account-show');
        })
        acount_content_close_btn.addEventListener('click', () => {
            account_content.classList.remove('account-show');
        })


        let search_hide_icon = document.querySelector('#search_hide_icon');
        let search_form = document.querySelector('#search-form-hide');

        search_hide_icon.addEventListener('click', () => {
            search_form.classList.toggle('search-form-hide-show')
        })
    </script>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
