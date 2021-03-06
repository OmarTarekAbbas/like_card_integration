<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digicards</title>
    <link rel="shortcut icon" href="{{ asset('front/images/logo1.png') }}">
    <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style_en.css') }}">
</head>

<body>
    <header class="header_Nav">
        <input type="checkbox" id="menu-toggle">
        <label class="hamburger-wrapper" for="menu-toggle">
            <i class="hamburger fas fa-bars"></i>
        </label>

        <nav class="navbar_btn">
            <ul id="accordion" class="accordion list-unstyled">

                <li id="indexed" class="">
                    <a href="{{ route('front.home') }}" class="link text-capitalize link_href">home</a>
                </li>

                @foreach(categories() as $category)
                <li>
                    <a href="{{ route('front.category', ['parent_id' => $category->id]) }}" class="link text-capitalize link_href"> {{ $category->categoryName }} </a>
                </li>
                @endforeach

                @if(auth()->guard("client")->check())
                  <li>
                      <a href="{{ route('front.orders') }}" class="link text-capitalize link_href">orders</a>
                  </li>

                  <li>
                      <a href="{{ route('client.profile') }}" class="link text-capitalize link_href">Profile</a>
                  </li>

                  <li>
                    <a href="#" class="link text-capitalize"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('client.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </li>
                 @else
                 <li>
                      <a href="{{ route('client.login') }}" class="link text-capitalize link_href">Login</a>
                  </li>

                  <li>
                      <a href="{{ route('client.register') }}" class="link text-capitalize link_href">Register</a>
                  </li>
                @endif
            </ul>
        </nav>

        <div class="search_btn">
            <a data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-search"></i>
            </a>
        </div>

    </header>

    <div class="search_modal">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <section class="search_form">
                            <h5 class="find_your_card text-capitalize text-center font-weight-bold">find your card</h5>

                            <form class="search-container" action="{{ route('front.search') }}">
                                <input type="text" name="search" value="" class="form-control search-bar"
                                    placeholder="Search ....">

                                <button type="submit" class="btn search-icon"><i class="fa fa-search"></i></button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="main close_nav">
        <div class="container">
            @yield("content")
        </div>
    </main>

    <a class="text-center" href="javascript:" id="return-to-top">
        <i class="rounded-circle fas fa-chevron-up"></i>
    </a>

    <div class="loading-overlay">
        <div class="spinner">
            <img src="{{ asset('front/images/splash.jpg') }}" alt="loading">
        </div>
    </div>

    <script src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/script.js') }}"></script>
    @yield("script")
</body>

</html>
