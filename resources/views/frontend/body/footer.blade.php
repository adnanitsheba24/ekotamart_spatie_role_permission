<!-- <style>
    #footer_content_one {
        margin-right: -30px !important;
    }
</style> -->
@php
$admin_Data = DB::table('site_settings')->first();
@endphp


<>


<div id="footer_content_one" class="content_one" style="background: #172337; padding:50px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 text-md-center text-lg-left text-center">
                <div class="footer_head">INFORMATION</div>
                <ul class="footer-menu">
                    <li class="menu-item"><a href="{{route('about.us')}}" class="text-decoration-none">About Us</a></li>
                    <li class="menu-item"><a href="{{route('contact.us')}}" class="text-decoration-none">Contact Us</a></li>
                    <li class="menu-item"><a href="{{route('how.buy')}}" class="text-decoration-none">How To Buy</a></li>
                </ul>
            </div>
            <div class="col-lg-2 text-md-center text-lg-left text-center">
                <div class="footer_head">CUSTOMER SERVICE</div>
                <ul class="footer-menu">
                    <li class="menu-item"><a href="{{ route('SecurityPolicy') }}" class="text-decoration-none">Security Policy</a></li>
                    <li class="menu-item"><a href="{{ route('ShippingReplacement') }}" class="text-decoration-none">Shipping &amp; Replacement</a></li>
                    <li class="menu-item"><a href="{{ route('PrivacyPolicy') }}" class="text-decoration-none">Privacy Policy</a></li>
                    <li class="menu-item"><a href="{{route('TermsUse') }}" class="text-decoration-none">Terms Of Use</a></li>
                </ul>
            </div>
            <div class="col-lg-2 text-md-center text-lg-left text-center">
                <div class="footer_head">MY ACCOUNT</div>
                <ul class="footer-menu">
                    <li class="menu-item"><a href="{{route('my.orders')}}" class="text-decoration-none">Track Order</a></li>
                    <li class="menu-item"><a href="{{route('user.profile')}}" class="text-decoration-none">Account</a></li>
                    <!-- <li class="menu-item"><a href="" class="text-decoration-none">Feedback</a></li> -->
                </ul>
            </div>
            <div class="col-lg-3 text-md-center text-lg-left text-center">
                <div class="footer_head">CONTACT US</div>
                <ul class="footer-menu">
                    <li class="menu-item"><i class="fa fa-map-marker-alt "></i><span>&nbsp; {{ isset($admin_Data->company_address)? $admin_Data->company_address : '' }}</span></li>
                    <li class="menu-item"><i class="fa fa-envelope -green"></i><span>&nbsp;{{ isset($admin_Data->email)? $admin_Data->email : '' }}</span></li>
                    <li class="menu-item"><i class="fa fa-mobile "></i><span>&nbsp;Hotline: {{ isset($admin_Data->phone_one)? $admin_Data->phone_one : '' }}</span></li>
                    <li class="menu-item"><i class="fa fa-mobile "></i><span>&nbsp;Emergency: {{ isset($admin_Data->phone_two)? $admin_Data->phone_two : '' }}</span></li>
                </ul>
            </div>
            <div class="col-lg-3 text-md-center text-lg-left text-center">

                <div style="color: #fff; margin-top: 25px; justify-content: center; display: grid;">
                    <ul>
                        <li class="menu-item"><span>&nbsp;Copyright © 2023</span></li>
                        <li class="menu-item"><span>&nbsp;www.ekotamart.com/</span></li>
                        <li class="menu-item"><span>&nbsp;all rights reserved</span></li>
                    </ul>

                    <div class="soc-icons">
                        <a aria-label="Link" href="{{ isset($admin_Data->facebook)? $admin_Data->facebook : '' }}" target="_blank" rel="noopener"><i class="fab fa-facebook p-1 text-wheat" style="color: #fff;"></i></a>
                        <a aria-label="Link" href="{{ isset($admin_Data->twitter)? $admin_Data->twitter : '' }}" target="_blank" rel="noopener"><i class="fab fa-twitter p-1 text-wheat" style="color: #fff;"></i></a>
                        <a aria-label="Link" href="{{ isset($admin_Data->linkedin)? $admin_Data->linkedin : '' }}" target="_blank" rel="noopener"><i class="fab fa-linkedin p-1 text-wheat" style="color: #fff;"></i></a>
                        <a aria-label="Link" href="{{ isset($admin_Data->youtube)? $admin_Data->youtube : '' }}" target="_blank" rel="noopener"><i class="fab fa-youtube p-1 text-wheat" style="color: #fff;"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <style>
            body {
                font-family: Arial;
            }

            * {
                box-sizing: border-box;
            }

            form.subscribe_form input[type=email] {
                padding: 10px;
                font-size: 17px;
                border: 1px solid grey;
                float: left;
                width: 70%;
                background: #f1f1f1;
            }

            form.subscribe_form button {
                float: left;
                width: 30%;
                padding: 10px;
                background: #2196F3;
                color: white;
                font-size: 17px;
                border: 1px solid grey;
                border-left: none;
                cursor: pointer;
            }

            form.subscribe_form button:hover {
                background: #0b7dda;
            }

            form.subscribe_form::after {
                content: "";
                clear: both;
                display: table;
            }
        </style>
        <br>
        <div class="row">
            <div class="col-md-6">
                <form class="subscribe_form" action="#" style="margin:auto;max-width:100%">
                    <input type="email" placeholder="Subscribe@email.com" name="subscribe_input">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <h6 style="color:#0b7dda;">Designed and Developed by <a href="https://itsheba24.com/">ITsheba24.com</a>.</h6>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>
