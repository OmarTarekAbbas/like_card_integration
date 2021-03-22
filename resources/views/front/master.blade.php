<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <title>Like Card</title>
    <style type="text/css">
        body {
            font-family: "Open Sans", sans-serif;
        }
        h2 {
            color: #000;
            font-size: 26px;
            font-weight: 300;
            text-align: center;
            text-transform: uppercase;
            position: relative;
            margin: 30px 0 80px;
        }
        h2 b {
            color: #ffc000;
        }
        h2::after {
            content: "";
            width: 100px;
            position: absolute;
            margin: 0 auto;
            height: 4px;
            background: rgba(0, 0, 0, 0.2);
            left: 0;
            right: 0;
            bottom: -20px;
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

        .container-fluid {
            margin-top: 200px
        }

        p {
            font-size: 14px;
            margin-bottom: 7px
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

        h2 {
            color: rgb(78, 0, 92);
            letter-spacing: 2px !important
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
            h2 {
                color: rgb(78, 0, 92);
                font-size: 17px
            }

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
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('front.home') }}">Like Card</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            @foreach(categories() as $category)
                @if(count($category->childs) > 0)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $category->categoryName }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach ($category->childs as $child)
                                <li><a href="{{ route('front.products', ['category_id' => $child->id ]) }}">{{ $child->categoryName }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('front.products', ['category_id' => $category->id ]) }}">{{ $category->categoryName }}</a></li>
                @endif
            @endforeach
            </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    @yield("content")

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{url('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>
