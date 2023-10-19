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
                <h3 class="box-title">Top Sidebar Menu Slider List <span class="badge badge-pill badge-danger">{{ count($top_sibebar_menu_slider) }}</span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="head-text">
                          <tr>
                              <th>SL.</th>
                              <th style="width: 500px;">Top-Sidebar Slider Image</th>
                              <th>Top Sidebar</th>
                              <th>Title</th>
                              <th>Decription</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($top_sibebar_menu_slider as $key => $item)
                          <tr>
                              <td>{{ $key + 1 }}</td>
                              <td style="width: 500px;" class="text-center">
                                  @if ($item->top_sidebar_menu_slider_img == '' || $item->top_sidebar_menu_slider_img == null)
                                      <img loading="lazy" src="{{ asset('upload/no_image.jpg') }}" style="height: 50px; width:500px; max-width: 150px !important;" alt="No Image">
                                  @else
                                      <img loading="lazy" src="{{ URL::to('storage/top_sidebar_menu_wise_slider', $item->top_sidebar_menu_slider_img) }}" style="height: 50px; width:500px; max-width: 150px !important;">
                                  @endif
                              </td>

                              {{-- <td>{{ $item['top_sidebar'] == null ? "" : $item['top_sidebar']['name_en'] }}</td> --}}   {{-- Relation Ship  ----  TopSidebar  to  TopSidebarMenuSlider --}} 
                              <td>{{ $item->top_sidebar_id }}</td>
                              
                              <td>
                                  @if ($item->title == NULL)
                                    <span class="badge badge-pill badge-danger">No Title</span>
                                  @else
                                    {{ $item->title }}
                                  @endif
                              </td>
                              {{-- <td>{{ $item->description }}</td> --}}
                              <td>
                                  @if ($item->description == NULL)
                                    <span class="badge badge-pill badge-danger">No Description</span>
                                  @else
                                    {{ $item->description }}
                                  @endif
                              </td>
                              <td>
                                  @if ($item->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                  @else
                                    <span class="badge badge-pill badge-danger">InActive</span>
                                  @endif
                                </td>
                              <td width="20%">
                                  <a href="{{ route('top-sidebar-menu-slider.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                  <a href="{{ route('top-sidebar-menu-slider.delete',$item->id) }}" class="btn btn-danger btn-sm delete_data" title="Delete Data"><i class="fa fa-trash"></i></a>

                                  {{-- ///////// Status Section Active In-active ///////// --}}
                                  @if ($item->status == 1)
                                    <a href="{{ route('top-sidebar-menu-slider.inactive',$item->id) }}" class="btn btn-danger btn-sm" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                  @else
                                    <a href="{{ route('top-sidebar-menu-slider.active',$item->id) }}" class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                                  @endif
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



          <!---------------- Add Slider Page Start -------------->

            <div class="col-4">
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Top Sidebar Menu Slider Add</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('top-sidebar-menu-slider.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5 class="head-text">Top-Sidebar Slider Title<span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="text" name="title" class="form-control" placeholder="Category Slider title">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="head-text">Top-Sidebar Slider Decription<span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="text" name="description" class="form-control" placeholder="Category Slider decription">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="head-text">Top-Sidebar Slider Image<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="top_sidebar_menu_slider_img" class="form-control" id="upload_file">
                                    <span class="text-danger" id="msg_v"> @error ('top_sidebar_menu_slider_img') {{ $message }} @enderror </span>
                                </div>

                                <div class="col-md-6 mt-5">
                                    <img loading="lazy" id="show_image"  src="{{ (!empty($top_sibebar_menu_slider->top_sidebar_menu_slider_img))?
                                    URL::to('storage/top_sidebar_menu_wise_slider', $top_sibebar_menu_slider->top_sidebar_menu_slider_img) : url('upload/no_image.jpg') }}" style="width:250px; height:70px;" alt="Category Slider Image">
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="head-text">Top-Sidebar Select <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="top_sidebar_id" class="form-control">
                                        <option value="" selected ="">Select Top-Sidebar</option>
                                        {{-- <option value="grocery">grocery</option> --}}
                                        @foreach($top_sidebars as $item)
                                            <option value="{{ $item->name_en }}">{{ $item->name_en }}</option>
                                        @endforeach
									                  </select>
                                    @error ('top_sidebar_id')
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

            <!---------------- Add Slider Page End -------------->

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>



    @push('js')

        {{-- Image validation Js --}}
        <script>
            image_validation("#upload_file", "#show_image", "#msg_v", '1000', "Category slider size can't larger than 1 MB")
        </script>

    @endpush


@endsection
