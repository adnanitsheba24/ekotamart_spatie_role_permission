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
                <h3 class="box-title">Author List <span class="badge badge-pill badge-danger">{{ count($authors) }}</span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped" class="head-text">
                      <thead class="head-text">
                          <tr>
                              <th width="2%">SL.NO</th>
                              <th>Category Name</th>
                              <th>Book-Type Name</th>
                              <th>Publication Name</th>
                              <th>Author English</th>
                              <th>Author Bangla</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($authors as $key => $item)
                          <tr>
                                <td width="2%">{{ $key + 1 }}</td>
                                {{-- <td>{{ $item->category_id  }}</td> --}}
                                <td>{{ $item['category'] == null ? "" : $item['category']['category_name_en'] }}</td>
                                <td>{{ $item['book_type'] == null ? "" : $item['book_type']['book_type_name_en'] }}</td>
                                <td>{{ $item['publication'] == null ? "" : $item['publication']['publication_name_en'] }}</td>
                                <td>{{ $item->author_name_en }}</td>
                                <td>{{ $item->author_name_bn }}</td>
                                <td class="text-center">
                                    @if ($item->status == 1)
                                      <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                      <span class="badge badge-pill badge-danger">InActive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('author.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('author.delete',$item->id) }}" class="btn btn-danger btn-sm delete_data" title="Delete Data"><i class="fa fa-trash"></i></a>
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
