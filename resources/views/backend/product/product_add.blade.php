@extends('admin.admin_master')
@section('admin')

    <div class="container-full">
      <!-- Content Header (Page header) -->	  

      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Add Product</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="post" action="{{ route('product-store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                      <div class="col-12">

                        <div class="row"> <!-- start 1st row -->
                            <div class="col-md-3">

                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text ">Brand<span class="text-danger ">*</span></h5>
                                        <select name="brand_id" class="input-box-color form-control select-field" data-live-search="true" required="">
                                            <option value="" selected disabled="">Select Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">Category<span class="text-danger">*</span></h5>
                                        <select  name="category_id" class="input-box-color form-control select-field" required="">
                                            <option value="" selected disabled="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">SubCategory<span class="text-danger"></span></h5>
                                        <select name="subcategory_id" class="input-box-color form-control select-field">
                                            <option value="" selected disabled="">Select SubCategory</option>
                                           
                                        </select>
                                        @error ('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">SubSubCategory<span class="text-danger"></span></h5>
                                        <select name="subsubcategory_id" class="input-box-color form-control select-field">
                                            <option value="" selected disabled="">Select SubSubCategory</option>
                                            
                                        </select>
                                        @error ('subsubcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">Author<span class="text-danger"></span></h5>
                                        <select name="author_id" class="input-box-color form-control select-field">
                                            <option value="" selected>Select Author</option>
                                            @foreach($authors as $author)
                                                <option value="{{ $author->id }}">{{ $author->author_name_en }}</option>
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
                                            <option value="" selected>Select Book-Type</option>
                                            @foreach($book_types as $book_type)
                                                <option value="{{ $book_type->id }}">{{ $book_type->book_type_name_en }}</option>
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
                                            <option value="" selected>Select Publication</option>
                                            @foreach($publications as $publication)
                                                <option value="{{ $publication->id }}">{{ $publication->publication_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('publication_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                        </div> <!-- end 1st row -->


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 class="head-text">Product Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_en" class="form-control" required="" placeholder="Product name english"> 
                                        @error ('product_name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 3 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 class="head-text">Product Name Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_bn" class="form-control" required="" placeholder="Product name bnngla"> 
                                        @error ('product_name_bn')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 3 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 class="head-text">Product Quantity <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="product_qty" class="form-control" required placeholder="---- ? ----"> 
                                        @error ('product_qty')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 3 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <h5 class="head-text">Product Units<span class="text-danger"></span></h5>
                                        <select name="product_units_id" class="input-box-color form-control select-field">
                                            <option value="" selected>Select Product Units</option>
                                            @foreach($product_units as $product_unit)
                                                <option value="{{ $product_unit->id }}">{{ $product_unit->product_units_name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error ('product_units_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                    </div>
                                </div>
                            </div> <!-- end col md 3 -->
                        </div>


                        <div class="row"> <!-- start 3rd row -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 class="head-text text-danger"><del>Selling Price</del> <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="selling_price" class="form-control" required="" placeholder="---- ? ----" min="1" oninput="validity.valid||(value='');">  
                                        @error ('selling_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 class="head-text text-success">Discount Price <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="number" name="discount_price" class="form-control" placeholder="---- ? ----"> 
                                        @error ('discount_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-3">
                                <div class="form-group">

                                    @php
                                        $product_thambnail_img = DB::table('products')->get();
                                    @endphp

                                    <h5 class="head-text">Main Thambnail <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)" id="upload_file" required=""> 
                                        <span class="text-danger" id="msg_v"> @error ('product_thambnail') {{ $message }} @enderror </span>
                                        {{-- <img src="" id="mainThmb"> --}}
                                    </div>

                                    <div class="col-md-6 mt-5">
                                        <img id="show_image"  src="{{ (!empty($product_thambnail_img->product_thambnail))?
                                        URL::to('storage/brand', $product_thambnail_img->product_thambnail) : url('upload/no_image.jpg') }}" style="width:70px; height:70px;" alt="Brand Image" loading="lazy">
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->

                            <div class="col-md-3">
                                <div class="form-group">

                                    @php
                                        $product_multi_img = DB::table('multi_imgs')->get();
                                    @endphp

                                    <h5 class="head-text">Multiple Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="multi_img[]" class="form-control" multiple="" id="upload_file_multiImg" > 
                                        <span class="text-danger" id="msg_v_multiImg"> @error ('multi_img') {{ $message }} @enderror </span> 
                                        {{-- <div class="row" id="preview_img"></div> --}}
                                    </div>
                                    
                                    <div class="col-md-12 mt-5">
                                        <div id="show_image_multiImg" >
                                            <img style="width:70px; height:70px;" id="" src="{{ (!empty($product_multi_img->photo_name))?
                                            URL::to('storage/brand', $product_multi_img->photo_name) : url('upload/no_image.jpg') }}" alt="Brand Image" loading="lazy">
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                        </div> <!-- end 3rd row -->


                        <div class="row"> <!-- start 7th row -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="head-text">Short Description English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_descp_en" id="textarea" class="form-control" required placeholder="Textarea text"></textarea> 
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="head-text">Short Description Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_descp_bn" id="textarea" class="form-control" required placeholder="Textarea text"></textarea>
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->
                        </div> <!-- end 7th row -->
                        

                        <div class="row"> <!-- start 8th row -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="head-text">Long Description English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor1" name="long_descp_en" rows="5" cols="50" required=""></textarea> 
                                    </div>
                                </div>
                            </div> <!-- end col md 6 -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="head-text">Long Description Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor2" name="long_descp_bn" rows="5" cols="50" required=""></textarea>
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
                                            <input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
                                            <label for="checkbox_2">Hot Deals</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_3" name="featured" value="1">
                                            <label for="checkbox_3">Featured</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                <div class="controls">
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_4" name="special_offer" value="1">
                                            <label for="checkbox_4">Special Offer</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_5" name="special_deals" value="1">
                                            <label for="checkbox_5">Special Deals</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <br>
                        <span class="text-danger"><p><strong>Sidebar Top Section Select</strong></p></span>

                        <div class="row head-text mt-3">
                            @foreach($top_sidebar as $key => $item)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="radio" name="sid_sps_section" id="{{ $key + 1 }}" value="{{ $item->name_en }}" onchange="dateShow('{{ $item->name_en }}', 'show_date{{ $key + 1 }}')">
                                                <label for="{{ $key + 1 }}">{{ $item->name_en }}</label>
                                            </fieldset>

                                            @if ($item->name_en == "medicin" || $item->name_en == "Medicin" || $item->name_en == "medicine" || $item->name_en == "Medicine" || $item->name_en == "medicined" || $item->name_en == "Medicined" || $item->name_en == "pharmacy" || $item->name_en == "Pharmacy" || $item->name_en == "pharmacys" || $item->name_en == "Pharmacys" || $item->name_en == "Pharmecy" || $item->name_en == "pharmecy")
                                                <div id="show_date{{ $key + 1 }}" class="controls div_hide col-md-5" style="display: none;">
                                                    <label for="date">Expired Date<span class="text-danger"></span></label>
                                                    <input type="date" class="form-control" name="expired_date">
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
                            <input type="submit" class="btn btn-rounded btn-info float-right mb-5 mt-5" value="Add Product">
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
    </div>


    @push('js')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="{{ asset('../assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
        <script src="{{ asset('backend/js/pages/editor.js') }}"></script>


        <!-- Search select2 support js Start -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $( '.select-field' ).select2( {
                theme: 'bootstrap-5'
            } );
        </script>
        <!-- Search select2 support js End -->


        {{-- Medicine Date Validity JS Start --}}
        <script>
            function dateShow(value, div_id){

                if(value== 'medicin' || value== 'Medicin' || value=='medicine' || value=='Medicine' || value=='medicined' || value=='Medicined' || value=='medicines' || value=='Medicines' || value=='pharmacy' || value=='Pharmacy' || value=='pharmacys' || value=='Pharmacys' || value=='Pharmecy' || value=='pharmecy'){
                    $("#"+div_id).show();
                }
                else if (value != 'medicin' || value != 'Medicin' || value !='medicine' || value !='Medicine' || value !='medicined' || value !='Medicined' || value !='medicines' || value !='Medicines' || value !='pharmacy' || value !='Pharmacy' || value !='pharmacys' || value !='Pharmacys' || value !='Pharmecy' || value !='pharmecy') {
                    $(".div_hide").hide();
                };

            }
        </script>
        {{-- Medicine Date Validity JS End --}}


        {{-- Image validation Js Start --}}
        <script>
            image_validation("#upload_file", "#show_image", "#msg_v", '1000', "Product size can't larger than 1 MB")
        </script>

        <script>
            multi_image_validation("#upload_file_multiImg", "#show_image_multiImg", "#msg_v_multiImg", '1000', "Product size can't larger than 1 MB")
        </script>
        {{-- Image validation Js End --}}


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
                                $('select[name="subcategory_id"]').append('<option selected value="" >Select None</option>');
                                    $.each(data, function(key, value) {

                                        $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                                    });
                            },
                        });
                    }
                    // else {
                    //     alert('danger');
                    // }
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
                                $('select[name="subsubcategory_id"]').append('<option selected value=""  >Select None</option>');
                                    $.each(data, function(key, value) {
                                        $('select[name="subsubcategory_id"]').append('<option  value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
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

    @endpush


@endsection
