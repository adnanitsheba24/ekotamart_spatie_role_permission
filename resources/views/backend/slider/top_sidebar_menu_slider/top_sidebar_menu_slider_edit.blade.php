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
                    <h3 class="box-title">Edit Category Slider</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('top-sidebar-menu-slider.update', $top_sibebar_menu_slider->id) }}" enctype="multipart/form-data">
                            @csrf

                            {{-- <input type="hidden" name="id" value="{{ $sliders->id }}">
                            <input type="hidden" name="old_image" value="{{ $sliders->slider_img }}"> --}}

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Top-Sidebar Slider Title<span class="text-danger"></span></h5>
                                    <input type="text" name="title" value="{{ $top_sibebar_menu_slider->title }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Top-Sidebar Slider Decription<span class="text-danger"></span></h5>
                                    <input type="text" name="description" value="{{ $top_sibebar_menu_slider->description }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Top-Sidebar Slider Image<span class="text-danger"></span></h5>
                                    <input type="file" name="top_sidebar_menu_slider_img" class="form-control" id="upload_file">
                                    <span class="text-danger" id="msg_v"> @error ('top_sidebar_menu_slider_img') {{ $message }} @enderror </span>
                                
                                    <br>
                                    <div class="col-md-6 mt-5">
                                        <img loading="lazy" id="show_image"  src="{{ (!empty($top_sibebar_menu_slider->top_sidebar_menu_slider_img))?
                                        URL::to('storage/top_sidebar_menu_wise_slider', $top_sibebar_menu_slider->top_sidebar_menu_slider_img) : url('upload/no_image.jpg') }}" style="width:auto; height:70px;" alt="Category Slider Image">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Top Sidebar Select <span class="text-danger">*</span></h5>
                                    <select name="top_sidebar_id" class="form-control">
                                        <option value="" selected="">Select Top Sidebar</option>
                                        {{-- <option value="grocery">grocery</option> --}}
                                        @foreach($top_sidebars as $item)
                                            <option value="{{ $item->name_en }}" {{ $item->name_en == $top_sibebar_menu_slider->top_sidebar_id ? 'selected' : "" }}>{{ $item->name_en }}</option>
                                        @endforeach
									</select>
                                    @error ('top_sidebar_id')
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
        {{-- Image validation Js --}}
        <script>
            image_validation("#upload_file", "#show_image", "#msg_v", '1000', "Product size can't larger than 1 MB")
        </script>
    @endpush

@endsection
