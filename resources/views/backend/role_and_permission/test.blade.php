@extends('admin.admin_master')
@section('admin')
    <style>
        /* Base styles for the button */
        .custom-button {
            background-color: #007bff;
            /* Blue background color (you can change this) */
            color: #fff;
            /* Text color */
            padding: 10px 20px;
            /* Adjust padding as needed */
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            border-radius: 50px;
        }

        /* Styles for the cross icon */
        .cross-icon {
            position: absolute;
            top: 0;
            right: -30px;
            /* Adjust the position to hide initially */
            width: 30px;
            height: 100%;
            background-color: red;
            /* Red color for the cross */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: right 0.3s;
            /* Add a smooth transition effect */
        }

        /* Show the cross icon on hover */
        .custom-button:hover .cross-icon {
            right: 0;
        }
    </style>
    <div class="container-full">
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Role</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('role.update', $role->id) }}">
                                    @csrf
                                    <div class="form-group d-flex justify-content-center">
                                        <div class="controls col-md-6">
                                            <h5 class="head-text">Role Name<span class="text-danger">*</span></h5>
                                            <input type="text" id="name" name="name" value="{{ $role->name }}"
                                                class="form-control">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group d-flex justify-content-center">
                                        <div class="controls col-md-6">
                                            <input type="submit" class="btn btn-rounded btn-info float-right mb-5 mt-5"
                                                value="Update">
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
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Role Permissions</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <div class="row m-1">
                                    @if ($role->permissions)
                                        @foreach ($role->permissions as $role_permission)
                                            <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md"
                                                method="POST"
                                                action="{{ route('roles.permissions.revoke', [$role->id, $role_permission->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="card"
                                                    style=" position: initial;max-width: 200px; background-color:gainsboro; border-radius: 50px;">
                                                    <button class="custom-button">
                                                        {{ $role_permission->name }}
                                                        <span class="cross-icon">&times;</span>
                                                    </button>
                                                </div>
                                            </form>
                                        @endforeach
                                    @endif
                                </div>


                                <hr>
                                <h1 style="color: black">Assignable Permission:</h1>

                                <div class="row m-1">
                                    @if ($role->permissions)
                                        @foreach ($permissions as $permission)
                                            <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md"
                                                method="POST" action="{{ route('roles.permissions', $role->id) }}">
                                                @csrf
                                                <input type="hidden" name="permission" value="{{ $permission->name }}">
                                                <div class="card"
                                                    style=" position: initial;max-width: 200px; background-color:gainsboro; border-radius: 50px;">
                                                    <button class="custom-button">
                                                        {{ $permission->name }}
                                                        <span class="cross-icon" style="background-color: green;"><i
                                                                class="fa fa-check" aria-hidden="true"></i></span>
                                                    </button>
                                                </div>
                                            </form>
                                        @endforeach
                                    @endif
                                </div>
                                {{-- <form method="POST" action="{{ route('roles.permissions', $role->id) }}">
                                    @csrf

                                    <div class="form-group d-flex justify-content-center">
                                        <div class="controls col-md-6">
                                            <h5 class="head-text">Permission Name<span class="text-danger">*</span></h5>
                                            <select id="permission" name="permission" autocomplete="permission-name"
                                            class="form-control">
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                            
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <div class="controls col-md-6">
                                            <input type="submit"
                                                class="btn btn-rounded btn-info float-right mb-5 mt-5"
                                                value="Assign">
                                        </div>
                                    </div>

                                </form> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection