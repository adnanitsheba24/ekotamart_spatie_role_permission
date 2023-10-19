@extends('admin.admin_master')
@section('admin')


      <style>
        .table > tbody > tr > td, .table > tbody > tr > th {
            border-top: 1px solid #d5dfea;
            padding: 0px !important;
            vertical-align: middle;
        }
      </style>

      <!-- Content Wrapper. Contains page content -->
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <div class="row">

        <div class="col-12">
           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Product List <span class="badge badge-pill badge-danger">{{ count($products) }}</span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="head-text">
                          <tr>
                              <th>Sl.</th>
                              <th style="height: 50px; width:70px !important;">Image</th>
                              <th>Product Name</th>
                              <th>Category</th>
                              <th>Author</th>
                              {{-- <th>Book-Type</th> --}}
                              {{-- <th class="text-center">Publi<br>cation</th> --}}
                              <th class="text-center">Product Price</th>
                              <th class="text-center">Units</th>
                              <th class="text-center">Quantity</th>
                              <th class="text-center">Discount</th>
                              <th class="text-center">Top-Sidebar Category</th>
                              <th class="text-center">Expired Date</th>
                              <th class="text-center">Status</th>
                              <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($products as $key => $item)
                          <tr>
                              <td class="text-center">{{ $key + 1 }}</td>
                              <td>
                                  @if ($item->product_thambnail == '' || $item->product_thambnail == null)
                                      <img loading="lazy" src="{{ asset('upload/no_image.jpg') }}" style=" width:90px !important;" alt="No Image">
                                  @else
                                      <img loading="lazy" src="{{ URL::to('storage/products/thambnail', $item->product_thambnail) }}" style="width: 90px; height: 90px; !important;">
                                  @endif
                              </td>
                              <td>{{ Str::limit($item->product_name_en, 35) }}</td>
                              <td>{{ $item['category']  == null ? "" : $item['category']['category_name_en'] }}</td>
                              <td>{{ $item['author'] == null ? "" : $item['author']['author_name_en'] }}</td>
                              {{-- <td>{{ $item['book_type'] == null ? "" : $item['book_type']['book_type_name_en'] }}</td> --}}
                              {{-- <td>{{ $item['publication'] == null ? "" : $item['publication']['publication_name_en'] }}</td> --}}
                              <td class="text-center">{{ $item->selling_price }} Taka</td>
                              <td class="text-center">{{ $item->product_units_id ? $item->product_units->product_units_name_en : " " }}</td>

                              @if ($item->product_qty > 0)
                                  <td class="text-center">{{ $item->product_qty }} <br><p class="badge badge-pill badge-success">Stock-In</p></td>
                              @elseif ($item->product_qty <= 0)
                                  <td class="text-center">{{ $item->product_qty }} <br><p class="badge badge-pill badge-danger">Stock-Out</p></td>
                              @endif
                              
                              
                              <td class="text-center">
                                  @if ($item->discount_price == NULL)
                                    <span class="badge badge-pill badge-danger">No <br> Discount</span>
                                  @else   
                                    @php
                                      $amount =  $item->selling_price - $item->discount_price;
                                      $discount = ($amount/$item->selling_price) * 100;
                                    @endphp
                                    <span class="badge badge-pill badge-danger">{{round($discount) }} %</span>
                                  @endif
                              </td>

                              <td class="text-center">{{ $item->sid_sps_section }}</td>

                              <td width="3%">
                                @if ($item->sid_sps_section == "medicin" || $item->sid_sps_section == "Medicin" || $item->sid_sps_section == "medicine" || $item->sid_sps_section == "Medicine" || $item->sid_sps_section == "medicines" || $item->sid_sps_section == "Medicines" || $item->sid_sps_section == "pharmacy" || $item->sid_sps_section == "pharmecy" || $item->sid_sps_section == "Pharmecy" || $item->sid_sps_section == "Pharmacy" || $item->sid_sps_section == "pharmacys" || $item->sid_sps_section == "Pharmacys")
                                  @if ($item->expired_date >= Carbon\Carbon::now()->format('Y-m-d'))
                                  <span class="badge badge-pill badge-warning">{{$item->expired_date}}</span>
                                  @else
                                      <span class="badge badge-pill badge-danger">Date Expired</span>
                                  @endif
                                @endif
                              </td>

                              <td class="text-center">
                                @if ($item->status == 1)
                                  <span class="badge badge-pill badge-success">Active</span>
                                @else
                                  <span class="badge badge-pill badge-danger">InActive</span>
                                @endif
                              </td>

                              <td width="30%" class="text-center">

                                  {{-- ///////// Status Section Active In-active ///////// --}}
                                  @if ($item->status == 1)
                                    <a href="{{ route('product.inactive',$item->id) }}" class="btn btn-danger btn-sm" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                  @else
                                    <a href="{{ route('product.active',$item->id) }}" class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                                  @endif

                                  <a href="{{ route('details-view-product',$item->id) }}" class="btn btn-primary btn-sm" title="Product Details Data"><i class="fa fa-eye"></i></a>
                                  <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                  <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger btn-sm delete_data" title="Delete Data"><i class="fa fa-trash"></i></a>

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
