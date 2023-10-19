@php
$site_setting = DB::table('site_settings')->first();
@endphp
@extends('frontend.master')
@section('mainpage')
@section('title')
{{ @$site_setting->company_name }}
@endsection
@header('Cache-Control: max-age=3600')
<style>
  @media (min-width: 1200px) {
    h1 {
      font-size: 1.5rem;
    }
  }
</style>
<label for="cart_check" style="z-index: 10;position: fixed;display: block;">
  <section class="cart-view bg-white shadow rounded" id="cart_section">
    <div class="icon text-center">
      <span>
        <!-- <i class="fas fa-shopping-cart fa-2x"></i> -->
        <img src="{{ asset('frontend/logopng05.png') }}" alt="" width="30px" loading="lazy">
      </span>
    </div>
    <div class="text-center text-dark font-weight-bold" id="total_items_div" style="background-color: red;">
      <span style="color: white;" id="cartQty">0</span>
      <span style="color: white;">
        @if (session()->get('language')=='bangla')
        পন্য
        @else
        Items
        @endif
      </span>
    </div>
    <div class="text-center text-dark font-weight-bold">
      <span class="total-price"> <span class="sign">৳</span>
        <span class="value" id="cartSubTotal">0</span> </span>
    </div>
  </section>
</label>

<a href="{{ route('mycart') }}" class="notification">
  <span><img src="{{asset('frontend/cartb.png')}}" alt="" width="30px" loading="lazy"></span>
  <span class="badge" style="color: white;" id="mobileQty">0</span>
</a>

<!-- frontend image slider -->
<div class="content_one" id="frontSlider" style="margin-top: 30px;">
</div>
<!-- frontend image slider -->

<div class="content_one" id="slider_content_one">
  <div class="card text-center m-2">
    <div class="card-header" style="background: #8f00ff;">
      <a href="{{ route('productPage.special')}}" style="text-decoration: none;">
        <h1 style="font-family: 'Pacifico'; color:aliceblue;">{{ session()->get('language')=='bangla'?  "স্পেশাল অফার": "Special Offer"  }} </h1>
      </a>
    </div>
    <div class="card-body">
      <div class="slide-container swiper">
        <div class="slide-content">
          <div class="card-wrapper swiper-wrapper">
            @foreach ($special_offer as $hot)
            <div class="card swiper-slide">
              <a href="{{ route('product.special', ['product_id'=> $hot->id] ) }}" style="text-decoration: none;">
                <div class="image-content">
                  <span class="overlay"></span>
                  <div class="card-image">
                    <img src="{{ URL::to('storage/products/thambnail', $hot->product_thambnail) }}" alt="" class="card-img" loading="lazy">
                  </div>
                </div>
                <div class="card-content">
                  <h2 class="name"> {{ session()->get('language')=='bangla'?  Illuminate\Support\Str::limit($hot->product_name_bn,15) : Illuminate\Support\Str::limit($hot->product_name_en,15) }}</h2>
                  <p class="description">
                    @if (isset($hot->discount_price))
                  <div class="row">
                    <div class="col-6 d-flex justify-content-end">
                      <span style="color: red;">৳&nbsp;{{$hot->discount_price}} </span>
                    </div>
                    <div class="col-6 d-flex justify-content-start">
                      <span style="text-decoration: line-through;">৳&nbsp;{{$hot->selling_price}} </span>
                    </div>
                  </div>
                  @else
                  <span style="color: red;">৳&nbsp;{{$hot->selling_price}} </span>
                  @endif
                  </p>
                  <p class="description">
                    <span style="color:crimson;font-size: 12px; font-weight: bold;"> {{ $hot->product_qty>10 ? "Stock available": "Stock Limited" }}</span>
                  </p>
                  <!-- <a href="{{ route('productPage.special')}}" class="button" style="text-decoration: none;">View More</a> -->
                </div>
              </a>
            </div>
            @endforeach
          </div>
        </div>

        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
</div>


