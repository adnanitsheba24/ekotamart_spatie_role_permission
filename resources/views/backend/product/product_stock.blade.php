@extends('admin.admin_master')
@section('admin')

      <!-- Content Wrapper. Contains page content -->
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <div class="row">

        <div class="col-12">
           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Product Stock List <span class="badge badge-pill badge-danger">{{ count($products) }}</span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="head-text">
                          <tr>
                              <th width="1%">Sl.No</th>
                              <th>Image</th>
                              <th>Product Code</th>
                              <th>Product Name</th>
                              <th class="text-center">Product Price</th>
                              <th class="text-center">Quantity</th>
                              <th class="text-center">Discount</th>
                              <th class="text-center">Status</th>
                              <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($products as $key => $item)
                          <tr>
                                <td width="1%">{{ $key + 1 }}</td>
                                <td>
                                    @if ($item->product_thambnail == '' || $item->product_thambnail == null)
                                        <img loading="lazy" src="{{ asset('upload/no_image.jpg') }}" style="height: 50px; width:70px;" alt="No Image">
                                    @else
                                        <img loading="lazy" src="{{ URL::to('storage/products/thambnail', $item->product_thambnail) }}" style="height: 50px; width:70px;">
                                    @endif
                                </td>
                                <td width="25%">{{ $item->product_code}}</td>
                                <td width="25%">{{ Str::limit($item->product_name_en, 100) }}</td>
                                <td class="text-center">{{ $item->selling_price }} Taka</td>

                                {{-- <td class="text-center">{{ $item->product_qty }} Pic</td> --}}
                                @if ($item->product_qty > 0)
                                    <td class="text-center"><p id="product_qty_{{$item->id}}">{{ $item->product_qty }}</p> <p class="badge badge-pill badge-success">Stock-In</p></td>
                                @elseif ($item->product_qty <= 0)
                                    <td class="text-center"><p>{{ $item->product_qty }}</p> <p class="badge badge-pill badge-danger">Stock-Out</p></td>
                                @endif

                                <td class="text-center">
                                    @if ($item->discount_price == NULL)
                                      <span class="badge badge-pill badge-danger">No Discount</span>
                                    @else   
                                      @php
                                        $amount =  $item->selling_price - $item->discount_price;
                                        $discount = ($amount/$item->selling_price) * 100;
                                      @endphp
                                      <span class="badge badge-pill badge-danger">{{round($discount) }} %</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                  @if ($item->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                  @else
                                    <span class="badge badge-pill badge-danger">InActive</span>
                                  @endif
                                </td>

                                @include('backend.product.product_stock_edit_modal')
                                
                                <td>
                                  <a href="#" id="{{$item->id}}" onclick="stock_qty(this.id,{{ $item->product_qty }})" class="btn btn-info btn-sm" data-toggle="modal" data-target="#StockUpdate" title="Stock Edit"><i class="fa fa-pencil"></i></a>
                                </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->         
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </section>
      <!-- /.content -->
    
    </div>

    @endsection
    