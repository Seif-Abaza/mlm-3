@extends('layouts.app')
@section('banner-text')
    @include('inc.home.banner-text-opportunity')
@endsection
@section('content')
    <!-- contact -->
    <div class="contact" id="contact">
        <div class="container">
            <div class="contact-grids">
                <div class="col-md-6 w3ls-address">
                    <h4>How to become part of Nella.</h4>
                    <br>
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Amount (Ugx.)</td>
                                <td>Shares</td>
                                <td>Weekly Earnings</td>
                                <td>One Time Bonus</td>
                                <td>Pay Duration</td>
                                <td>Free products worth (Ugx.)</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>870,000</td>
                                <td>1</td>
                                <td>50,000</td>
                                <td>-</td>
                                <td>6 Months</td>
                                <td>150,000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2,610,000</td>
                                <td>3</td>
                                <td>100,000</td>
                                <td>-</td>
                                <td>8 Months</td>
                                <td>150,000</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>6,090,000</td>
                                <td>7</td>
                                <td>150,000</td>
                                <td>-</td>
                                <td>1 Year</td>
                                <td>150,000</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>10,000,000</td>
                                <td>7 (VIP)</td>
                                <td>250,000</td>
                                <td>500,000</td>
                                <td>1 Year</td>
                                <td>150,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-6 col-md-6 w3ls_services_grids">
                    <h4 style="font-style: normal; font-family: Roboto,sans-serif;font-weight: normal">How to Earn Money.</h4>
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i>Weekly/monthly pay</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>Matching bonus</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>Step Bonus</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>Sales Bonus</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>One Time Bonus</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>One Time Free products worth (150,000 Ugx)</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>Sponsoring Bonus</li>
                    </ul>
                    <br>
                    <h4 style="font-style: normal; font-family: Roboto,sans-serif;font-weight: normal">Other Benefits.</h4>
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i>Loan at 10% payable</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>Motor Cycle loan of 4,500,000.  7,500,000 Ugx payable weekly for 18 month.</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>Travel Incentives</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>Free Business Training</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>Annual &amp; seasonal awards</li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //contact -->
@endsection
