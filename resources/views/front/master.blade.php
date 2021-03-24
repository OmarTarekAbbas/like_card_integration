<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Like Card</title>
    <link rel="shortcut icon" href="{{ asset('front/images/logo1.png') }}">
    <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style_en.css') }}">
    <style type="text/css">
        body {
            font-family: "Open Sans", sans-serif;
        }
        .carousel {
            margin: 50px auto;
            padding: 0 70px;
        }
        .carousel .item {
            min-height: 330px;
            text-align: center;
            overflow: hidden;
        }
        .carousel .item .img-box {
            height: 160px;
            width: 100%;
            position: relative;
        }
        .carousel .item img {
            max-width: 100%;
            max-height: 100%;
            display: inline-block;
            position: absolute;
            bottom: 0;
            margin: 0 auto;
            left: 0;
            right: 0;
        }
        .carousel .item h4 {
            font-size: 18px;
            margin: 10px 0;
        }
        .carousel .item .btn {
            color: #333;
            border-radius: 0;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            background: none;
            border: 1px solid #ccc;
            padding: 5px 10px;
            margin-top: 5px;
            line-height: 16px;
        }
        .carousel .item .btn:hover, .carousel .item .btn:focus {
            color: #fff;
            background: #000;
            border-color: #000;
            box-shadow: none;
        }
        .carousel .item .btn i {
            font-size: 14px;
            font-weight: bold;
            margin-left: 5px;
        }
        .carousel .thumb-wrapper {
            text-align: center;
        }
        .carousel .thumb-content {
            padding: 15px;
        }
        .carousel .carousel-control {
            height: 100px;
            width: 40px;
            background: none;
            margin: auto 0;
            background: rgba(0, 0, 0, 0.2);
        }
        .carousel .carousel-control i {
            font-size: 30px;
            position: absolute;
            top: 50%;
            display: inline-block;
            margin: -16px 0 0 0;
            z-index: 5;
            left: 0;
            right: 0;
            color: rgba(0, 0, 0, 0.8);
            text-shadow: none;
            font-weight: bold;
        }
        .carousel .item-price {
            font-size: 13px;
            padding: 2px 0;
        }
        .carousel .item-price strike {
            color: #999;
            margin-right: 5px;
        }
        .carousel .item-price span {
            color: #86bd57;
            font-size: 110%;
        }
        .carousel .carousel-control.left i {
            margin-left: -3px;
        }
        .carousel .carousel-control.left i {
            margin-right: -3px;
        }
        .carousel .carousel-indicators {
            bottom: -50px;
        }
        .carousel-indicators li, .carousel-indicators li.active {
            width: 10px;
            height: 10px;
            margin: 4px;
            border-radius: 50%;
            border-color: transparent;
        }
        .carousel-indicators li {
            background: rgba(0, 0, 0, 0.2);
        }
        .carousel-indicators li.active {
            background: rgba(0, 0, 0, 0.6);
        }
        .star-rating li {
            padding: 0;
        }
        .star-rating i {
            font-size: 14px;
            color: #ffc000;
        }
        .small {
            letter-spacing: 0.5px !important
        }

        .card-1 {
            box-shadow: 2px 2px 10px 0px rgb(190, 108, 170)
        }

        hr {
            background-color: rgba(248, 248, 248, 0.667)
        }

        .bold {
            font-weight: 500
        }

        .change-color {
            color: #AB47BC !important
        }

        .card-2 {
            box-shadow: 1px 1px 3px 0px rgb(112, 115, 139)
        }

        .fa-circle.active {
            font-size: 8px;
            color: #AB47BC
        }

        .fa-circle {
            font-size: 8px;
            color: #aaa
        }

        .rounded {
            border-radius: 2.25rem !important
        }

        .progress-bar {
            background-color: #AB47BC !important
        }

        .progress {
            height: 5px !important;
            margin-bottom: 0
        }

        .invoice {
            position: relative;
            top: -70px
        }

        .Glasses {
            position: relative;
            top: -12px !important
        }

        .card-footer {
            background-color: #AB47BC;
            color: #fff
        }

        .display-3 {
            font-weight: 500 !important
        }

        @media (max-width: 479px) {
            .invoice {
                position: relative;
                top: 7px
            }

            .border-line {
                border-right: 0px solid rgb(226, 206, 226) !important
            }
        }

        @media (max-width: 700px) {

            .display-3 {
                font-size: 28px;
                font-weight: 500 !important
            }
        }

        .card-footer small {
            letter-spacing: 7px !important;
            font-size: 12px
        }

        .border-line {
            border-right: 1px solid rgb(226, 206, 226)
        }
    </style>

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

                <li class="nav-item dropdown">
                    @if(app()->getLocale() == 'en')
                    <a class="nav-link dropdown-toggle link_href text-capitalize" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="true" aria-expanded="false">english</a>
                    @else
                    <a class="nav-link dropdown-toggle link_href text-capitalize" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="true" aria-expanded="false">عربى</a>
                    @endif
                    <div class="dropdown-menu text-capitalize">
                        <a class="dropdown-item" href="{{ url('lang/en') }}">english</a>
                        <a class="dropdown-item" href="{{ url('lang/ar') }}">عربي</a>
                    </div>
                </li>

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

                            <form class="search-container" action="#0">
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
</body>

</html>
