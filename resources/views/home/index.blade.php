@extends('layouts.app')
@section('banner-text')
    @include('inc.home.banner-text-home')
@endsection
@section('content')
    <!-- welcome -->
    <div class="welcome-agileits">
        <div class="container">
            <h3 class="w3ls-title">Investing for health and wealth</h3>
            <div class="welcome-agile-row">
                <div class="col-sm-4 welcome-wthreegrid">
                    <h4>Vision</h4>
                    <!--<img src="{{asset('images/img1.jpg')}}" alt=" " class="img-responsive" />-->
                    <p>To positively impact lives localy and on an international level.</p>
                </div>
                <div class="col-sm-4 welcome-wthreegrid">
                    <h4>Mission</h4>
                <!--<img src="{{asset('images/img2.jpg')}}" alt=" " class="img-responsive" />-->
                    <p>To make sure that each and every Nella member lives a healthy and wealthy life.</p>
                </div>
                <div class="col-sm-4 welcome-wthreegrid">
                    <h4>Values</h4>
                <!--<img src="{{asset('images/img3.jpg')}}" alt=" " class="img-responsive" />-->
                    <p>Be Trustworthy, Value People, Promise and deliver.</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //welcome -->
    <!-- about -->
    <div class="w3about">
        <div class="container">
            <!--<img src="{{asset('images/i1.png')}}" class="w3slid-img" alt=""/>-->
            <div class="w3about-agileinfo">
                <p>Earn money on a weekly basis from as little 50,000 ugx and above. Enjoy a sales bonus on every product purchased
                    . Build a business with a strong team and earn sponsoring bonus. Get quick collateral free loans. </p>
                <a href="{{url('about')}}" class="w3layouts-more"> Read more</a>
            </div>
        </div>
    </div>
    <!-- //about -->
    <!-- news -->
    <div class="news">
        <div class="container">
            <h3 class="w3ls-title">News & Events</h3>
            <div class="news-agileinfo">
                <div class="col-md-8 news-w3row">
                    <div class="wthree-news-grids">
                        <div class="col-md-3 col-xs-3 datew3-agileits">
                            <img src="{{asset('images/img1.jpg')}}" class="img-responsive" alt=""/>
                        </div>
                        <div class="col-md-9 col-xs-9 datew3-agileits-info ">
                            <h5><a href="#">The Nella Launch</a></h5>
                            <h6>01/05/2017</h6>
                            <p>On this date Nella Was officially Launched , and started operation, locally, nationally and globally</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="wthree-news-grids news-grids-mdl">
                        <div class="col-md-3 col-xs-3 datew3-agileits datew3-agileits-fltrt">
                            <img src="{{asset('images/img2.jpg')}}" class="img-responsive" alt=""/>
                        </div>
                        <div class="col-md-9 col-xs-9 datew3-agileits-info datew3-agileits-info-fltlft">
                            <h5><a href="#">Training Sessions at Studio 24 Restaurant</a></h5>
                            <h6>10/07/2017</h6>
                            <p>People in the Ntinda Area, You can now attend and invite people to attend trainings every sunday at 2:00pm east african time at Studio 24 Restaurant.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="wthree-news-grids">
                        <div class="col-md-3 col-xs-3 datew3-agileits">
                            <img src="{{asset('images/img3.jpg')}}" class="img-responsive" alt=""/>
                        </div>
                        <div class="col-md-9 col-xs-9 datew3-agileits-info ">
                            <h5><a href="#">Wandegeya Training centre opening soon!</a></h5>
                            <h6>07/11/2017</h6>
                            <p>As part of the plan to bring services to the people, Nella is openning up a new training centre at Wandegeya Market on the Second floor.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4 news-right agileits-w3layouts">
                    <h4>Benefits &amp; How to Earn with Nella</h4>
                    <div class="achievesw3-agile">
                        <ul>
                            <li><a href="#"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Sponsoring Bonus.</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Matching Bonus.</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Weekly Pay. </a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Sales Bonus.</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Monthly Cumulative cheque.</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Low Rate quick Loans</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Boda Boda Loan. </a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Travel incentives.</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Team support.</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //news -->
@endsection
