<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>

    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Guillermo A. Fisher">

    <meta name="google-site-verification" content="gD3PYmVi5Mh_W5JVtZa9Ifu4jsl4xyayCERwX2dVVYQ">

    <meta property="og:url" content="@yield('url')">
    <meta property="og:type" content="@yield('type')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('image')">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="/assets/img/icon.png">

    <!-- Bootstrap CSS -->
    <link href="/assets/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="/assets/vendor/datatables/media/css/jquery.dataTables.css" rel="stylesheet">

    <!-- App CSS -->
    <link href="/assets/css/guillermo.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden"><a href="#page-top"></a></li>
                    @yield('nav')
                    <li class="api"><a href="https://api.guillermoandraefisher.com/docs">API</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer>
        <ul class="list-inline social-media">
            <li><a href="https://open.spotify.com/user/1213990935"><i class="fa fa-2x fa-spotify"></i></a></li>
            <li><a href="https://github.com/guillermoandrae"><i class="fa fa-2x fa-github"></i></a></li>
            <li><a href="https://twitter.com/guillermoandrae"><i class="fa fa-2x fa-twitter"></i></a></li>
            <li><a href="https://pinterest.com/guillermoandrae"><i class="fa fa-2x fa-pinterest"></i></a></li>
            <li><a href="https://instagram.com/guillermoandrae"><i class="fa fa-2x fa-instagram"></i></a></li>
            <li><a href="https://linkedin.com/in/guillermoandrae"><i class="fa fa-2x fa-linkedin-square"></i></a></li>
        </ul>
        <div class="container text-center">
            <p>The code is yours; the content is mine. Behave yourself.<br><a href="https://guillermoandraefisher.com">https://guillermoandraefisher.com</a></p>
        </div>
    </footer>

    <!-- Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-7964669-2', 'auto');
        ga('send', 'pageview');

    </script>

    <!-- jQuery -->
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Easing Plugin JavaScript -->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    @yield('page-javascript')

</body>

</html>
