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
                <h3 class="box-title">Product Stock Request List <span class="badge badge-pill badge-danger">{{ count($products) }}</span></h3>
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
                              <th class="text-center">Requested Date</th>
                              <th class="text-center">User IP</th>
                              <th class="text-center">User</th>
                              <th class="text-center">Status</th>
                              <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($products as $key => $item)
                          <tr>
                                <td width="1%">{{ $key + 1 }}</td>
                                <td>
                                    @if ($item->Product->product_thambnail == '' || $item->Product->product_thambnail == null)
                                        <img loading="lazy" src="{{ asset('upload/no_image.jpg') }}" style="height: 50px; width:70px;" alt="No Image">
                                    @else
                                        <img loading="lazy" src="{{ URL::to('storage/products/thambnail', $item->Product->product_thambnail) }}" style="height: 50px; width:70px;">
                                    @endif
                                </td>
                                <td width="25%">{{ $item->Product->product_code}}</td>
                                <td width="25%">{{ Str::limit($item->Product->product_name_en, 100) }}</td>
                                <td class="text-center">{{ $item->date }}</td>
                                <td class="text-center">{{ $item->user_ip }}</td>
                                
                                <td class="text-center">{{ $item->user==null ? "" : $item->user->name }} <br> {{ $item->user==null ? "" : $item->user->email }} <br> {{ $item->user==null ? "" :  $item->user->phone }}</td>
                                <td class="text-center">
                                  @if ($item->Product->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                  @else
                                    <span class="badge badge-pill badge-danger">InActive</span>
                                  @endif
                                </td>

                                @include('backend.product.product_stock_edit_modal')
                                
                                <td>
                                <a href="{{ route('stock.request.delete',$item->id) }}" class="btn btn-danger btn-sm delete_data" title="Delete Data"><i class="fa fa-trash"></i></a>
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
    