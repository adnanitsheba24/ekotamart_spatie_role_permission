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
                    <h3 class="box-title">Edit User</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        {{-- <form method="post" action="{{ route('all-users.update', $users->id) }}"> --}}
                            @csrf

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">User Name<span class="text-danger"></span></h5>
                                    <input type="text" name="name" value="{{ $users->name }}" class="form-control">
                                    @error ('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">User Email<span class="text-danger"></span></h5>
                                    <input type="email" name="email" value="{{ $users->email }}" class="form-control">
                                    @error ('email') 
                                        <span class="text-danger">{{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">User Phone<span class="text-danger"></span></h5>
                                    <input type="number" name="phone" value="{{ $users->phone }}" class="form-control">
                                </div>
                            </div>
                            @error ('phone') 
                                <span class="text-danger">{{ $message }} </span>
                            @enderror

                            <br>
                            <br>
                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <input type="submit" class="btn btn-rounded btn-info float-right mb-5 mt-5" value="Update">
                                </div>
                            </div>

                       {{-- </form> --}}
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

@endsection
