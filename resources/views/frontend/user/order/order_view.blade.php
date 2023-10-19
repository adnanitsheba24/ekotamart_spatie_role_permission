@extends('frontend.master')
@section('mainpage')

    @section('title')
    My Orders
    @endsection

    <style>
        .body-content .my-wishlist-page .my-wishlist table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
        vertical-align: middle;
        border: none;
        padding: 20px;
        }
    </style>

    <div class="content_one justify-content-center" style="min-height: 700px;">
       
            <div class="row p-5">

              
                {{-- <div class="col-md-2">
                    @include('frontend.common.user_sidebar')
                </div> --}}
                <div style="margin-top: -15px; color: red;"><h4><b>My Orders</b></h4></div>

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>   
                                <tr style="background: #e0e0e0;">
                                    <td>
                                        <label for=""><b>Sl.No</b></label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""><b>Date</b></label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""><b>Total Amount</b></label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> <b>Payment Method</b></label>
                                    </td>


                                    <td class="col-md-2">
                                        <label for=""><b>Invoice Number</b></label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for=""><b>Order Status</b></label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""><b>Action</b></label>
                                    </td>
                                    
                                </tr>

                                @foreach($orders as $key => $order)
                                    <tr>
                                        <td class="col-md-1">
                                            <label for=""> {{ $key + 1 }}</label>
                                        </td>

                                        <td class="col-md-1">
                                            <label for=""> {{ $order->order_date }}</label>
                                        </td>

                                        <td class="col-md-3">
                                            <label for=""> {{ $order->amount }} Taka</label>
                                        </td>


                                        <td class="col-md-3">
                                            <label for=""> {{ $order->payment_method }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> {{ $order->invoice_no }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> 
                                                @if($order->status == 'pending')        
                                                        <span class="badge badge-pill badge-warning" style="background: #800080;"> Pending </span>
                                                    @elseif($order->status == 'confirm')
                                                        <span class="badge badge-pill badge-warning" style="background: #0000FF;"> Confirm </span>

                                                    @elseif($order->status == 'processing')
                                                        <span class="badge badge-pill badge-warning" style="background: #FFA500;"> Processing </span>

                                                    @elseif($order->status == 'picked')
                                                        <span class="badge badge-pill badge-warning" style="background: #808000;"> Picked </span>

                                                    @elseif($order->status == 'shipped')
                                                        <span class="badge badge-pill badge-warning" style="background: #808080;"> Shipped </span>

                                                    @elseif($order->status == 'delivered')
                                                        <span class="badge badge-pill badge-warning" style="background: #008000;"> Delivered </span>
                                                    <br>

                                                    @if($order->return_order == 1) 
                                                        <span class="badge badge-pill badge-warning" style="background:red;">Return Requested </span>
                                                    @elseif($order->return_order == 2)
                                                        <span class="badge badge-pill badge-warning" style="background:#b30505;">Product Returned </span>
                                                    @elseif($order->return_order == 3)
                                                        <span class="badge badge-pill badge-warning" style="background:#620505;">Return Cancel</span>
                                                    @endif

                                                @else
                                                    <span class="badge badge-pill badge-warning" style="background: #FF0000;"> Cancel </span>
                                                @endif
                                            </label>

                                            <br>
                                            <br>
                                            
                                            @if($order->status == 'pending') 
                                                {{-- <a href="{{ route('orders.cancel') }}" class="badge badge-pill badge-warning" style="background:#a80505;">Order Cancel</a> --}}
                                                <a href="{{ route('orders.cancel',$order->id) }}" class="btn btn-danger btn-sm" id="order_cancel" title="Order Cancel"><i class="fa fa-trash"></i></a>
                                            @endif


                                        </td>

                                        <td class="col-md-1">
                                            <a href="{{ url('user/order_details/'.$order->id ) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>
                                            <a target="_blank" href="{{ url('user/invoice_download/'.$order->id ) }}" class="btn btn-sm btn-danger" style="margin-top: 5px;"><i class="fa fa-download" style="color: white;"></i> Invoice </a>                       
                                        </td>                     
                                    </tr>
                                @endforeach
                                <hr>
                            </tbody>             
                        </table>
                    </div>         
                </div> <!-- / end col md 8 -->      
            </div> <!-- // end row -->

  </div>
@endsection
