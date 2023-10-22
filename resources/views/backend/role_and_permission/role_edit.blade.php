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
                    <h3 class="box-title">Edit Role</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('role.update', $role->id) }}">
                            @csrf

                            <div class="form-group">
                                <div class="controls col-md-6">
                                    <h5 class="head-text">Role Name<span class="text-danger">*</span></h5>
                                    <input id="name" type="text" name="name" value="{{ $role->name }}" class="form-control">
                                    @error ('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="controls col-md-6">
                                    <input type="submit" class="btn btn-rounded btn-info float-right mb-5 mt-5" value="Update">
                                </div>
                            </div>

                        </form>
                    </div>

                    <div>
                        <h2 class="head-text">Role Permissions</h2>
                        <div>
                            @if ($role->permissions)
                                @foreach ($role->permissions as $role_permission)
                                    <form method="post" action="{{ route('roles.permissions.revoke', [$role->id, $role_permission->id]) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-rounded btn-success" type="submit">{{ $role_permission->name }} </button>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <div class="table-responsive">
                                <form method="post" action="{{ route('roles.permissions', $role->id) }}" >
                                    @csrf
        
                                    <div class="form-group col-md-6">
                                            <label class="head-text" for="permission">Permission</label><br>
                                            <select id="permission" name="permission" class="form-control form-select" autocomplete="permission-name" aria-label="Default select example">
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

@endsection
