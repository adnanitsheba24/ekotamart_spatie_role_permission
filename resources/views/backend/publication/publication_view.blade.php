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

      <!-- Content Wrapper. Contains page content -->
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <div class="row">

        <div class="col-8">
           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Publication List <span class="badge badge-pill badge-danger">{{ count($publications) }}</span></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body head-text">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped" class="head-text">
                      <thead class="head-text">
                          <tr>
                              <th width="2%">SL.NO</th>
                              <th>Publication English</th>
                              <th>Publication Bangla</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody class="head-text">
                        @foreach ($publications as $key => $item)
                          <tr>
                                <td width="2%">{{ $key + 1 }}</td>
                                <td>{{ $item->publication_name_en }}</td>
                                <td>{{ $item->publication_name_bn }}</td>
                                <td class="text-center">
                                    @if ($item->status == 1)
                                      <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                      <span class="badge badge-pill badge-danger">InActive</span>
                                    @endif
                                </td>
                                <td width="30%">
                                    <a href="{{ route('publication.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('publication.delete',$item->id) }}" class="btn btn-danger btn-sm delete_data" title="Delete Data"><i class="fa fa-trash"></i></a>
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



          <!---------------- Add Category Page -------------->



            <div class="col-4">
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Publication</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('publication.store') }}">
                            @csrf
                            <div class="form-group">
                                <h5 class="head-text">Publication English<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="publication_name_en" class="form-control" placeholder="Publication english">
                                    @error ('publication_name_en') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5 class="head-text">Publication Bangla<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="publication_name_bn" class="form-control" placeholder="Publication bangla">
                                    @error ('publication_name_bn') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

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

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>


@endsection
