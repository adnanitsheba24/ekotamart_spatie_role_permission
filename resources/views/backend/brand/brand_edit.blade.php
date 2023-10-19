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
                    <h3 class="box-title">Edit Brand</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('brand.update', $brand->id) }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $brand->id }}">
                            <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Brand Name English<span class="text-danger">*</span></h5>
                                    <input type="text" name="brand_name_en" value="{{ $brand->brand_name_en }}" class="form-control">
                                    @error ('brand_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Brand Name Bangla<span class="text-danger">*</span></h5>
                                    <input type="text" name="brand_name_bn" value="{{ $brand->brand_name_bn }}" class="form-control">
                                    @error ('brand_name_bn') 
                                        <span class="text-danger">{{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Brand Image<span class="text-danger"></span></h5>
                                    <input type="file" name="brand_image" class="form-control"  id="upload_file">
                                    <span class="text-danger" id="msg_v">@error ('brand_image') {{ $message }} @enderror </span>
                                    
                                    <br>
                                    <div class="col-md-6 mt-5">
                                        <img loading="lazy" id="show_image" style="width:100px; height:100px;" src="{{ (!empty($brand->brand_image))?
                                        URL::to('storage/brand', $brand->brand_image) : url('upload/no_image.jpg') }}" alt="Brand Image">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            
                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <input type="submit" class="btn btn-rounded btn-info float-right mb-5 mt-5" value="Update">
                                </div>
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
