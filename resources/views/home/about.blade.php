@extends('layouts.app')
@section('banner-text')
    @include('inc.home.banner-text-about')
@endsection
@section('content')
    <!-- about page-->
    <div class="about agileits">
        <div class="container">
            <div class="about-agileinfo">
                <div class="col-md-8 about-w3grids">
                    <h3 style="color: #00cc66; font-family: Roboto,arial,helvetica,sans-serif">NELLA INTERNATIONAL LTD.</h3>
                    <p>Nella international also known as Nella Investments Uganda Limited is an Investment and
                        multi-level marketing company aimed at improving people’s health and empowering them financially.
                        As goes Nella’s slogan, “Investing for health and wealth”, Nella will bridge the gap between health and wealth.</p>
                    <br>
                    <p>Nella's business model is so far the best as it give back to its members. Nella is estimated to scale at
                    a very high rate with this business model. Helping its members grow financially and live healthy lives is part of Nella's goals</p>
                    <div class="w3ls_services">
                        <h3>Our Services</h3>
                        <div class="col-xs-6 col-md-6 w3ls_services_grids">
                            <h4 style="font-style: normal; font-family: Roboto,sans-serif;font-weight: normal">Investment & Finance</h4>
                            <ul>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Low Rate Loans</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Boda Boda Loans</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Real Estate</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Agricultural Produce</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Printing &amp; Textile</li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-md-6 w3ls_services_grids">
                            <h4 style="font-style: normal; font-family: Roboto,sans-serif;font-weight: normal">Good Health & Well being</h4>
                            <p>Distribution of NeoLife Products</p>
                            <ul>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Health Care Products</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Home Care Products</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Weight Management Products</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Skin Care products</li>
                            </ul>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 about-w3grids">
                    <img src="{{url('images/i1.png')}}" class="img-responsive" alt=""/>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- Our Stats -->
    <div class="w3about stats">
        <div class="container">
            <div class="stats-info agileits-w3layouts">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="w3ls-title">Our Mission</h3>
                        <p style="color: #fff;">To make sure that each and every Nella member lives a healthy and wealthy life.</p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="w3ls-title">Our Vision</h3>
                        <p style="color: #fff;">To positively impact lives localy and on an international level.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //Our Stats -->
    <!-- team -->
    <div class="team">
        <div class="container">
            <h3 class="w3ls-title">The Team</h3>
            <div class="wthree_team_grids">
                <div class=" col-xs-6 col-md-3 wthree_team_grid">
                    <div class="hovereffect">
                        <img src="{{url('images/t1.jpg')}}" alt=" " class="img-responsive" />
                        <div class="overlay">
                            <!--<h6>Skating</h6>-->
                            <div class="rotate">
                                <p class="group1">
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </p>
                                <hr>
                                <hr>
                                <p class="group2">
                                    <a href="#">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-dribbble"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <h4>Allen Aruho </h4>
                    <p>Managing Director</p>
                </div>
                <div class="col-xs-6  col-md-3 wthree_team_grid">
                    <div class="hovereffect">
                        <img src="{{url('images/t2.png')}}" alt=" " class="img-responsive" />
                        <div class="overlay">
                            <!--<h6>Skating</h6>-->
                            <div class="rotate">
                                <p class="group1">
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </p>
                                <hr>
                                <hr>
                                <p class="group2">
                                    <a href="#">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-dribbble"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <h4>Lydia Musinguzi</h4>
                    <p>Adviser </p>
                </div>
                <div class="col-xs-6 col-md-3 wthree_team_grid">
                    <div class="hovereffect">
                        <img src="{{url('images/t3.png')}}" alt=" " class="img-responsive" />
                        <div class="overlay">
                            <!--<h6>Skating</h6>-->
                            <div class="rotate">
                                <p class="group1">
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </p>
                                <hr>
                                <hr>
                                <p class="group2">
                                    <a href="#">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-dribbble"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <h4>Elvis Ndyamuhaki</h4>
                    <p>Director </p>
                </div>
                <div class="col-xs-6 col-md-3 wthree_team_grid">
                    <div class="hovereffect">
                        <img src="{{url('images/t4.jpg')}}" alt=" " class="img-responsive" />
                        <div class="overlay">
                            <!--<h6>Skating</h6>-->
                            <div class="rotate">
                                <p class="group1">
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </p>
                                <hr>
                                <hr>
                                <p class="group2">
                                    <a href="#">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa fa-dribbble"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <h4>Ellen Ainebyona</h4>
                    <p>Director </p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //team -->
    <!-- //about page -->
@endsection
