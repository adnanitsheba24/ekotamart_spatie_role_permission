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
                            <h3 class="box-title">Total User <span class="badge badge-pill badge-danger">{{ count($users) }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body head-text">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead class="head-text">
                                    <tr>
                                        {{-- <th>Image</th> --}}
                                        <th>SL.No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="head-text">
                                    @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if ($user->profile_photo_path == '' || $user->profile_photo_path == null)
                                                <img src="{{ asset('upload/no_image.jpg') }}" style="height: 50px; width:50px;" alt="No Image">
                                            @else
                                                <img src="{{ URL::to('storage/face_photo', $user->profile_photo_path) }}" style="height: 50px; width:50px;">
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td> 
                                            @if($user->isOnline())
                                                <span class="badge badge-pill badge-success">Active Now</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">{{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
                                            @endif 
                                        </td>
                                        <td width="30%">
                                            <a href="{{ route('all-users.show', $user->id) }}" class="btn btn-info btn-sm" title="Show Data"><i class="fa fa-eye"></i></a>
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
                </div><!-- end col 12 -->

            </div><!-- /.row -->
        </section>
      <!-- /.content -->
    
    </div>

@endsection




