@extends('admin.admin_master')
@section('admin')


      <!-- Content Wrapper. Contains page content -->
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <div class="row">

        <div class="col-8">
           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Brand List <span class="badge badge-pill badge-danger">{{ count($brands) }}</span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="head-text">
                          <tr>
                              <th>SL.NO</th>
                              <th>Image</th>
                              <th>Brand En</th>
                              <th>Brand Bn</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($brands as $key => $item)
                          <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    {{-- <img src="{{ asset($item->brand_image) }}" style="width: 70px; height:40px;"> --}}
                                    @if ($item->brand_image == '' || $item->brand_image == null)
                                        <img loading="lazy" src="{{ asset('upload/no_image.jpg') }}" style="height: 50px; width:70px;" alt="No Image">
                                    @else
                                        <img loading="lazy" src="{{ URL::to('storage/brand', $item->brand_image) }}" style="height: 50px; width:70px;">
                                    @endif
                                </td>
                                <td>{{ $item->brand_name_en }}</td>
                                <td>{{ $item->brand_name_bn }}</td>
                                
                                <td>
                                    @if ($item->status == 1)
                                      <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                      <span class="badge badge-pill badge-danger">InActive</span>
                                    @endif
                                </td>
                                
                                <td width="30%">
                                    {{-- ///////// Status Section Active In-active ///////// --}}
                                    @if ($item->status == 1)
                                      <a href="{{ route('brand.inactive',$item->id) }}" class="btn btn-danger btn-sm" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                    @else
                                      <a href="{{ route('brand.active',$item->id) }}" class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                                    @endif

                                    <a href="{{ route('brand.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('brand.delete',$item->id) }}" class="btn btn-danger delete_data btn-sm" title="Delete Data"><i class="fa fa-trash"></i></a>
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



          <!---------------- Add Brand Page -------------->



            <div class="col-4">
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Brand</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5 class="head-text">Brand Name English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="brand_name_en" class="form-control" placeholder="Brand name english">
                                    @error ('brand_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="head-text">Brand Name Bangla<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="brand_name_bn" class="form-control" placeholder="Brand name bangla">
                                    @error ('brand_name_bn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="head-text">Brand Image<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="brand_image" class="form-control" id="upload_file">
                                    <span class="text-danger" id="msg_v">@error ('brand_image') {{ $message }} @enderror</span>
                                </div>

                                <div class="col-md-6 mt-5">
                                    <img loading="lazy" id="show_image" style="width:100px; height:100px;" src="{{ (!empty($brands->brand_image))?
                                    URL::to('storage/brand', $brands->brand_image) : url('upload/no_image.jpg') }}" alt="Brand Image">
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info float-right mb-5" value="Add New">
                            </div>
                       </form>
                    </div>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->         
            </div>

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>


    @push('js')

        <script>
            image_validation("#upload_file", "#show_image", "#msg_v", '500', "Photo brand size can't larger than 500 kb")
        </script>

    @endpush


@endsection
