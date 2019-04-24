<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ env('APP_NAME') }}</title>
    <!-- core CSS -->
    <link href="/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/css/font-awesome.min.css" rel="stylesheet">
    <link href="/frontend/css/animate.min.css" rel="stylesheet">
    <link href="/frontend/css/owl.carousel.css" rel="stylesheet">
    <link href="/frontend/css/owl.transitions.css" rel="stylesheet">
    <link href="/frontend/css/main.css" rel="stylesheet">
    <link href="/lib/fullcalendar/fullcalendar.min.css"rel="stylesheet" >
    <link href="/lib/fullcalendar/fullcalendar.print.min.css" media="print" rel="stylesheet" >

    @yield('css')

    <link href="/frontend/css/custom.css" rel="stylesheet">
    <link href="/common/css/style.css" rel="stylesheet">
    <!--[if lt IE 9]-->
    <script src="/frontend/js/html5shiv.js"></script>
    <script src="/frontend/js/respond.min.js"></script>
    <!--[endif]-->
</head><!--/head-->

<body id="@yield('bodyId')">

<header id="header">
    <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
            </div>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li class="scroll"><a href="/">ホーム </a></li>
                    <li class="scroll"><a href="{{ route('home') }}/#services">活動の主旨と内容 </a></li>
                    <li class="scroll"><a href="/#act">活動の様子 </a></li>
                    <li class="scroll"><a href="/#events">活動予定 </a></li>
                    <li class="scroll"><a href="/#testimonial">主催者 </a></li>
                    <li class="scroll"><a href="/#get-in-touch">問い合せ </a></li>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</header><!--/header-->

@yield('content')

<footer id="footer">
    <div class="container text-center">
        All rights reserved &copy; 2017 | <a href="http://www.pfind.com/goodies/bizexpress/">BizExpress Template</a> from
        <a href="http://www.pfind.com/goodies/">pFind.com</a>
    </div>
</footer><!--/#footer-->

<script src="/frontend/js/jquery.js"></script>
<script src="/frontend/js/bootstrap.min.js"></script>

<script src="/frontend/js/wow.min.js"></script>
<script src="/frontend/js/owl.carousel.min.js"></script>
<script src="/frontend/js/mousescroll.js"></script>
<script src="/frontend/js/smoothscroll.js"></script>
<script src="/frontend/js/jquery.prettyPhoto.js"></script>
<script src="/frontend/js/jquery.isotope.min.js"></script>
<script src="/frontend/js/jquery.inview.min.js"></script>
<script src="/frontend/js/main.js"></script>
<script src="/frontend/js/scrolling-nav.js"></script>
<script src="/lib/moment/moment.js"></script>
<script src="/lib/fullcalendar/fullcalendar.min.js"></script>
<script src='/lib/fullcalendar/locale/ja.js'></script>
@yield('js')

</body>
</html>