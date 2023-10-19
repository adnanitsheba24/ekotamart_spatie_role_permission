@extends('admin.admin_master')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="container-full">
        <section class="content">

             <div class="box bg-light">
               <div class="box-header with-border">
                 <h4 class="box-title">Admin Profile Edit</h4>
               </div>
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="post" action="{{ route('admin.profile.update', $editData->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5 class="head-text">Admin User Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control" value="{{ $editData->name }}" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5 class="head-text">Admin Email<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control" value="{{ $editData->email }}" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5 class="head-text">Profile Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="profile_photo_path" class="form-control" required="" id="upload_file" id="image">
                                                    <span class="text-danger" id="msg_v">@error ('brand_image') {{ $message }} @enderror </span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6">
                                            <img id="showImage" src="{{ (!empty($editData->profile_photo_path)) ? URL::to('storage/admin_images', $editData->profile_photo_path) 
                                            : url('upload/no_image.jpg') }}" style="width: 140px; height: 150px;" alt="">
                                        </div> --}}

                                        <div class="col-md-6">
                                            <img id="show_image" style="width:100px; height:100px;" src="{{ (!empty($editData->profile_photo_path))?
                                            URL::to('storage/admin_images', $editData->profile_photo_path) : url('upload/no_image.jpg') }}" style="width: 140px; height: 150px;" alt="Admin Image">
                                        </div>
                                    </div>
                                    
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info float-right mb-5" value="Update">
                                    </div>
                                </div>
                            </div>
                       </form>
   
                   </div>
                 </div>
               </div>
             </div>
   
        </section>
    </div>


    @push('js')

        <script>
            image_validation("#upload_file", "#show_image", "#msg_v", '500', "Photo brand size can't larger than 500 kb")
        </script>

        {{-- <script>
            $(document).ready(function() {
                $('#image').change(function(e){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#showImage').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script> --}}

    @endpush

@endsection