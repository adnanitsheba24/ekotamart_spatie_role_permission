@extends('admin.admin_master')
@section('admin')
    <div class="container-full">

        <!-- Main content -->
        <section class="content">
            <div class="row">
				<div class="box bg-light">

					<div class="box-header with-border">
						<h4 class="box-title">Admin Profile Edit</h4>
					</div>

					<div class="box-body box-widget widget-user">
						<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-black">
						<h3 class="widget-user-username head-text">Admin Name: {{ $adminData->name }}</h3>

							<a href="{{ route('admin.profile.edit') }}" style="float: right;" class="btn btn-rounded btn-success mb-5">Edit Profile</a>

						<h6 class="widget-user-desc head-text">Admin Email: {{ $adminData->email }}</h6>
						</div>
						<div class="widget-user-image">
						<img class="rounded-circle" style="height: 100px; width:100px;" src="{{ (!empty($adminData->profile_photo_path)) ? URL::to('storage/admin_images', $adminData->profile_photo_path) : url('upload/no_image.jpg') }}" alt="User Avatar">
						</div>
						{{-- <div class="box-body box-footer">
						<div class="row">
							<div class="col-sm-4">
							<div class="description-block">
								<h5 class="description-header head-text">12K</h5>
								<span class="description-text head-text">FOLLOWERS</span>
							</div>
							<!-- /.description-block -->
							</div>
							<!-- /.col -->
							<div class="col-sm-4 br-1 bl-1">
							<div class="description-block">
								<h5 class="description-header head-text">550</h5>
								<span class="description-text head-text">FOLLOWERS</span>
							</div>
							<!-- /.description-block -->
							</div>
							<!-- /.col -->
							<div class="col-sm-4">
							<div class="description-block">
								<h5 class="description-header head-text">158</h5>
								<span class="description-text head-text">TWEETS</span>
							</div>
							<!-- /.description-block -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
						</div> --}}
					</div>
				</div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection