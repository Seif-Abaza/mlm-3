@extends('layouts.app')
@section('banner-text')
    @include('inc.home.banner-text-contact')
@endsection
@section('content')
    <!-- contact -->
    <div class="contact" id="contact">
        <div class="container">
            <div class="contact-grids">
                <div class="col-md-6 w3ls-address">
                    <h4>Get in touch with us</h4>
                    <p class="cnt-p">Nella International . Uganda, Kenya, Tanzania, DRC, Rwanda, Burundi, South Sudan ...</p>
                    <p class="address">Wandegeya market <br> P.O Box 4036, Kampala<br> UGANDA </p>
                    <p>Telephone : +256 701 460 497</p>
                    <p>Mob : +256 772 490 467</p>
                    <p>Email : <a href="mailto:info@nellainternational.com">info@nellainternational.com</a></p>
                </div>
                <div class="col-md-6 contact-form">
                    <form action="{{url('send-message')}}" method="post" id="send-message">
                        {{ csrf_field() }}
                        <input type="hidden" name="Country" value="1">
                        <input type="text" name="Name" placeholder="Name" required="">
                        <input type="email" name="Email" placeholder="Email" required="">
                        <textarea placeholder="Message" name="Message" required=""></textarea>
                        <input type="submit" value="SUBMIT" onclick="event.preventDefault();
                                                     document.getElementById('send-message').submit();">
                    </form>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //contact -->
@endsection