<div class="content_one" style="margin-top:10px;">
  <div class="row mx-2">
    <div class="col-md-6">
      <div class="card text-dark bg-light mb-3" style="max-width: 100%">
        <div class="card-header" style="background: #B284BE;">
          <a href="{{ route('productPage.special.deal')}}" style="text-decoration: none;">
            <h1 style="font-family: 'Pacifico'; color:aliceblue;">{{ session()->get('language')=='bangla'?  "স্পেশাল ডিল": "Special Deal"  }} </h1>
          </a>
        </div>
        <div class="card-body">
          <!-- <div class="row" style=" border: 1px solid #eee; margin : -8px"> -->
          <div style="border: 1px solid #eee; margin : -8px; overflow: auto;white-space: nowrap; ">
            @foreach ($special_deals as $hot)
            <!-- <div class="col-md" style="margin : 10px"> -->
            <div style="margin : 10px;  display: inline-block;">
              <div class="card customcard" style=" position: initial;">
                <a href="{{ route('product.special.deal', ['product_id'=> $hot->id])}}" style="text-decoration: none;">
                  <div class="card-body" style="max-width: 100px;">
                    <img src="{{ URL::to('storage/products/thambnail', $hot->product_thambnail) }}" alt="" style="text-align:center; margin: auto;    display: block;" loading="lazy">
                    <a href="{{ url('product/details/'.$hot->id)}}"></a>
                    <h5 class="card-title" style="text-align:center;white-space:break-spaces; min-height:20px;">{{ session()->get('language')=='bangla'? Illuminate\Support\Str::limit($hot->product_name_bn,15) :  Illuminate\Support\Str::limit($hot->product_name_en,15)}}</h5>
                    <p class="description">
                      <span style="color:crimson;font-size: 10px; font-weight: bold;"> {{ $hot->product_qty>10 ? "Stock available": "Stock Limited"}}</span>
                    </p>

                    @if (isset($hot->discount_price))
                    <div class="row">
                      <div class="col-6 d-flex justify-content-end">
                        <span style="color: red;">৳&nbsp;{{$hot->discount_price}} </span>
                      </div>
                      <div class="col-6 d-flex justify-content-start">
                        <span style="text-decoration: line-through;">৳&nbsp;{{$hot->selling_price}} </span>
                      </div>
                    </div>
                    @else
                    <span style="color: red;">৳&nbsp;{{$hot->selling_price}} </span>
                    @endif
                  </div>
                </a>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card text-dark bg-light mb-3">
        <div class="card-header" style="background:#F34486;">
          <a href="{{ route('productPage.featured')}}" style="text-decoration: none;">
            <h1 style="font-family: 'Pacifico'; color:aliceblue;">{{session()->get('language')=='bangla'? "ফিচারড" : "Featured"}}</h1>
        </div>
        <div class="card-body">
          <!-- <div class="row" style=" border: 1px solid #eee; margin : -8px"> -->
          <div style=" border: 1px solid #eee; margin : -8px;  overflow: auto;white-space: nowrap;">
            @foreach ($featured as $hot)
            <!-- <div class="col-md" style="margin : 10px"> -->
            <div style="margin : 10px;  display: inline-block;">
              <div class="card customcard" style=" position: initial;">
                <a href="{{ route('product.featured', ['product_id'=> $hot->id])}}" style="text-decoration: none;">
                  <div class="card-body" style="max-width: 100px;">
                    <img src="{{ URL::to('storage/products/thambnail', $hot->product_thambnail) }}" alt="" style="text-align:center; margin: auto;display: block;" loading="lazy">
                    <a href="{{ url('product/details/'.$hot->id)}}"></a>
                    <h5 class="card-title" style="text-align:center;white-space:break-spaces; min-height:20px;">{{ session()->get('language')=='bangla'? Illuminate\Support\Str::limit($hot->product_name_bn,15) :  Illuminate\Support\Str::limit($hot->product_name_en,15)}}</h5>
                    <p class="description">
                      <span style="color:crimson;font-size: 10px; font-weight: bold;"> {{ $hot->product_qty>10 ? "Stock available": "Stock Limited"}} </span>
                    </p>

                    @if (isset($hot->discount_price))
                    <div class="row">
                      <div class="col-6 d-flex justify-content-end">
                        <span style="color: red;">৳&nbsp;{{$hot->discount_price}} </span>
                      </div>
                      <div class="col-6 d-flex justify-content-start">
                        <span style="text-decoration: line-through;">৳&nbsp;{{$hot->selling_price}} </span>
                      </div>
                    </div>
                    @else
                    <span style="color: red;">৳&nbsp;{{$hot->selling_price}} </span>
                    @endif
                  </div>
                </a>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="content_one" style="margin-top:10px;">
  <div class="card text-center  m-2">
    <div class="card-header" style="background:#6C9BCF;">
      <a href="{{ route('productPage.hotdeal') }}" style="text-decoration: none;">
        <h1 style="font-family: 'Pacifico'; color:aliceblue;"><i class="fa-solid fa-fire fa-shake" style="color: #fa7000;"></i>{{ session()->get('language')=='bangla'?  "হট ডিল": "Hot Deal"  }} <i class="fa-solid fa-fire fa-shake" style="color: #fa7000;"></i></h1>
      </a>
    </div>
    <div class="card-body">
      <!-- <div class="row" style=" border: 1px solid #eee; margin : -8px"> -->
      <div style=" border: 1px solid #eee; margin : -8px;  overflow: auto;white-space: nowrap;">
        @foreach ($hot_deal as $hot)

        <div style="margin : 10px;  display: inline-block;">
          <div class="card customcard" style=" position: initial;">
            <a href="{{ route('product.featured', ['product_id'=> $hot->id])}}" style="text-decoration: none;">
              <div class="card-body" style="max-width: 100px;">
                <img src="{{ URL::to('storage/products/thambnail', $hot->product_thambnail) }}" alt="" style="text-align:center; margin: auto;display: block;" loading="lazy" width="70px" height="70px">
                <a href="{{ url('product/details/'.$hot->id)}}"></a>
                <h5 class="card-title" style="text-align:center;white-space:break-spaces; min-height:20px;">{{ session()->get('language')=='bangla'? Illuminate\Support\Str::limit($hot->product_name_bn,15) :  Illuminate\Support\Str::limit($hot->product_name_en,15)}}</h5>
                <p class="description">
                  <span style="color:crimson;font-size: 10px; font-weight: bold;"> {{ $hot->product_qty>10 ? "Stock available": "Stock Limited"}} </span>
                </p>

                @if (isset($hot->discount_price))
                <div class="row">
                  <div class="col-6 d-flex justify-content-end">
                    <span style="color: red;">৳&nbsp;{{$hot->discount_price}} </span>
                  </div>
                  <div class="col-6 d-flex justify-content-start">
                    <span style="text-decoration: line-through;">৳&nbsp;{{$hot->selling_price}} </span>
                  </div>
                </div>
                @else
                <span style="color: red;">৳&nbsp;{{$hot->selling_price}} </span>
                @endif
              </div>
            </a>
          </div>
        </div>

        @endforeach
      </div>
    </div>
  </div>
