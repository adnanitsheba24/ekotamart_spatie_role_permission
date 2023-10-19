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
                    <h3 class="box-title">Edit Permissions</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('permissions.update', $permission) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Permissions Name<span class="text-danger">*</span></h5>
                                    <input id="name" type="text" name="name" value="{{ $permission->name }}" class="form-control">
                                    @error ('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
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
