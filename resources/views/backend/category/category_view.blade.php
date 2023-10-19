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
                <h3 class="box-title">Category List <span class="badge badge-pill badge-danger">{{ count($category) }}</span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped" class="head-text">
                      <thead class="head-text">
                          <tr>
                              <th width="2%">SL.NO</th>
                              <th>Category Icon</th>
                              <th>Category En</th>
                              <th>Category Bn</th>
                              <th>Serial</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($category as $key => $item)
                          <tr>
                                <td width="2%">{{ $key + 1 }}</td>
                                <td class="text-center">
                                    @if ($item->category_icon == '' || $item->category_icon == null)
                                        <img loading="lazy" src="{{ asset('upload/no_image.jpg') }}" style="height: 50px; width:50px;" alt="No Image">
                                    @else
                                        <img loading="lazy" src="{{ URL::to('storage/category_icon', $item->category_icon)}}" style="height: 30px; width:30px;">
                                    @endif
                                </td>
                                <td>{{ $item->category_name_en }}</td>
                                <td>{{ $item->category_name_bn }}</td>
                                <td>{{ $item->serial }}</td>
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
                                      <a href="{{ route('category.inactive',$item->id) }}" class="btn btn-danger btn-sm" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                    @else
                                      <a href="{{ route('category.active',$item->id) }}" class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                                    @endif

                                    <a href="{{ route('category.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('category.delete',$item->id) }}" class="btn btn-danger btn-sm delete_data" title="Delete Data"><i class="fa fa-trash"></i></a>
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



          <!---------------- Add Category Page -------------->



            <div class="col-4">
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Category</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5 class="head-text">Category English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_en" class="form-control" placeholder="Category english">
                                    @error ('category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="head-text">Category Bangla<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_bn" class="form-control" placeholder="Category bangla">
                                    @error ('category_name_bn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="head-text">Category Icon<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="category_icon" class="form-control" placeholder="Category icon" id="upload_file">
                                    <span class="text-danger" id="msg_v">@error ('category_icon') {{ $message }} @enderror</span>
                                </div>

                                <div class="col-md-6 mt-5">
                                    <img loading="lazy" id="show_image" style="width:50px; height:50px;" src="{{ (!empty($category->category_icon))?
                                    URL::to('storage/category_icon', $category->category_icon) : url('upload/no_image.jpg') }}" alt="Category Image">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="head-text">Priority<span class="text-danger">*</span></h5>
                                <div class="controls">
                                  <input type="number" name="serial" class="form-control" placeholder="Priority Number" min="1" oninput="validity.valid||(value='')">
                                    @error ('serial')
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
            image_validation("#upload_file", "#show_image", "#msg_v", '500', "Category icon size can't larger than 500 kb")
        </script>

    @endpush


@endsection