</div>

@php
$color = array("#FC4F00","#643A6B","#4C4C6D","#E76161","#19A7CE","#B71375","#394867","#0A4D68");
$k=0;
@endphp

@if ($category_wise_product!= " ")

@foreach ( $category_wise_product as $category_product )
@if (count( $category_product) != NULL)
<div class="content_one" style="margin-top:10px;">
  <div class="card text-center  m-2">
    <div class="card-header" style='background:
     {{ $color[rand(0,7)] }}
     '>
      <a href="{{ route('productPage.category', [ 'mainCategory_id'=>$category_product[0]->category->id, 'mainCategory_name'=>$category_product[0]->category->category_name_en] )}}" style="text-decoration: none;">
        <h1 style="font-family: 'Pacifico'; color:aliceblue;"> <img src="{{ asset('storage/category_icon/'.$category_product[0]->category->category_icon ) }}" alt="" width="40px" height="40px" loading="lazy"> {{ session()->get('language')=='bangla'? $category_product[0]->category->category_name_bn :$category_product[0]->category->category_name_en  }} <img src="{{ asset('storage/category_icon/'.$category_product[0]->category->category_icon ) }}" alt="" width="40px" height="40px" loading="lazy"> </h1>
      </a>
    </div>
    <div class="card-body">
      <!-- <div class="row" style=" border: 1px solid #eee; margin : -8px"> -->
      <div style=" border: 1px solid #eee; margin : -8px;  white-space: nowrap;overflow: auto;">
        @foreach ($category_product as $hot)
        <!-- <div class="col-md" style="margin : 10px"> -->
        <div style="margin : 10px;  display: inline-block;">
          <a href="#" style="text-decoration: none;">
            <div class="card " style="width: 222px; position: initial;">
              <div class="card-body">
                <img src="{{ URL::to('storage/products/thambnail', $hot->product_thambnail) }}" alt="" style="text-align:center; margin: auto; width: 150px; height: 150px; display: block; {{ $hot->product_qty < 1 ? 'opacity:.3;' : '' }} " loading="lazy">
                <a href="{{ url('product/details/',$hot->id)}}"></a>
                <h5 class="card-title" style=" text-align:center; white-space:break-spaces; min-height:20px;"> {{ session()->get('language')=='bangla'? Illuminate\Support\Str::limit($hot->product_name_bn,15) :  Illuminate\Support\Str::limit($hot->product_name_en,15)}}</h5>
                @if ($hot->product_qty < 1) <p class="card-text text-danger fw-bold" style="text-align:center;">Stock out</p>
                  @else
                  @if ($hot->product_qty > 10)
                  <p class="card-text text-success fw-bold" style="text-align:center;">Stock available</p>
                  @else
                  <p class="card-text text-warning fw-bold" style="text-align:center;">Stock Limited</p>
                  @endif
                  @endif

                  @if (isset($hot->discount_price))
                  <div class="row">
                    <div class="col-6 d-flex justify-content-end">
                      <span style="color: red;">৳&nbsp;{{$hot->discount_price}} </span>
                    </div>
                    <div class="col-6 d-flex justify-content-start">
                      <span style="text-decoration: line-through;">৳&nbsp;{{$hot->selling_price}} </span>
                    </div>
                  </div>
                  @else
                  <span style="color: red;">৳&nbsp;{{$hot->selling_price}} </span>
                  @endif

                  <div class="btn-group cart_group" style="display: flex;">
                    <button class="btn btn-danger cart_button" type="button" title="Wishlist" id="{{ $hot->id }}" onclick="addToWishList(this.id)"><i class="fa-sharp fa-solid fa-heart"></i></button>
                    @php($flag = "NotFound")
                    @foreach ($carts as $key => $value)
                    @if ($value->name == $hot->product_name_en && $value->qty>0 )
                    <div id="{{ $hot->id }}" class="btn-group cart_group" style="display: flex; display:contents">
                      <button type="submit" class="btn btn-warning btn-sm cart_decrease" id="{{ $value->rowId }}" onclick="cartDecrement(this.id)">-</button>
                      <input type="text" value="{{ $value->qty }}" min="1" max="100" disabled="" style="width:25px;">
                      <button type="submit" class="btn btn-success btn-sm cart_increase" id="{{ $value->rowId }}" onclick="cartIncrement(this.id)">+</button>

                    </div>
                    @php($flag = "found")
                    @break
                    @endif
                    @endforeach

                    @if ($flag == "NotFound")
                    @if ($hot->product_qty < 1) 
                    <div id="{{ $hot->id }}" class="btn-group cart_group" style="display: flex; display:contents">
                      <button type="button" class="btn btn-primary add_stock" title="Request Stock" id="{{ $hot->id }}"  onclick="add_request_to_stock(this.id)" style="font-size: 12px;">Request stock</button>
                  </div>
                  @else
                  <div id="{{ $hot->id }}" class="btn-group cart_group" style="display: flex; display:contents">
                    <button type="button" class="btn btn-danger add_cart" title="Add Cart" id="{{ $hot->id }}" onclick="add_product_to_cart(this.id)" style="font-size: 12px;">
                      ADD TO CART
                    </button>
                  </div>
                  @endif

                  @endif

                  <div class="btn-group cart_group" style="display: flex; display:none"></div>
                  <button class="btn btn-danger cart_button" id="{{ $hot->id }}" data-bs-toggle="modal" data-bs-target="#pdoductDetailModal" onclick="show_product_detail(this.id)"><i class="fa-solid fa-eye"></i></button>
              </div>
            </div>
        </div>
        </a>
      </div>

      @endforeach
    </div>
  </div>
