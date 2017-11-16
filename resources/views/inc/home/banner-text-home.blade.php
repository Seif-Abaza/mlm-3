<div class="banner-text">
    <div class="container">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <div class="banner-w3lstext">
                        <h5>Nella International</h5>
                        <h1>Health</h1>
                        <p>People don't get the required nutrients from the food they eat on a daily basis.
                            Therefore there is need to supplement their diet with food supplements. Nella has the answer</p>
                    </div>
                </li>
                <li>
                    <div class="banner-w3lstext">
                        <h5>Nella International</h5>
                        <h3>Wealth</h3>
                        <p>In This struggling economy, one needs a side income to supplement on their earnings.
                            Nella brings the opportunity to earn without investing much time and resources.  </p>
                    </div>
                </li>
                <li>
                    <div class="banner-w3lstext">
                        <h5>Nella International</h5>
                        <h3>Wellness</h3>
                        <p>Once one is healthy, they need to look, feel, and live well. Nella is the door to this achievement.
                            With a wide range of products and opportunities, with Nella you are set on your path to wellness</p>
                    </div>
                </li>
            </ul>
        </div>
        <!-- FlexSlider -->
        <script defer src="{{asset('js/site/jquery.flexslider.js')}}"></script>
        <script type="text/javascript">
            $(window).load(function(){
                $('.flexslider').flexslider({
                    animation: "slide",
                    start: function(slider){
                        $('body').removeClass('loading');
                    }
                });
            });
        </script>
        <!-- End-slider-script -->
    </div>
</div>