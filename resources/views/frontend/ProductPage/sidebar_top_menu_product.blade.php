@extends('frontend.master')
@section('mainpage')
@section('title')
EkotaMart  ||{{  $main_category_one->name_en }}
@endsection

<!-- <style>
  .sidebar {
    margin-top: 50px;
  }
</style> -->

<label for="cart_check" style="z-index: 10;position: fixed;display: block;">
  <section class="cart-view bg-white shadow rounded" id="cart_section">
    <div class="icon text-center">
      <span>
        <!-- <i class="fas fa-shopping-cart fa-2x"></i> -->
        <img src="{{ asset('frontend/logopng05.png') }}" alt="" width="30px" loading="lazy" loading="lazy">
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
      <span class="total-price">
        <span class="sign">৳</span>
        <span class="value" id="cartSubTotal">0</span>
      </span>
    </div>
  </section>
</label>
<a href="{{ route('mycart') }}" class="notification">
  <span><img src="{{asset('frontend/cartb.png')}}" alt="" width="30px" loading="lazy"></span>
  <span  class="badge" style="color: white;" id="mobileQty">0</span>
</a>
<div class="content_one" id="frontSlider" style="top: 50px;position: relative;">
</div>
<div class="content_one" style="min-height: 1000px; padding-top: 80px;">
  <div class="container">
    <div style="display: flex;"> <a href="{{ url('/')}}" style="text-decoration: none; ">@if (session()->get('language')=='bangla')
        <h1 >প্রচ্ছদ</h1>
        @else
        <h1>Home</h1>
        @endif
      </a>
      <h1>/ {{ session()->get('language')=='bangla'?$main_category_one->name_bn : $main_category_one->name_en }}
      </h1>
    </div>

    <!-- <h1 style="background: black; color:red; text-align:center;padding: 20px;border-radius: 37px; ">Hot Deal</h1> -->
    <div class="row" style=" border: 1px solid #eee; margin-top: 25px">
      @foreach ($product as $product)
      <!-- <div class="mb-3"> -->
      <div class="card m-1" style=" position: initial;max-width: 250px;">
        <div class="card-body"  >
          <img src="{{ URL::to('storage/products/thambnail', $product->product_thambnail) }}" alt="" style="text-align:center; margin: auto; width: 150px; height: 150px; display: block; {{ $product->product_qty < 1 ? 'opacity:.3;' : '' }}" loading="lazy">
          <a href="{{ url('product/details/'.$product->id)}}"></a>
          <h5 class="card-title" style="text-align:center;">{{ session()->get('language')=='bangla'? Illuminate\Support\Str::limit($product->product_name_bn,50): Illuminate\Support\Str::limit($product->product_name_en,50)  }}</h5>
          @if ($product->product_qty < 1)
          <p class="card-text text-danger fw-bold" style="text-align:center;">Stock out</p>
          @else
           @if ($product->product_qty > 10)
           <p class="card-text text-success fw-bold" style="text-align:center;">Stock available</p>
           @else
           <p class="card-text text-warning fw-bold" style="text-align:center;">Stock Limited</p>
           @endif 
          @endif
         
          <p class="card-text" style="text-align:center;">
            @if (isset($product->discount_price))
          <div class="row">
            <div class="col-md d-flex justify-content-end">
              <span style="color: red;">৳&nbsp;{{$product->discount_price}} </span>
            </div>
            <div class="col-md d-flex justify-content-start">
              <span style="text-decoration: line-through;">৳&nbsp;{{$product->selling_price}} </span>
            </div>
          </div>
          @else
          <span style="color: red;">৳&nbsp;{{$product->selling_price}} </span>
          @endif
          </p>


          <div class="btn-group cart_group" style="display: flex;">
            <button class="btn btn-danger cart_button" type="button" title="Wishlist" id="{{ $product->id }}" onclick="addToWishList(this.id)"><i class="fa-sharp fa-solid fa-heart"></i></button>
            @php($flag = "NotFound")
            @foreach ($carts as $key => $value)
            @if ($value->name == $product->product_name_en && $value->qty>0 )
            <div id="{{ $product->id }}" class="btn-group cart_group" style="display: flex; display:contents">
              <button type="submit" class="btn btn-warning btn-sm cart_decrease" id="{{ $value->rowId }}" onclick="cartDecrement(this.id)">-</button>
              <input type="text" value="{{ $value->qty }}" min="1" max="100" disabled="" style="width:25px;">
              <button type="submit" class="btn btn-success btn-sm cart_increase" id="{{ $value->rowId }}" onclick="cartIncrement(this.id)">+</button>

            </div>
            @php($flag = "found")
            @break
            @endif
            @endforeach

            @if ($flag == "NotFound")
            @if ($product->product_qty < 1)
            <div id="{{ $product->id }}" class="btn-group cart_group" style="display: flex; display:contents">
            <button type="button" class="btn btn-primary add_stock" title="Request Stock" id="{{ $product->id }}"  onclick="add_request_to_stock(this.id)" style="font-size: 12px;">Request stock</button>

            </div> 
            @else
            <div id="{{ $product->id }}" class="btn-group cart_group" style="display: flex; display:contents">
              <button type="button" class="btn btn-danger add_cart" title="Add Cart" id="{{ $product->id }}" onclick="add_product_to_cart(this.id)" style="font-size: 12px;">
                ADD TO CART
              </button>
            </div>  
            @endif

            @endif

            <div class="btn-group cart_group" style="display: flex; display:none"></div>
            <button class="btn btn-danger cart_button" id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#pdoductDetailModal" onclick="show_product_detail(this.id)"><i class="fa-solid fa-eye"></i></button>
          </div>
        </div>
      </div>
      <!-- </div> -->
      @endforeach
    </div>
</div>
</div>
@include('frontend.body.cartbar')

@push('custom-scripts')
<script type="text/javascript">
  function ShowSlider() {
    $.ajax({
      type: 'GET',
      url: '/slider/top_sidebar_menu_slider/show/{{ strtolower($main_category_one->name_en) }}',
      dataType: 'json',
      success: function(response) {
        var frontSlider = ""
        frontSlider += `<div class="img-slider" style=" width: auto;z-index: 1;margin-top: 0px;">`
        $.each(response.sliders, function(key, value) {
          frontSlider += `<div class="image_slide` +
            (key == 0 ? " active" : " ") +
            `">`

            +
            `<img src="/storage/slider/${value.slider_img}" alt="">`

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
        if (response.sliders.length > 0) {
          $('#frontSlider').html(frontSlider);
        }


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
            }, 10000);
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

@endsection