</div>
</div>
@endif
@endforeach
@endif

<!-- cartbar start -->
@include('frontend.body.cartbar')
<!-- cartbar end -->
<!-- Swiper JS -->
<script src="{{ asset('frontend/swiper-bundle.min.js') }}"></script>
@endsection
@push('custom-scripts')
<!-- show slider script start -->
<script type="text/javascript">
  function ShowSlider() {
    $.ajax({
      type: 'GET',
      url: '/slider/front/show',
      dataType: 'json',
      success: function(response) {
        var frontSlider = ""
        frontSlider += `<div class="img-slider" style=" width: auto;
    z-index: 1;
    margin-top: 0px;
    ">`
        $.each(response.sliders, function(key, value) {
          frontSlider += `<div class="image_slide` +
            (key == 0 ? " active" : " ") +
            `">`

            +
            `<a href="/category/${value.category}/category"><img src="/storage/slider/${value.slider_img}" alt=""></a>`

            +
            `
</div>`
        });
        frontSlider += `<div class="navigation">`
        $.each(response.sliders, function(key, value) {
          frontSlider += `<div class="image_btn` +
            (key == 0 ? " active" : " ") +
            `"></div>`
        });

        frontSlider += `</div>
  </div>`

        $('#frontSlider').html(frontSlider);

        var slides = document.querySelectorAll('.image_slide');
        var btns = document.querySelectorAll('.image_btn');
        let currentSlide = 0;

        // Javascript for image slider manual navigation
        var manualNav = function(manual) {
          slides.forEach((slide) => {
            slide.classList.remove('active');

            btns.forEach((btn) => {
              btn.classList.remove('active');
            });
          });

          slides[manual].classList.add('active');
          btns[manual].classList.add('active');
        }

        btns.forEach((btn, i) => {
          btn.addEventListener("click", () => {
            manualNav(i);
            currentSlide = i;
          });
        });
        // Javascript for image slider autoplay navigation
        var repeat = function(activeClass) {
          let active = document.getElementsByClassName('active');
          let i = 1;

          var repeater = () => {
            setTimeout(function() {
              [...active].forEach((activeSlide) => {
                activeSlide.classList.remove('active');
              });

              slides[i].classList.add('active');
              btns[i].classList.add('active');
              i++;

              if (slides.length == i) {
                i = 0;
              }
              if (i >= slides.length) {
                return;
              }
              repeater();
            }, 5000);
          }
          repeater();
        }
        repeat();
      }
    })
  }
  ShowSlider();
</script>



@endpush