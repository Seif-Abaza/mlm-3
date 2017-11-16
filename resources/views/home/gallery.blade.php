@extends('layouts.app')
@section('banner-text')
    @include('inc.home.banner-text-gallery')
@endsection
@section('content')
    <!-- gallery -->
    <div class="gallery">
        <div class="container">
            <h3 class="w3ls-title">Gallery</h3>
            <div class="gallery-w3lsrow">
                <div class="col-xs-8 col-sm-8 col-md-8 gallery-wthree-grids gallery-grids-mdl">
                    <div class="w3ls-hover">
                        <a href="{{url('images/g1.jpg')}}" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. In dignissim efficitur diam eu condimentum.">
                            <img src="{{url('images/g1.jpg')}}" class="img-responsive zoom-img" alt=""/>
                            <div class="captionw3-agile w3big-caption">
                                <h5>Boda bodas</h5>
                                <span class="glyphicon glyphicon-search"></span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 gallery-wthree-grids">
                    <div class="w3ls-hover">
                        <a href="{{url('images/g2.jpg')}}" data-lightbox="example-set" data-title="Consectetur adipiscing elit. Lorem ipsum dolor sit amet, In dignissim efficitur diam eu condimentum.">
                            <img src="{{url('images/g2.jpg')}}" class="img-responsive zoom-img" alt=""/>
                            <div class="captionw3-agile">
                                <h5>Real Estate</h5>
                                <span class="glyphicon glyphicon-search"></span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 gallery-wthree-grids">
                    <div class="w3ls-hover">
                        <a href="{{url('images/g3.jpg')}}" data-lightbox="example-set" data-title="In dignissim efficitur diam eu condimentum onsectetur adipiscing elit. Lorem ipsum dolor sit amet.">
                            <img src="{{url('images/g3.jpg')}}" class="img-responsive zoom-img" alt=""/>
                            <div class="captionw3-agile">
                                <h5>Loans</h5>
                                <span class="glyphicon glyphicon-search"></span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 gallery-wthree-grids">
                    <div class="w3ls-hover">
                        <a href="{{url('images/g5.jpg')}}" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. In dignissim efficitur diam eu condimentum.">
                            <img src="{{url('images/g5.jpg')}}" class="img-responsive zoom-img" alt=""/>
                            <div class="captionw3-agile">
                                <h5>Loans</h5>
                                <span class="glyphicon glyphicon-search"></span>
                            </div>
                        </a>
                    </div>
                    <div class="w3ls-hover gallery-w3grid-btm">
                        <a href="{{url('images/g2.jpg')}}" data-lightbox="example-set" data-title="Consectetur adipiscing elit. Lorem ipsum dolor sit amet, In dignissim efficitur diam eu condimentum.">
                            <img src="{{url('images/g2.jpg')}}" class="img-responsive zoom-img" alt=""/>
                            <div class="captionw3-agile">
                                <h5>Real Estate</h5>
                                <span class="glyphicon glyphicon-search"></span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 col-md-8 gallery-wthree-grids gallery-grids-mdl">
                    <div class="w3ls-hover">
                        <a href="{{url('')}}images/g4.jpg" data-lightbox="example-set" data-title="In dignissim efficitur diam eu condimentum onsectetur adipiscing elit. Lorem ipsum dolor sit amet.">
                            <img src="{{url('')}}images/g4.jpg" class="img-responsive zoom-img" alt=""/>
                            <div class="captionw3-agile w3big-caption">
                                <h5>Health care Products</h5>
                                <span class="glyphicon glyphicon-search"></span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!--  light box js -->
            <script src="{{url('js/site/lightbox-plus-jquery.min.js')}}"> </script>
            <!-- //light box js-->
        </div>
    </div>
    <!-- //gallery -->
@endsection
