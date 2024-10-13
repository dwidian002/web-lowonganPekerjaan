@extends('layoutapplicant.main')
@section('content')

<section class="hero-section">
        <div class="hero__slider owl-carousel">
            <div class="hero__item set-bg" data-setbg="frontend/assets/img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <h5>Starting At Only $ 2.8/month</h5>
                                <h2>Welcome to the best<br /> hosting company</h2>
                                <a href="#" class="primary-btn">Get started now</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero__img">
                                <img src="frontend/assets/img/hero/hero-right.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__item set-bg" data-setbg="frontend/assets/img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <h5>Starting At Only $ 2.8/month</h5>
                                <h2>Welcome to the best<br /> hosting company</h2>
                                <a href="#" class="primary-btn">Get started now</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero__img">
                                <img src="frontend/assets/img/hero/hero-right.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Register Domain Section Begin -->
    <section class="register-domain spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="register__text">
                        <div class="section-title">
                            <h3>Register Your Domain Now!</h3>
                        </div>
                        <div class="register__form">
                            <form action="#">
                                <input type="text" placeholder="ex: cloudhost">
                                <div class="change__extension">
                                    .com
                                    <ul>
                                        <li>.net</li>
                                        <li>.org</li>
                                        <li>.me</li>
                                    </ul>
                                </div>
                                <button type="submit" class="site-btn">Search</button>
                            </form>
                        </div>
                        <div class="register__result">
                            <ul>
                                <li>.com <span>$1.95</span></li>
                                <li>.net <span>$1.95</span></li>
                                <li>.org <span>$1.95</span></li>
                                <li>.us <span>$1.95</span></li>
                                <li>.in <span>$1.95</span></li>
                            </ul>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Register Domain Section End -->

    <!-- Services Section Begin -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>Choose the right hosting solution</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="services__item">
                        <h5>Shared Hosting</h5>
                        <span>Starts At $1.84</span>
                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="services__item">
                        <h5>Wordpress Hosting</h5>
                        <span>Starts At $1.84</span>
                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="services__item">
                        <h5>Dedicated Hosting</h5>
                        <span>Starts At $1.84</span>
                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="services__item">
                        <h5>SSL certificate</h5>
                        <span>Starts At $1.84</span>
                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="services__item">
                        <h5>Web Hosting</h5>
                        <span>Starts At $1.84</span>
                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="services__item">
                        <h5>Cloud server</h5>
                        <span>Starts At $1.84</span>
                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Pricing Section Begin -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="section-title normal-title">
                        <h3>Choose your plan</h3>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="pricing__swipe-btn">
                        <label for="month" class="active">Monthly
                            <input type="radio" id="month">
                        </label>
                        <label for="yearly">Yearly
                            <input type="radio" id="yearly">
                        </label>
                    </div>
                </div>
            </div>
            <div class="row monthly__plans active">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="pricing__item">
                        <h4>Started</h4>
                        <h3>$15.90 <span>/ month</span></h3>
                        <ul>
                            <li>2,5 GB web space</li>
                            <li>Free site buiding tools</li>
                            <li>Free domain registar</li>
                            <li>24/7 Support</li>
                            <li>Free marketing tool</li>
                            <li>99,9% Services uptime</li>
                            <li>30 day money back</li>
                        </ul>
                        <a href="#" class="primary-btn">Choose plan</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="pricing__item">
                        <h4>Business</h4>
                        <h3>$25.90 <span>/ month</span></h3>
                        <ul>
                            <li>90 GB web space</li>
                            <li>Free site buiding tools</li>
                            <li>Free domain registar</li>
                            <li>24/7 Support</li>
                            <li>Free marketing tool</li>
                            <li>99,9% Services uptime</li>
                            <li>30 day money back</li>
                        </ul>
                        <a href="#" class="primary-btn">Choose plan</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="pricing__item">
                        <h4>Premium</h4>
                        <h3>$35.90 <span>/ month</span></h3>
                        <ul>
                            <li>150 GB web space</li>
                            <li>Free site buiding tools</li>
                            <li>Free domain registar</li>
                            <li>24/7 Support</li>
                            <li>Free marketing tool</li>
                            <li>99,9% Services uptime</li>
                            <li>30 day money back</li>
                        </ul>
                        <a href="#" class="primary-btn">Choose plan</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="pricing__item">
                        <h4>Dedicated</h4>
                        <h3>$45.90 <span>/ month</span></h3>
                        <ul>
                            <li>Unlimited web space</li>
                            <li>Free site buiding tools</li>
                            <li>Free domain registar</li>
                            <li>24/7 Support</li>
                            <li>Free marketing tool</li>
                            <li>99,9% Services uptime</li>
                            <li>30 day money back</li>
                        </ul>
                        <a href="#" class="primary-btn">Choose plan</a>
                    </div>
                </div>
            </div>
            <div class="row yearly__plans">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="pricing__item">
                        <h4>Started</h4>
                        <h3>$150 <span>/ month</span></h3>
                        <ul>
                            <li>2,5 GB web space</li>
                            <li>Free site buiding tools</li>
                            <li>Free domain registar</li>
                            <li>24/7 Support</li>
                            <li>Free marketing tool</li>
                            <li>99,9% Services uptime</li>
                            <li>30 day money back</li>
                        </ul>
                        <a href="#" class="primary-btn">Choose plan</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="pricing__item">
                        <h4>Business</h4>
                        <h3>$250 <span>/ month</span></h3>
                        <ul>
                            <li>90 GB web space</li>
                            <li>Free site buiding tools</li>
                            <li>Free domain registar</li>
                            <li>24/7 Support</li>
                            <li>Free marketing tool</li>
                            <li>99,9% Services uptime</li>
                            <li>30 day money back</li>
                        </ul>
                        <a href="#" class="primary-btn">Choose plan</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="pricing__item">
                        <h4>Premium</h4>
                        <h3>$350 <span>/ month</span></h3>
                        <ul>
                            <li>150 GB web space</li>
                            <li>Free site buiding tools</li>
                            <li>Free domain registar</li>
                            <li>24/7 Support</li>
                            <li>Free marketing tool</li>
                            <li>99,9% Services uptime</li>
                            <li>30 day money back</li>
                        </ul>
                        <a href="#" class="primary-btn">Choose plan</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="pricing__item">
                        <h4>Dedicated</h4>
                        <h3>$450 <span>/ month</span></h3>
                        <ul>
                            <li>Unlimited web space</li>
                            <li>Free site buiding tools</li>
                            <li>Free domain registar</li>
                            <li>24/7 Support</li>
                            <li>Free marketing tool</li>
                            <li>99,9% Services uptime</li>
                            <li>30 day money back</li>
                        </ul>
                        <a href="#" class="primary-btn">Choose plan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection