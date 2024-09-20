<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Deerhost Template">
    <meta name="keywords" content="Deerhost, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DEERHOST | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="frontend/assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="frontend/assets/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="frontend/assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="frontend/assets/css/style.css" type="text/css">
</head>

<body>
    
    <!-- Header Section Begin -->
    @include('layoutfe.header')
    <!-- Header End -->

    <!-- Hero Section Begin -->
    @yield('content')
    <!-- Pricing Section End -->

    <!-- Achievement Section Begin -->
    <section class="achievement-section set-bg spad" data-setbg="frontend/assets/img/achievement-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="achievement__item">
                        <span class="fa fa-user-o"></span>
                        <h2 class="achieve-counter">2468</h2>
                        <p>Clients</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="achievement__item">
                        <span class="fa fa-edit"></span>
                        <h2 class="achieve-counter">2468</h2>
                        <p>Domains</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="achievement__item">
                        <span class="fa fa-clone"></span>
                        <h2 class="achieve-counter">2468</h2>
                        <p>Server</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="achievement__item">
                        <span class="fa fa-cog"></span>
                        <h2 class="achieve-counter">2468</h2>
                        <p>Installs</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Achievement Section End -->

    <!-- Work Section Begin -->
    <section class="work-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>HOW TO BUILD YOUR WEBSITE ONLINE TODAY?</h3>
                    </div>
                    <div class="work__text">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="work__item">
                                    <i class="fa fa-desktop"></i>
                                    <span>CREATE YOUR OWN WEBSITE WITH OUR</span>
                                    <h3>WEB SITE BUILDER</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices
                                        gravida facilisis. </p>
                                    <a href="#" class="primary-btn">Read More</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="work__item">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span>EASY CREATE, MANAGE & SELL</span>
                                    <h3>ONLINE STORE</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices
                                        gravida facilisis. </p>
                                    <a href="#" class="primary-btn">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Work Section End -->

    <!-- Choose Plan Section Begin -->
    <section class="choose-plan-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <img src="frontend/assets/img/choose-plan.png" alt="">
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="plan__text">
                        <h3>up to 70% discount with free domain name registration included!</h3>
                        <ul>
                            <li><span class="fa fa-check"></span> FREE Domain Name</li>
                            <li><span class="fa fa-check"></span> FREE Email Address</li>
                            <li><span class="fa fa-check"></span> Plently of disk space</li>
                            <li><span class="fa fa-check"></span> FREE Website Bullder</li>
                            <li><span class="fa fa-check"></span> FREE Marketing Tools</li>
                            <li><span class="fa fa-check"></span> 1-Click WordPress Install</li>
                        </ul>
                        <a href="#" class="primary-btn">Get start now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Choose Plan Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="footer__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer__top-call">
                            <h5>Need Help? Call us</h5>
                            <h2>+1 175 946 2316 096</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer__top-auth">
                            <h5>Join Now And Have Free Month Of Deluxe Hosting</h5>
                            <a href="#" class="primary-btn">Log in</a>
                            <a href="#" class="primary-btn sign-up">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__text set-bg" data-setbg="frontend/assets/img/footer-bg.png">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="footer__text-about">
                            <div class="footer__logo">
                                <a href="frontend/assets/index.html"><img src="frontend/assets/img/logo.png" alt=""></a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida viverra maecen
                                lacus vel facilisis. </p>
                            <div class="footer__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer__text-widget">
                            <h5>Company</h5>
                            <ul>
                                <li><a href="#">Company</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Press & Media</a></li>
                                <li><a href="#">News / Blogs</a></li>
                                <li><a href="#">Careers</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer__text-widget">
                            <h5>Hosting</h5>
                            <ul>
                                <li><a href="#">Web Hosting</a></li>
                                <li><a href="#">Reseller Hosting</a></li>
                                <li><a href="#">VPS Hosting</a></li>
                                <li><a href="#">Dedicated Servers</a></li>
                                <li><a href="#">Cloud Hosting</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="footer__text-widget">
                            <h5>cONTACT US</h5>
                            <ul class="footer__widget-info">
                                <li><span class="fa fa-map-marker"></span> 500 South Main Street Los Angeles,<br />
                                    ZZ-96110 USA</li>
                                <li><span class="fa fa-mobile"></span> 125-711-811 | 125-668-886</li>
                                <li><span class="fa fa-headphones"></span> Support.hosting@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer__text-copyright">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="frontend/assets/js/jquery-3.3.1.min.js"></script>
    <script src="frontend/assets/js/bootstrap.min.js"></script>
    <script src="frontend/assets/js/jquery.slicknav.js"></script>
    <script src="frontend/assets/js/owl.carousel.min.js"></script>
    <script src="frontend/assets/js/main.js"></script>
</body>

</html>