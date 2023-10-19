@extends('admin.admin_master')
@section('admin')

    <style>

        img {
        max-width: 100%; }

        .preview {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
            -ms-flex-direction: column;
                flex-direction: column; }
        @media screen and (max-width: 996px) {
            .preview {
            margin-bottom: 20px; } }

        .preview-pic {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
                flex-grow: 1; }

        .preview-thumbnail.nav-tabs {
        border: none;
        margin-top: 15px; }
        .preview-thumbnail.nav-tabs li {
            width: 18%;
            margin-right: 2.5%; }
            .preview-thumbnail.nav-tabs li img {
            max-width: 100%;
            display: block; }
            .preview-thumbnail.nav-tabs li a {
            padding: 0;
            margin: 0; }
            .preview-thumbnail.nav-tabs li:last-of-type {
            margin-right: 0; }

        .tab-content {
        overflow: hidden; }
        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
                    animation-name: opacity;
            -webkit-animation-duration: .3s;
                    animation-duration: .3s; }

        .card {
        margin-top: 50px;
        background: #eee;
        padding: 3em;
        line-height: 1.5em; }

        /* @media screen and (min-width: 997px) {
        .wrapper {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex; } } */

        .details {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
            -ms-flex-direction: column;
                flex-direction: column; }

        .colors {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
                flex-grow: 1; }

        .product-title, .sizes, .colors {
        text-transform: UPPERCASE;
        font-weight: bold;
        }

        .checked {
        color: #ff9f1a; 
        }

        .prices{
            color: #e00000;
        }

        .product-title, .rating, .product-description, .vote, .sizes {
        margin-bottom: 15px;
        }

        .product-title {
        margin-top: 0; }

        .size {
        margin-right: 10px; }
        .size:first-of-type {
            margin-left: 40px; }

        .color {
        display: inline-block;
        vertical-align: middle;
        margin-right: 10px;
        height: 2em;
        width: 2em;
        border-radius: 2px; }
        .color:first-of-type {
            margin-left: 20px; }

        .add-to-cart, .like {
        background: #ff9f1a;
        padding: 1.2em 1.5em;
        border: none;
        text-transform: UPPERCASE;
        font-weight: bold;
        color: #fff;
        -webkit-transition: background .3s ease;
                transition: background .3s ease; }
        .add-to-cart:hover, .like:hover {
            background: #b36800;
            color: #fff; }

        .not-available {
        text-align: center;
        line-height: 2em; }
        .not-available:before {
            font-family: fontawesome;
            content: "\f00d";
            color: #fff; }

        .orange {
        background: #ff9f1a; }

        .green {
        background: #85ad00; }

        .blue {
        background: #0076ad; }

        .tooltip-inner {
        padding: 1.3em; } 

        @-webkit-keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
                    transform: scale(3); }
        100% {
            opacity: 1;
            -webkit-transform: scale(1);
                    transform: scale(1); } }

        @keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
                    transform: scale(3); }
        100% {
            opacity: 1;
            -webkit-transform: scale(1);
                    transform: scale(1); } } 

        /*# sourceMappingURL=style.css.map */
    </style>
	
        
    <div class="container">
        <div class="box-header with-border" style="margin-top: 30px;">
            <h3 class="box-title">User Details View</h3>
        </div>
        
        <div class="box-body">
            <div class="container-fliud">
                <div class="wrapper row">

                    <div class="preview col-md-6">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1">
                                @if ($users->profile_photo_path == '' || $users->profile_photo_path == null)
                                    <img src="{{ asset('upload/no_image.jpg') }}" style="height: 240px; width:220px;" alt="No Image">
                                @else
                                    <img id="preview_click_img" src="{{ URL::to('storage/face_photo', $users->profile_photo_path) }}" style="height: 240px; width:220px;">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="details col-md-6">
                        <h4 class="product-title head-text">Name: {{ $users->name }}</h4>
                        <p class="product-description head-text">Email: {{ $users->email }}</p>
                        <br>
                        <h5 class="head-text"><strong>Phone: &nbsp;</strong><span >{{ $users->phone }}</span></h5>
                        <h5 class="head-text"><strong>Date of Barth: &nbsp;</strong><span>{{ $users->date_of_birth }} </span></h5><br>
                        
                        @if ($users->gender)
                            <h5 class="head-text"><strong>Gender: &nbsp;</strong><span>{{ $users->gender }} </span></h5><br>
                        @else
                            <h5 class="head-text"><strong>Gender: &nbsp;</strong><span>{{$users->order == null ? " " : $users->order->gender }}</span></h5><br>
                        @endif

                        @if ($users->address)
                            <h5 class="head-text"><strong>Address: &nbsp;</strong><span>{{ $users->address }} </span></h5><br>
                        @else
                            <h5 class="head-text"><strong>Address: &nbsp;</strong><span>{{$users->order == null ? " " : $users->order->address }}</span></h5><br>
                        @endif

                        @if ($users->order == null)
                            <h5 class="head-text"><strong>Division: &nbsp;</strong><span></span></h5><br>
                        @else
                            <h5 class="head-text"><strong>Division: &nbsp;</strong><span>{{$users->order == null ? " " : $ship_division }}</span></h5><br>
                        @endif

                        @if ($users->order == null)
                            <h5 class="head-text"><strong>District: &nbsp;</strong><span></span></h5><br>
                        @else
                            <h5 class="head-text"><strong>District: &nbsp;</strong><span>{{$users->order == null ? " " : $ship_district }}</span></h5><br>
                        @endif

                        @if ($users->order == null)
                            <h5 class="head-text"><strong>Upazila: &nbsp;</strong><span></span></h5><br>
                        @else
                            <h5 class="head-text"><strong>Upazila: &nbsp;</strong><span>{{$users->order == null ? " " : $ship_upazila }}</span></h5><br>
                        @endif

                    </div>
                    
                </div>
            </div>
        </div>
    </div>

@endsection