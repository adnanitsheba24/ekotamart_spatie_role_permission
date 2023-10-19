@extends('admin.admin_master')
@section('admin')

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

    <div class="col-12">
        <div class="box mt-4">

            <div class="box-header with-border">
                <h3 class="box-title">Add Author</h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('author.store') }}">
                            @csrf
                        
                            <div class="row"> <!-- start 1st row -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5 class="head-text">Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control">
                                                <option value="" selected disabled="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error ('category_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5 class="head-text">Book-Type Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="book_type_id" class="form-control">
                                                <option value="" selected disabled="">Select Book-Type</option>
                                                @foreach($book_types as $item)
                                                    <option value="{{ $item->id }}">{{ $item->book_type_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error ('book_type_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5 class="head-text">Publication Select <span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <select name="publication_id" class="form-control">
                                                <option value="" selected>Select Publication</option>
                                                @foreach($publications as $item)
                                                    <option value="{{ $item->id }}">{{ $item->publication_name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error ('publication_id') <span class="text-danger">{{ $message }}</span> @enderror    
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                            </div> <!-- end 1st row -->

                            <div class="row"> <!-- start 1st row -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 class="head-text">Author English<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="author_name_en" class="form-control" placeholder="Author English">
                                            @error ('author_name_en') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 class="head-text">Author Bangla<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="author_name_bn" class="form-control" placeholder="Author bangla">
                                            @error ('author_name_bn') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                                <div class="col-md-6 mt-5" style="margin-top: -70px;"> 
                                    <div class="form-group">
                                        <h5 class="head-text">Status<span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <label class="container">Active / In-active
                                                <input type="checkbox" value="1" name="status">
                                                <span class="checkmark"></span>
                                            </label>
                                            @error ('status') <span class="text-danger">{{ $message }}</span> @enderror 
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end 1st row -->

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info float-right mb-5 mt-5" value="Add Author">
                            </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>

</section>

@endsection
