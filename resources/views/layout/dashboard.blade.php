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

    <!-- Dashboard start -->
    <section class="dashboard">
        <!-- main sidebar start -->
        <div class="sidebar bg-dark">
            <div class="sidebox sidebox1">
                <h5>Dashboard</h5>
            </div>
            <div class="sidebox sidebox2">
                <a href="">Overview Section</a>
                <a href="">My Post</a>
                <a href="{{ route('post-category.index') }}">Create New Post</a>
                <a href="">Comments</a>
                <a href="">Profile</a>
                <a href="">Setting</a>
            </div>
            <div class="sidebox sidebox3">
                <div>
                    <img src="img/shahid-removebg-preview.png" alt="user img">
                    <a href="">Shahidullah </a>
                </div>

                <a href="" class="btn btn-outline-danger">Logout
                    <span class="fa fa-arrow-right-to-bracket ms-2"></span>
                </a>

            </div>
        </div>


        <!-- Main div start -->
        <div class="main">
            <!-- Main Navbar start -->
            <nav class="main-navbar bg-dark">
                <!-- sidebar hide show btn -->
                <button id="sidebar-hide-show-btn">
                    <span class="fa fa-bars"></span>
                </button>

                <!-- offcanvas show btn -->
                <button id="sidebar-hide-show-btn2" data-bs-target="#offcanvasstart" data-bs-toggle="offcanvas">
                    <span class="fa fa-bars"></span>
                </button>

                <!-- offcanvas start -->
                <div class="offcanvas offcanvas-start" id="offcanvasstart">
                    <div class="offcanvas-body p-0 m-0">
                        <div class="offcanvas-close-btn">
                            <span class="fa fa-bars" data-bs-dismiss="offcanvas"></span>
                        </div>
                        <div class="sidebar1 bg-dark">
                            <div class="sidebox sidebox1">
                                <h5>Dashboard</h5>
                            </div>
                            <div class="sidebox sidebox2">
                                <a href="">Overview Section</a>
                                <a href="">My Post</a>
                                <a href="{{ route('post-category.index') }}">Create New Post</a>
                                <a href="">Comments</a>
                                <a href="">Profile</a>
                                <a href="">Setting</a>
                            </div>
                            <div class="sidebox sidebox3">
                                <div class="sidebox3-sub1">
                                    <img src="img/shahid-removebg-preview.png" alt="user img">
                                    <p>Shahid Ullah</p>
                                </div>
                                <div class="sidebox3-sub2">
                                    <p>shahid@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- search input start -->
                <div class="search-box1">
                    <input type="text" placeholder="Enter Your Mind">
                </div>

                <!-- navbar icons start -->
                <div class="search-box2">
                    <button id="search-show-icon">
                        <span class="fa fa-search"></span>
                    </button>
                    <!-- search hide input show with search icon click -->
                    <div class="search-hide bg-dark">
                        <input type="text" placeholder="Enter Your Mind">
                        <span class="fa fa-close" id="show-input-hide-btn"></span>
                    </div>
                    <button class="bell">
                        <span class="fa fa-bell"></span>
                    </button>
                    <button class="logout">
                        <a href="{{ route('post.index') }}" class="text-light"><span
                                class="fa fa-arrow-right-to-bracket"></span></a>
                    </button>

                </div>
            </nav>

            @yield('main-content')

        </div>
    </section>
    <!-- Dashboard end -->


    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
