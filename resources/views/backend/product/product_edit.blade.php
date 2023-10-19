@extends('admin.admin_master')
@section('admin')


    <div class="container-full">
      <!-- Content Header (Page header) -->	  

      <!-- Main content -->
      <section class="content">
        <a class="btn btn-warning mb-5" href="{{ route('manage-product') }}" style="margin-top: -25px;">Back</a>
       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Edit Product</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="post" action="{{ route('product-update', $products->id) }}">
                    @csrf
                    
                    <div class="row">
                      <div class="col-12">

                        <div class="row"> <!-- start 1st row -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">Brand<span class="text-danger">*</span></h5>
                                        <select name="brand_id" class="input-box-color form-control select-field" required="">
                                            <option value="" selected disabled="">Select Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected' : '' }}>{{ $brand->brand_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('brand_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">Category<span class="text-danger">*</span></h5>
                                        <select name="category_id" class="input-box-color form-control select-field" required="">
                                            <option value="" selected disabled="">Select</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $products->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('category_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">SubCategory<span class="text-danger"></span></h5>
                                        <select name="subcategory_id" class="input-box-color form-control select-field">
                                            <option value="" selected="">Select-None</option>
                                            @foreach($subcategory as $sub)
                                                <option value="{{ $sub->id }}" {{ $sub->id == $products->subcategory_id ? 'selected' : '' }}>{{ $sub->subcategory_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('subcategory_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">SubSubCategory<span class="text-danger"></span></h5>
                                        <select name="subsubcategory_id" class="input-box-color form-control select-field">
                                            <option value="" selected="">Select-None</option>
                                            @foreach($subsubcategory as $subsub)
                                                <option value="{{ $subsub->id }}" {{ $subsub->id == $products->subsubcategory_id ? 'selected' : '' }}>{{ $subsub->subsubcategory_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('subsubcategory_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">Author<span class="text-danger"></span></h5>
                                        <select name="author_id" class="input-box-color form-control select-field">
                                            <option value="" selected>Select</option>
                                            @foreach($authors as $author)
                                                <option value="{{ $author->id }}" {{ $author->id == $products->author_id ? 'selected' : '' }}>{{ $author->author_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('author_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">Book-Type<span class="text-danger"></span></h5>
                                        <select name="book_type_id" class="input-box-color form-control select-field">
                                            <option value="" selected>Select</option>
                                            @foreach($book_types as $book_type)
                                                <option value="{{ $book_type->id }}" {{ $book_type->id == $products->book_type_id ? 'selected' : '' }}>{{ $book_type->book_type_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('book_type_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">Publication<span class="text-danger"></span></h5>
                                        <select name="publication_id" class="input-box-color form-control select-field">
                                            <option value="" selected>Select</option>
                                            @foreach($publications as $publication)
                                                <option value="{{ $publication->id }}" {{ $publication->id == $products->publication_id ? 'selected' : '' }}>{{ $publication->publication_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('publication_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                        </div> <!-- end 1st row -->


                        <div class="row"> <!-- start 2nd row -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 class="head-text">Product Name En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_en" value="{{ $products->product_name_en }}" class="form-control" required=""> 
                                        @error ('product_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 class="head-text">Product Name Bn <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_bn" value="{{ $products->product_name_bn }}" class="form-control" required=""> 
                                        @error ('product_name_bn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5 class="head-text">Quantity <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_qty" value="{{ $products->product_qty }}" class="form-control" required=""> 
                                        @error ('product_qty')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">Product Units<span class="text-danger"></span></h5>
                                        <select name="product_units_id" class="input-box-color form-control select-field">
                                            <option value="" selected>Select</option>
                                            @foreach($product_units as $product_unit)
                                                <option value="{{ $product_unit->id }}" {{ $product_unit->id == $products->product_units_id ? 'selected' : '' }}>{{ $product_unit->product_units_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('product_units_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5 class="head-text">Product Code <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_code" value="{{ $products->product_code }}" class="form-control"> 
                                        @error ('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                        </div> <!-- end 2nd row -->


                        <div class="row"> <!-- start 6th row -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="head-text text-danger"><del>Selling Price</del> <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="selling_price" value="{{ $products->selling_price }}" class="form-control" required="" min="1" oninput="validity.valid||(value='');"> 
                                        @error ('selling_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="head-text text-success">Discount Price <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount_price" value="{{ $products->discount_price }}" class="form-control" > 
                                        @error ('discount_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->
                        </div> <!-- end 6th row -->


                        <div class="row"> <!-- start 7th row -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="head-text">Short Description English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_descp_en" id="textarea" class="form-control" required placeholder="Textarea text">{!! $products->short_descp_en !!}</textarea> 
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="head-text">Short Description Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_descp_bn" id="textarea" class="form-control" required placeholder="Textarea text">{!! $products->short_descp_bn !!}</textarea>
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->
                        </div> <!-- end 7th row -->
                        

                        <div class="row"> <!-- start 8th row -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="head-text">Long Description English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor1" name="long_descp_en" rows="5" cols="50" required="">{{ strip_tags($products->long_descp_en) }}</textarea> 
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="head-text">Long Description Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor2" name="long_descp_bn" rows="5" cols="50" required="">{{ strip_tags($products->long_descp_bn) }}</textarea>
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->
                        </div> <!-- end 8th row -->


                        <hr>
                          
                        <span class="text-danger"><p><strong>Special Section Select</strong></p></span>

                        <div class="row head-text mt-3">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <div class="controls">
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $products->hot_deals == 1 ? 'checked' : '' }}>
                                            <label for="checkbox_2">Hot Deals</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $products->featured == 1 ? 'checked' : '' }}>
                                            <label for="checkbox_3">Featured</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                <div class="controls">
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $products->special_offer == 1 ? 'checked' : '' }}>
                                            <label for="checkbox_4">Special Offer</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $products->special_deals == 1 ? 'checked' : '' }}>
                                            <label for="checkbox_5">Special Deals</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <span class="text-danger"><p><strong>Sidebar Top Section Select</strong></p></span>
                      
                        <div class="row head-text mt-3">
                            @foreach($top_sidebar as $key => $item)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="radio" name="sid_sps_section" id="{{ $key + 1 }}" value="{{ $item->name_en }}" {{ strtolower($item->name_en) == $products->sid_sps_section ? 'checked' : '' }}  onchange="dateShow('{{ $item->name_en }}', 'show_date{{ $key + 1 }}')">
                                                <label for="{{ $key + 1 }}">{{ $item->name_en }}</label>
                                            </fieldset>

                                            @if ($item->name_en == "medicin" || $item->name_en == "Medicin" || $item->name_en == "medicine" || $item->name_en == "Medicine" || $item->name_en == "medicined" || $item->name_en == "Medicined" || $item->name_en == "pharmacy" || $item->name_en == "Pharmacy" || $item->name_en == "pharmacys" || $item->name_en == "Pharmacys" || $item->name_en == "Pharmecy" || $item->name_en == "pharmecy")
                                                <div id="show_date{{ $key + 1 }}" id="div_input" class="controls div_hide col-md-5" >
                                                    <label for="date">Expired Date<span class="text-danger"></span></label>
                                                    <input type="date" class="form-control" name="expired_date" value="{{ $products->expired_date }}">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-6">
                                <div class="form-group">
                                <div class="controls">
                                        <fieldset>
                                            <input type="radio" name="sid_sps_section" id="sid_sps_sec_1" value="none">
                                            <label for="sid_sps_sec_1">Select None</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>

                      
                      <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info float-right mb-5 mt-5" value="Update Product">
                      </div>
                  </form>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->



    {{-- //////////////// Thambnail Image Update Section Start //////////////////// --}}
    <section class="content ">
        <div class="row text-center">
            <div class="col-md-12 container">
                <div class="box bt-3 border-info">
                  <div class="box-header">
                    <h4 class="box-title">Product Thambnail Image </h4><h3><strong>Update</strong></h3>
                  </div>
                  <form method="post" action="{{ route('update-product-thambnail', $products->id) }}" enctype="multipart/form-data">
                    @csrf

                        <input type="hidden" name="id" value="{{ $products->id }}">
                        <input type="hidden" name="old_img" value="{{ $products->product_thambnail }}">

                        <div class="row row-sm">
                            <div class="col-md-3">
                                <div class="card container" style="width: 22rem;">
                                    <img loading="lazy" src="{{ URL::to('storage/products/thambnail', $products->product_thambnail) }}" class="card-img-top" style="height: 250px; width:400px;">
                                    <div class="card-body">
                                        <p class="card-text">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Change Image <span class="text-danger">*</span></label>
                                                <input type="file" name="product_thambnail" class="form-control" id="upload_file">
                                                <span class="text-danger" id="msg_v">@error ('product_thambnail') {{ $message }} @enderror </span>
                                                
                                                <br>
                                                <div class="col-md-6 mt-5">
                                                    <img loading="lazy" id="show_image" style="width:50px; height:50px;" src="{{ (!empty($products->product_thambnail))?
                                                    URL::to('storage/products/thambnail', $products->product_thambnail) : url('upload/no_image.jpg') }}" alt="Thambnail Image">
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info float-left mb-5 mt-5" value="Update Image">
                        </div>
                        <br>
                        <br>
                  </form>
                </div>
              </div>
        </div>
    </section>
    {{-- //////////////// Thambnail Image Update Section End //////////////////// --}}




    {{-- //////////////// Multiple Image Update Section Start //////////////////// --}}
    <section class="content">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-4 ">
                                <h4 class="box-title float-left">Product Multiple Image </h4><br>
                                <h3 class="text-left" style="padding-left: 4.4rem;"><strong>Update</strong></h3>
                            </div>
                            <div class="col-md-8">
                                <div class="col-md-4  show_image_pojition">
                                    <img loading="lazy" id="show_multi_img_add" style="width:100px; height:100px;" src="{{ (!empty($product_multi_img->photo_name))?
                                    URL::to('storage/products/multi-image', $product_multi_img->photo_name) : url('upload/no_image.jpg') }}" alt="Brand Image">
                                </div>

                                <div class="col-md-4 add_image_pojition">
                                    <div class="float-right">
                                        <form method="post" action="{{ route('add-product-image') }}" enctype="multipart/form-data" id="form-submit">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                                <label for="multi_img_add" class="form-control-label text-white">Multi-Img Add</label>
                                                <input type="file" name="multi_img_add" id="multi_img_add" class="form-control form-control-sm" placeholder="MultiImgAdd" style="width: 110px;">
                                                <span style="background-color: aliceblue; color:#08c708;" class="text-danger" id="msg_v_add">@error ('multi_img_add') {{ $message }} @enderror</span><br>
                                                
                                                <input id="one_add_multi_img" type="submit" class="btn btn-rounded btn-info btn-sm float-left" onclick="disableInput()" value="Add">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <form method="post" action="{{ route('update-product-image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">
                            @foreach ($multiImgs as $key => $img)   
                                <div class="col-md-3">
                                    <div class="card" style="width: 14rem;">
                                        <img loading="lazy" src="{{ URL::to('storage/products/multi-image', $img->photo_name) }}" class="card-img-top" style="height: 130px; width:280px;">
                                        <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('product.multiimg.delete', $img->id) }}" class="btn btn-sm btn-danger delete_data" title="Delete Data"><i class="fa fa-trash"></i></a>
                                        </h5>
                                            <p class="card-text">
                                                <div class="form-group">
                                                    <label for="" class="form-control-label">Change Image <span class="text-danger">*</span></label>
                                                    <input type="file" class="form-control" name="multi_img[ {{ $img->id }} ]" id="upload_file_multiImg_{{$key}}">
                                                </div>
                                                <span class="text-danger" id="msg_v_multiImg_{{$key}}"> @error ('multi_img') {{ $message }} @enderror </span>
                                                <div class="col-md-12 mt-5">
                                                    <div id="show_image_multiImg_{{$key}}" >
                                                        <img loading="lazy" style="width:50px; height:50px;" id="" src="{{ (!empty($product_multi_img->photo_name))?
                                                        URL::to('storage/products/multi-image', $product_multi_img->photo_name) : url('upload/no_image.jpg') }}" alt="Brand Image">
                                                    </div>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                @push('js')
                                    <script>
                                        multi_image_validation("#upload_file_multiImg_{{$key}}", "#show_image_multiImg_{{$key}}", "#msg_v_multiImg_{{$key}}", '500', "Product size can't larger than 500 kb")
                                    </script>
                                @endpush
                                
                            @endforeach
                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info float-left mb-5 mt-5" value="Update Image">
                        </div>
                        <br>
                        <br>
                        <br>
                    </form>
                </div>
              </div>
        </div>
  </section>
{{-- //////////////// Multiple Image Update Section End //////////////////// --}}



    </div>



    @push('js')

        <!-- Search select2 support js Start -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $( '.select-field' ).select2( {
                theme: 'bootstrap-5'
            } );
        </script>
        <!-- Search select2 support js End -->


        {{-- First Time Data input and secound Time submit disabled Js Start --}}
        <script>
            function disableInput() {
                var input = document.getElementById('one_add_multi_img');
                input.disabled = true;
                document.getElementById('form-submit').submit();
            }
        </script>
        {{-- First Time Data input and secound Time submit disabled Js End --}}

        {{-- Image validation Js Start --}}
        <script>
            image_validation("#upload_file", "#show_image", "#msg_v", '500', "Photo brand size can't larger than 500 kb")
        </script>

        <script>
            image_validation("#multi_img_add", "#show_multi_img_add", "#msg_v_add", '1024', "Photo brand size can't larger than 1 MB")
        </script>
        {{-- Image validation Js End --}}

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        {{-- <script src="{{ asset('../assets/vendor_components/ckeditor/ckeditor.js') }}"></script> --}}
        <script src="{{ asset('../assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
        <script src="{{ asset('backend/js/pages/editor.js') }}"></script>


        <script>

            function dateShow(value, div_id){

                if(value== 'medicin' || value== 'Medicin' || value=='medicine' || value=='Medicine' || value=='medicined' || value=='Medicined' || value=='medicines' || value=='Medicines' || value=='pharmacy' || value=='Pharmacy' || value=='pharmacys' || value=='Pharmacys' || value=='Pharmecy' || value=='pharmecy'){
                    $("#"+div_id).show();
                    $("#div_input").show();
                }
                else if (value != 'medicin' || value != 'Medicin' || value !='medicine' || value !='Medicine' || value !='medicined' || value !='Medicined' || value !='medicines' || value !='Medicines' || value !='pharmacy' || value !='Pharmacy' || value !='pharmacys' || value !='Pharmacys' || value !='Pharmecy' || value !='pharmecy') {
                    $(".div_hide").hide();
                };

            }

        </script>


        {{-- Category Select And Sub Category, Sub-SubCategory Filtaring and Select Section Start Js --}}
        <script>
            $(document).ready(function() {
                $('select[name=category_id]').on('change', function() {
                    var category_id = $(this).val();
                    if (category_id) {
                        $.ajax({
                            url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                            type: "GET",
                            dataType: "json",
                            success:function(data) {
                                var d =$('select[name="subcategory_id"]').empty();
                                    $.each(data, function(key, value) {
                                        $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                                    });
                            },
                        });
                    }else {
                        alert('danger');
                    }
                });




                $('select[name=subcategory_id]').on('change', function() {
                    var subcategory_id = $(this).val();
                    if (subcategory_id) {
                        $.ajax({
                            url: "{{  url('/category/sub-subcategory/ajax') }}/"+subcategory_id,
                            type: "GET",
                            dataType: "json",
                            success:function(data) {
                                $('select[name="subsubcategory_id"]').html('');
                                var d =$('select[name="subsubcategory_id"]').empty();
                                    $.each(data, function(key, value) {
                                        $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
                                    });
                            },
                        });
                    }else {
                        alert('danger');
                    }
                });

            });
        </script>
        {{-- Category Select And Sub Category, Sub-SubCategory Filtaring and Select Section End Js --}}


        {{-- Main Thambnail Image Show Section Start Js --}}
        <script>
            function mainThamUrl(input){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#mainThmb').attr('src',e.target.result).width(80).height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
        {{-- Main Thambnail Image Show Section End Js --}}


        {{-- Multiple Image Show Section Start Js --}}
        <script>
             $(document).ready(function(){
                $('#multiImg').on('change', function(){
                    if (window.File && window.FileReader && window.FileList && window.Blob) {
                        var data = $(this)[0].files;
                        $.each(data, function(index, file){
                            if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)) {
                                var fRead = new FileReader();
                                fRead.onload = (function(file){
                                    return function(e) {
                                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80).height(80);
                                        $('#preview_img').append(img);
                                    };
                                })(file);
                                fRead.readAsDataURL(file);
                            }
                        });
                    }else{
                        alert("Your browser doesn't support File API!");
                    }
                });
             });
        </script>
        {{-- Multiple Image Show Section End Js --}}


    @endpush


@endsection
