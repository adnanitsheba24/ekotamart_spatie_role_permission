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
                        <h3 class="box-title">Edit Home Slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">

                            <form method="post" action="{{ route('slider.update', $sliders->id) }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $sliders->id }}">
                                <input type="hidden" name="old_image" value="{{ $sliders->slider_img }}">

                                <div class="form-group d-flex justify-content-center">
                                    <div class="controls col-md-6">
                                        <h5 class="head-text">Slider Title<span class="text-danger">*</span></h5>
                                        <input type="text" name="title" value="{{ $sliders->title }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-center">
                                    <div class="controls col-md-6">
                                        <h5 class="head-text">Slider Decription<span class="text-danger">*</span></h5>
                                        <input type="text" name="description" value="{{ $sliders->description }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-center">
                                    <div class="controls col-md-6">
                                        <h5 class="head-text">Slider Image<span class="text-danger">*</span></h5>
                                        <input type="file" name="slider_img" class="form-control" id="upload_file">
                                        <span class="text-danger" id="msg_v"> @error ('slider_img') {{ $message }} @enderror </span>

                                        <br>
                                        <div class="col-md-6 mt-5">
                                            <img loading="lazy" id="show_image" src="{{ (!empty($sliders->slider_img))?
                                        URL::to('storage/slider', $sliders->slider_img) : url('upload/no_image.jpg') }}" style="width:auto; height:70px;" alt="Brand Image">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-center">
                                    <div class="controls col-md-6">
                                        <h5 class="head-text">For Home Page Category Select:<span class="text-danger"></span></h5>
                                        <select name="category" class="form-control">
                                            <option value="" selected="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $sliders->category==$category->id ? 'selected' : "" }}>{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('category')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group d-flex justify-content-center">
                                    <div class="controls col-md-6">
                                        <h5 class="head-text">For Category Page, Category Select:<span class="text-danger"></span></h5>
                                        <select name="category_id" class="form-control">
                                            <option value="" selected="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $sliders->category_id==$category->id ? 'selected' : "" }}>{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-center">
                                    <div class="controls col-md-6">
                                        <h5 class="head-text">For Sub-Category Page, Sub-Category Select:<span class="text-danger"></span></h5>
                                        <select name="subcategory_id" class="form-control">
                                            @if ($subcategory==null)
                                            <option value="" selected="">Select Sub Category</option>
                                            @else
                                            <option value="{{ $subcategory->id }}" selected>{{ $subcategory->subcategory_name_en }}</option>
                                            @endif
                                        </select>
                                        @error ('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-center">
                                    <div class="controls col-md-6">
                                        <h5 class="head-text">For Sub-Sub-Category Page, Sub-Sub-Category Select:<span class="text-danger"></span></h5>
                                        <select name="subsubcategory_id" class="form-control">
                                            @if ($subsubcategory==null)
                                            <option value="" selected="">Select Sub-Sub-Category</option>
                                            @else
                                            <option value="{{ $subsubcategory->id }}" selected>{{ $subsubcategory->subsubcategory_name_en }}</option>
                                            @endif
                                        </select>
                                        @error ('subsubcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <div class="controls col-md-6">
                                        <h5 class="head-text">For Top-Sidebar Page:<span class="text-danger"></span></h5>
                                        <select name="top_sidebar_id" class="form-control">
                                            <option value="" selected="">Select Top-Sidebar</option>
                                            @foreach($top_sidebars as $item)
                                            <option value="{{ $item->name_en }}" {{ $sliders->top_sidebar_id == $item->name_en ? 'selected' : "" }}>{{ $item->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('top_sidebar_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <input type="checkbox" id="status" name="status" value="1">
                                    <label for="status" class="controls col-md-5"> Status </label><br>
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
<script>
    $(document).ready(function() {
        $('select[name=category_id]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
        $('select[name=subcategory_id]').on('change', function() {
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $('select[name="subsubcategory_id"]').append('<option selected value=""  >Select None</option>');
                        $.each(data, function(key, value) {
                            $('select[name="subsubcategory_id"]').append('<option  value="' + value.id + '">' + value.subsubcategory_name_en + '</option>');
                        });
                    },
                });
            }
            // else {
            //     alert('danger');
            // }
        });
    });
</script>
@endpush

@endsection