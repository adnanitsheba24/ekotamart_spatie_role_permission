@extends('admin.admin_master')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <style>
        /* The container */
        .container {
          display: block;
          position: relative;
          padding-left: 35px;
          margin-bottom: 12px;
          cursor: pointer;
          font-size: 15px;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }
        
        /* Hide the browser's default checkbox */
        .container input {
          position: absolute;
          opacity: 0;
          cursor: pointer;
          height: 0;
          width: 0;
        }
        
        /* Create a custom checkbox */
        .checkmark {
          position: absolute;
          top: 0;
          left: 0;
          height: 25px;
          width: 25px;
          background-color: #eee;
        }
        
        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
          background-color: #ccc;
        }
        
        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
          background-color: #07f064;
        }
        
        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
          content: "";
          position: absolute;
          display: none;
        }
        
        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
          display: block;
        }
        
        /* Style the checkmark/indicator */
        .container .checkmark:after {
          left: 9px;
          top: 5px;
          width: 5px;
          height: 10px;
          border: solid white;
          border-width: 0 3px 3px 0;
          -webkit-transform: rotate(45deg);
          -ms-transform: rotate(45deg);
          transform: rotate(45deg);
        }
        </style>

    <div class="container-full">
      <!-- Content Header (Page header) -->	  

      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Add Top Sidebar Menu</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="post" action="{{ route('top_sidebar.store') }}" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="row">
                            <div class="col-12">

                                <div class="row"> <!-- start 2nd row -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5 class="head-text">Top-Sidebar Name English <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name_en" class="form-control" placeholder="English name"> 
                                                @error ('name_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror 
                                            </div>
                                        </div>
                                    </div> <!-- end col md 6 -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5 class="head-text">Top-Sidebar Name Bangla <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name_bn" class="form-control" placeholder="Bangla name"> 
                                                @error ('name_bn')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror 
                                            </div>
                                        </div>
                                    </div> <!-- end col md 6 -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5 class="head-text">Priority <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number" name="priority" class="form-control" placeholder="Top sidebar priority"> 
                                                @error ('priority')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror 
                                            </div>
                                        </div>
                                    </div> <!-- end col md 6 -->

                                    <div class="controls col-md-6">
                                        <h5 class="head-text">Icon <span class="text-danger">*</span></h5>
                                        <input type="file" name="icon" class="form-control"  id="upload_file">
                                        <span class="text-danger" id="msg_v">@error ('icon') {{ $message }} @enderror </span>
                                        
                                        <br>
                                        <div class="col-md-6">
                                            <img loading="lazy" id="show_image" style="width:80px; height:80px;" src="{{ (!empty($top_sidebar->icon))?
                                            URL::to('storage/top_sidebar', $top_sidebar->icon) : url('upload/no_image.jpg') }}" alt="Top Sidebar Icon">
                                        </div>
                                    </div>

                                    <div class="col-md-6" style="margin-top: -70px;"> 
                                        <div class="form-group">
                                            <h5 class="head-text">Status <span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <label class="container">Active / In-active
                                                    <input type="checkbox" value="1" name="status">
                                                    <span class="checkmark"></span>
                                                  </label>
                                                @error ('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror 
                                            </div>
                                        </div>
                                    </div> <!-- end col md 6 -->

                                </div> <!-- end 2nd row -->

                                <hr>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info float-right mb-5 mt-5" value="Add Top-Sidebar">
                                </div>
                            </div>
                        </div>
                  </form>

                       
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>
            <!-- /.content -->
        </div>


    @push('js')

        <script>
            image_validation("#upload_file", "#show_image", "#msg_v", '500', "Top Sidebar icon size can't larger than 500 kb")
        </script>

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
