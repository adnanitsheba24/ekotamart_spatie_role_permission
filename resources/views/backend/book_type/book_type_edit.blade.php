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

    <div class="container-full">
      <section class="content">
        <div class="row">

            <div class="col-12">
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Book-Type</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('book-type.update', $book_types->id) }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $book_types->id }}">

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Book-Type English<span class="text-danger">*</span></h5>
                                    <input type="text" name="book_type_name_en" value="{{ $book_types->book_type_name_en }}" class="form-control">
                                    @error ('book_type_name_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Book-Type Bangla<span class="text-danger">*</span></h5>
                                    <input type="text" name="book_type_name_bn" value="{{ $book_types->book_type_name_bn }}" class="form-control">
                                    @error ('book_type_name_bn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <div class="col-md-6 mt-5" style="margin-top: -70px;"> 
                                    <h5 class="head-text">Status <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <label class="container">Active / In-active
                                            <input type="checkbox" value="1" name="status" {{ $book_types->status == 1 ? 'checked' : '' }} >
                                            <span class="checkmark"></span>
                                        </label>
                                        @error ('status') <span class="text-danger">{{ $message }}</span> @enderror 
                                    </div>
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

@endsection
