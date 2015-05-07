<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body class="{{isset($title)? $title:''}}">
    <div id="wrapper" class="container">

        <header class="row header" id="header1">
        <!--h1 class="site-title"><a href="index.html"><img src="../../images/logo.png" width="158" height="46" alt="ULIULI LOGO" /></a></h1-->
            @include('includes.body_header')
        </header><!-- header -->

        <div id="main" class="clearfix row content">
            <div id="banner-bg"></div>
                @yield('content')

        </div><!--main-->

        <footer id="footer" class="row footer">
            @include('includes.footer')
        </footer>

    <div><!--wrapper-->
    @include('includes.body_footer')
</body>
</html>