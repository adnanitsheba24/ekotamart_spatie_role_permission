@extends('admin.admin_master')
@section('admin')

    @push('css')
        <!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    @endpush

      <!-- Content Wrapper. Contains page content -->
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">
        <div class="row">

            <div class="col-12">
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Role</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('role.update', $role->id) }}">
                            @csrf

                            <div class="form-group d-flex justify-content-center">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Role Name<span class="text-danger">*</span></h5>
                                    <input id="name" type="text" name="name" value="{{ $role->name }}" class="form-control">
                                    @error ('name')
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


            <div class="col-12">
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Role Permissions</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div>
                        <div class="flex space-x-2">

                            {{-- @if ($role->permissions)
                                @foreach ($role->permissions as $role_permission)
                                    <form method="POST" action="{{ route('roles.permissions.revoke', [$role->id, $role_permission->id]) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">{{ $role_permission->name }}</button>
                                    </form>
                                @endforeach
                            @endif --}}

                            @if ($role->permissions)
                                @foreach ($role->permissions as $role_permission)
                                    <a class="btn btn-danger btn-sm delete_data" title="remove" href="{{ route('roles.permissions.revoke', [$role->id, $role_permission->id]) }}">{{ $role_permission->name }}</a>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <div class="table-responsive">
                                <form method="post" action="{{ route('roles.permissions', $role->id) }}" >
                                    @csrf
        
                                    <div class="form-group col-md-6 mt-5">
                                            <label class="head-text" for="permission">Permission</label><br>
                                            <select id="permission" name="permission" class="form-control form-select" autocomplete="permission-name" id="multiple-select-field" multiple>
                                                @foreach ($permissions as $permission)
                                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                                @endforeach
                                            </select>

                                            @error ('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    
                                    <div class="form-group ">
                                        <div class="controls col-md-6">
                                            <input type="submit" class="btn btn-rounded btn-success float-right mb-5 mt-5" value="Assign">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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

        <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

        <script>
            $( '#multiple-select-field' ).select2( {
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
                closeOnSelect: false,
            } );
        </script>

    @endpush


@endsection
