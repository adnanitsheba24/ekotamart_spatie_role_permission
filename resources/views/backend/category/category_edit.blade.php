@extends('admin.admin_master')
@section('admin')

    <div class="container-full">
      <section class="content">
        <div class="row">

            <div class="col-12">
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Category</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <input type="hidden" name="old_image" value="{{ $category->category_icon }}">

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Category English<span class="text-danger">*</span></h5>
                                    <input type="text" name="category_name_en" value="{{ $category->category_name_en }}" class="form-control">
                                    @error ('category_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Category Bangla<span class="text-danger">*</span></h5>
                                    <input type="text" name="category_name_bn" value="{{ $category->category_name_bn }}" class="form-control">
                                    @error ('category_name_bn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Category Icon<span class="text-danger"></span></h5>
                                    <input type="file" name="category_icon" value="{{ $category->category_icon }}" class="form-control" id="upload_file">
                                    <span class="text-danger" id="msg_v">@error ('category_icon') {{ $message }} @enderror</span>

                                    <br>
                                    <div class="col-md-6 mt-5">
                                        <img loading="lazy" id="show_image" style="width:30px; height:30px;" src="{{ (!empty($category->category_icon))?
                                        URL::to('storage/category_icon', $category->category_icon) : url('upload/no_image.jpg') }}" alt="Category Icon">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Priority<span class="text-danger">*</span></h5>
                                    <input type="number" name="serial" value="{{ $category->serial }}" class="form-control" min="1" oninput="validity.valid||(value='')">
                                    @error ('serial')
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
                </div>
            </div>

        </div>
      </section>
    </div>


    @push('js')

        <script>
            image_validation("#upload_file", "#show_image", "#msg_v", '500', "Category icon size can't larger than 500 kb")
        </script>

    @endpush

@endsection
