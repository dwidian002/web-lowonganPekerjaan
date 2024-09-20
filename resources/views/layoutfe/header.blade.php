<!-- Page Preloder -->
<div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas__menu__overlay"></div>
    <div class="offcanvas__menu__wrapper">
        <div class="canvas__close">
            <span class="fa fa-times-circle-o"></span>
        </div>
        <div class="offcanvas__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <nav class="offcanvas__menu mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./about.html">About</a></li>
                <li><a href="./hosting.html">Hosting</a></li>
                <li><a href="#">Pages</a>
                    <ul class="dropdown">
                        <li><a href="./pricing.html">Pricing</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                        <li><a href="./404.html">404</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">News</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <ul>
                <li><a href="#"><span class="icon_chat_alt"></span> Live chat</a></li>
                <li><a href={{url('/login')}}><span class="fa fa-user"></span> Login</a></li>
                <li><a href={{url('/register')}}><span class="fa fa-user"></span> Register</a></li>
            </ul>
        </div>
        <div class="offcanvas__info">
            <ul>
                <li><span class="icon_phone"></span> +1 123-456-7890</li>
                <li><span class="fa fa-envelope"></span> Support@gmail.com</li>
            </ul>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header__info">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__info-left">
                            <ul>
                                <li><span class="icon_phone"></span> +1 123-456-7890</li>
                                <li><span class="fa fa-envelope"></span> Support@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__info-right">
                            <ul>
                                <li><a href="#"><span class="icon_chat_alt"></span> Live chat</a></li>
                                <li><a href={{url('/login')}}><span class="fa fa-user"></span> Login</a></li>
                                <li><a href={{url('/register')}}><span class="fa fa-user"></span> Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a href="./about.html">About</a></li>
                            <li><a href="./hosting.html">Hosting</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./pricing.html">Pricing</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                    <li><a href="./404.html">404</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">News</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="canvas__open">
                <span class="fa fa-bars"></span>
            </div>
        </div>
    </header>
    <!-- Header End -->