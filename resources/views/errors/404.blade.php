@extends('frontend.master')
@section('mainpage')
@section('title')
Page not found!
@endsection
@php
    $main_category = DB::table('categories')->orderBy('id', 'ASC')->get();
    $sub_category = DB::table('sub_categories')->get();
    $sub_sub_category = DB::table('sub_sub_categories')->get();
@endphp
    <div class="body-content outer-top-bd">
        <div class="container" style="height: 650px;">
            <div class="x-page inner-bottom-sm">
                <div class="row">
                    <div class="col-md-12 x-text text-center">
                        <h1 class="text-danger">404</h1>
                        <p>We are sorry, the page you've requested is not available. </p>
                        <a href="{{ url('/') }}">
                            <button class="btn-default le-button"><i class="fa fa-home"></i> Go To Homepage</button>
                        </a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
        </div><!-- /.container -->
    </div><!-- /.body-content -->

    @endsection