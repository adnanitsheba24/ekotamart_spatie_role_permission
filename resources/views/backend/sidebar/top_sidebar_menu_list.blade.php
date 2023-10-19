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
                <h3 class="box-title">Top Sidebar Menu List <span class="badge badge-pill badge-danger">{{ count($top_sidebar) }}</span></h3>
                {{-- <a href="{{ route('add.post') }}" class="btn btn-info" style="float: right;">Add Post</a> --}}
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="head-text">
                          <tr>
                              <th width="2%">SL.NO</th>
                              <th width="8%">Top Sidebar Icon</th>
                              <th>Name English</th>
                              <th>Name Bangla</th>
                              <th>priority</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($top_sidebar as $key => $item)
                          <tr>
                              <td width="2%">{{ $key + 1 }}</td>
                              <td class="text-center">
                                  @if ($item->icon == '' || $item->icon == null)
                                      <img loading="lazy" src="{{ asset('upload/no_image.jpg') }}" style="height: 50px; width:70px;" alt="No Image">
                                  @else
                                      <img loading="lazy" src="{{ URL::to('storage/top_sidebar_icon', $item->icon) }}" style="height: 50px; width:70px;">
                                  @endif
                              </td>
                              <td>{{ $item->name_en }}</td>
                              <td>{{ $item->name_bn }}</td>
                              <td>{{ $item->priority }}</td>
                              <td class="text-center">
                                @if ($item->status == 1)
                                  <span class="badge badge-pill badge-success">Active</span>
                                @else
                                  <span class="badge badge-pill badge-danger">InActive</span>
                                @endif
                              </td>
                              <td width="20%">
                                  <a href="{{ route('top_sidebar.edit', $item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                  {{-- <a href="" class="btn btn-danger btn-sm delete_data" title="Delete Data"><i class="fa fa-trash"></i></a> --}}
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
