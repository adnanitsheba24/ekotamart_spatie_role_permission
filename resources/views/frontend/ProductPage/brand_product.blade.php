@extends('frontend.master')
@section('mainpage')
@section('title')
Brand Page|| {{$brand->brand_name_en}}
@endsection

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
<div class="content_one" style="min-height: 1000px;">
  <div class="container">
    <div style="display: flex; margin-top:50px;"> <a href="{{ url('/')}}" style="text-decoration: none; ">@if (session()->get('language')=='bangla')
        <h1 >প্রচ্ছদ</h1>
        @else
        <h1>Home</h1>
        @endif
      </a> <h1>/</h1>
      <a href="{{ route('productPage.brand')}}" style="text-decoration: none; ">@if (session()->get('language')=='bangla')
        <h1 >ব্র্যান্ড</h1>
        @else
        <h1>Brand</h1>
        @endif
      </a>
      <h1>   / {{ session()->get('language')=='bangla'?   $brand->brand_name_bn : $brand->brand_name_en }}
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

@endsection