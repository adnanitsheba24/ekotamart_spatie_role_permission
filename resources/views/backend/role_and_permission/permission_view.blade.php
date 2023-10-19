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
                <h3 class="box-title">Permission View Page <span class="badge badge-pill badge-danger">{{ count($permissions) }}</span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="head-text">
                          <tr>
                              <th>SL.NO</th>
                              <th>Permission Name</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($permissions as $key => $item)
                          <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                
                                <td width="30%">
                                    <a href="{{ route('permissions.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('permissions.delete',$item->id) }}" class="btn btn-danger delete_data btn-sm" title="Delete Data"><i class="fa fa-trash"></i></a>
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
                    <h3 class="box-title">Permission Add Page</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('permissions.store') }}">
                            @csrf
                            <div class="form-group">
                                <h5 class="head-text">Permission Name<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control" placeholder="permission name">
                                    @error ('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

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

