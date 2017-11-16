<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nella International | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Networking, Health and Wealth" />
    <link rel="shortcut icon" href="{{asset('images/n1.png')}}">
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- Custom Theme files -->
    <link href="{{asset('css/site/bootstrap.css')}}" type="text/css" rel="stylesheet" media="all">
    <link href="{{asset('css/site/style.css')}}" type="text/css" rel="stylesheet" media="all">
    <link href="{{asset('css/site/font-awesome.css')}}" rel="stylesheet"> <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('css/site/flexslider.css')}}" type="text/css" media="all"/>
    <!-- //Custom Theme files -->
    <!-- js -->
    <script src="{{asset('js/site/jquery-2.2.3.min.js')}}"></script>
    <!-- //js -->
    <!-- web-fonts -->
    <link href="//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200,300,400,700" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- //web-fonts -->
</head>
<body>
<!-- banner -->
<div class="banner">
    <div class="banner-info">
        <!-- header -->
        <div class="agileheader">
            <div class="container">
                <div class="agile-hdleft nav navbar-nav navbar-left">
                    <p>
                        <i class="fa fa-phone" aria-hidden="true"> </i> +256 701 460 497<!-- &nbsp;&nbsp;
                        <i class="fa fa-envelope-o" aria-hidden="true"> </i> info@nellainternational.com-->
                    </p>
                </div>
                <div class="agileits-hdright nav navbar-nav navbar-right">
                    <div class="social-icon">
                        <a href="#" class="social-button twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="social-button facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="social-button google hidden-xs"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="social-button dribbble" title="Uganda"><i class="fa fa-flag"></i></a>
                        @if (Auth::guest())
                            <a href="{{url('login')}}" class="social-button skype" style="color: #00e58b;">
                                <i class="fa fa-user hidden-sm hidden-md hidden-lg"></i>
                                <span class="hidden-xs">Login</span>
                            </a>
                        @elseif(!Auth::guest() && Auth::user()->role_id == null)
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                               class="social-button skype" style="color: #00e58b;">
                                <i class="fa fa-user hidden-sm hidden-md hidden-lg"></i>
                                <span class="hidden-xs">Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @else
                            <a href="{{url('my-account')}}" class="social-button skype" style="color: #00e58b;">
                                <i class="fa fa-user hidden-sm hidden-md hidden-lg"></i>
                                <span class="hidden-xs">Account</span>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <!-- //header -->
        <!-- banner-text -->
        @yield('banner-text')
        <!-- //banner-text -->
    </div>
</div>
<!-- //banner -->
<!-- top-navigation -->
<div class="w3top-nav">
    <div class="agile-logo navbar-left">
        <h2>
            <a href="{{url('/')}}">
                <img height="60" width="150" src="{{asset('images/n1.png')}}">
            </a>
        </h2>
    </div>
    <div class="w3lsnav-right navbar-left">
        <nav>
            <ul>
                <li>
                    <div class="item-container">
                        <a href="{{url('/')}}" class="item-top active"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        <a href="{{url('/')}}" class="item-bottom"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    </div>
                </li>
                <li>
                    <div class="item-container">
                        <a href="{{url('about')}}" class="item-top"><i class="fa fa-info-circle" aria-hidden="true"></i> About</a>
                        <a href="{{url('about')}}" class="item-bottom"><i class="fa fa-info-circle" aria-hidden="true"></i> About</a>
                    </div>
                </li>
                <li>
                    <div class="item-container">
                        <a href="{{url('gallery')}}" class="item-top"><i class="fa fa-picture-o" aria-hidden="true"></i> Gallery</a>
                        <a href="{{url('gallery')}}" class="item-bottom"><i class="fa fa-picture-o" aria-hidden="true"></i> Gallery</a>
                    </div>
                </li>
                <li class="w3dropdown">
                    <div class="item-container">
                        <a href="#" class="item-top"><i class="fa fa-file-text-o" aria-hidden="true"></i> Opportunity <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        <a href="#" class="item-bottom"><i class="fa fa-file-text-o" aria-hidden="true"></i> Opportunity <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                    </div>
                    <ul class="nav1">
                        <li><a href="{{url('how-to-join')}}">How To Join</a></li>
                        <li><a href="{{url('how-to-join')}}">More</a></li>
                    </ul>
                </li>
                <li>
                    <div class="item-container">
                        <a href="{{url('contact')}}" class="item-top"><i class="fa fa-envelope-o" aria-hidden="true"></i> Contact</a>
                        <a href="{{url('contact')}}" class="item-bottom"><i class="fa fa-envelope-o" aria-hidden="true"></i> Contact</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"> </div>
</div>
<!-- //top-navigation -->
<!-- welcome -->

@yield('content')

<!-- //news -->
<!-- map -->
<div class="map-agileits-w3layouts">
    <div class="address-left">
        <h4>Contact Info</h4>
        <ul>
            <li><i class="fa fa-map-marker"></i> 4036 Ntinda, Kampala Uganda.</li>
            <li><i class="fa fa-mobile"></i>+256 772 460 697</li>
            <li><i class="fa fa-phone"></i> +256 701 460 497 </li>
            <li><a href="mailto:info@nellainternational.com"><i class="fa fa-envelope-o"></i>  info@nellainternational.com</a></li>
        </ul>
    </div>
    <iframe style="background-color: #ddd;"></iframe>
    <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3009.065628559584!2d-73.56132838451484!3d41.04569387929697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c29f54f2536d45%3A0x70e5d6e0d3e58caa!2sSuper+8+Stamford!5e0!3m2!1sen!2sin!4v1478582264012"></iframe>-->
</div>
<!-- //map -->
<!-- subscribe -->
<div class="subscribe wthree-sub">
    <div class="container">
        <h4>Subscribe to get our monthly newsletter</h4>
        <form id="subscribe-newsletter" action="{{ url('subscribe-newsletter') }}" method="post">
            {{ csrf_field() }}
            <input type="email" name="Email" placeholder="Enter your Email..." required="">
            <input type="hidden" name="Country" value="1">
            <input type="submit" value="Go" onclick="event.preventDefault();
                                                     document.getElementById('subscribe-newsletter').submit();">
            <div class="clearfix"> </div>
        </form>
        <p>Nella International &nbsp;&bull;&nbsp; Uganda &nbsp;&bull;&nbsp; Kenya &nbsp;&bull;&nbsp; Tanzania
            &nbsp;&bull;&nbsp; Rwanda &nbsp;&bull;&nbsp; DRC &nbsp;&bull;&nbsp; South Sudan &nbsp;&bull;&nbsp; <a href="#">Privacy policy</a>.</p>
    </div>
</div>
<!-- //subscribe -->
<!-- copy rights start here -->
<div class="copy-w3right">
    <div class="container">
        <div class="social-icon">
            <a href="#" class="social-button twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="social-button facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="social-button google"><i class="fa fa-google-plus"></i></a>
            <a href="#" class="social-button dribbble"><i class="fa fa-dribbble"></i></a>
            <a href="#" class="social-button skype"><i class="fa fa-skype"></i></a>
        </div>
        <p>© {{date('Y')}} Nella &bull; All Rights Reserved &bull; Design by  <a href="http://pearlbrains.com/" target="_blank">PearlBrains</a> </p>
    </div>
</div>
<!-- //copy right end here -->
<script src="{{asset('js/site/SmoothScroll.min.js')}}"></script>
<!-- start-smooth-scrolling -->
<script type="text/javascript" src="{{asset('js/site/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('js/site/easing.js')}}"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();

            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>
<!-- //end-smooth-scrolling -->
<!-- smooth-scrolling-of-move-up -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
        var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
        };
        */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<!-- //smooth-scrolling-of-move-up -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('js/site/bootstrap.js')}}"></script>
</body>
</html>