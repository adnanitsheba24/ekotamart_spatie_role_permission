
{{-- <style>
	.main-header .navbar-nav > li.dropdown > .dropdown-menu {
    width: auto;
    height: 200px;
    max-width: 250px;
    padding: 0;
    margin: 0;
    top: 100%;
    border: none;
}
</style> --}}

<header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30" style="background-color: #47A992">
      <!-- Sidebar toggle button-->
		<div>
			<ul class="nav">
				<li class="btn-group nav-item">
					<a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu" role="button">
						<i class="nav-link-icon mdi mdi-menu" style="color: black"></i>
					</a>
				</li>
				<li class="btn-group nav-item">
					<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
						<i class="nav-link-icon mdi mdi-crop-free" style="color: black"></i>
					</a>
				</li>			
				{{-- <li class="btn-group nav-item d-none d-xl-inline-block">
					<a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="">
						<i class="ti-check-box"></i>
					</a>
				</li> --}}
				{{-- <li class="btn-group nav-item d-none d-xl-inline-block">
					<a href="calendar.html" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="">
						<i class="ti-calendar"></i>
					</a>
				</li> --}}
			</ul>
		</div>
		
		<div class="navbar-custom-menu r-side">
				<ul class="nav navbar-nav">
					<!-- full Screen -->
						<li style="margin-right: 50px;">		  
							<div class="lookup lookup-circle lookup-right">
								<input type="search" name="search" id="search" class="search-box" style="background-color:#fafbfb;" placeholder="Search Order Invoice">
								<i class="fa fa-search" style="color: black" onclick="PendingInvoice()"></i>
							</div>
						</li>

					{{-- <div class="search-bar">
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
						</div>
					</div> --}}
				


					<!-- Notifications  Start-->
					<li class="dropdown notifications-menu notification-bar">
						<a href="#" class="waves-effect waves-light rounded dropdown-toggle" data-toggle="dropdown" title="Notifications">
						<i class="ti-bell" style="color: black"></i>
						</a>
						<ul class="dropdown-menu animated bounceIn">

						<li class="header">
							<div class="p-20">
								<div class="flexbox">
									<div>
										<h4 class="mb-0 mt-0">Notifications</h4>
									</div>
									<div>
										<a href="#" class="text-danger">X</a>
									</div>
								</div>
							</div>
						</li>

						<li>
							<!-- inner menu: contains the actual data -->
							<ul class="menu sm-scrol">
								<li>
									<a href="{{ route('prnding-orders') }}">
										<i class="fa fa-clock-o text-info"></i> Pending Order Status
									</a>
								</li>
								<li>
									<a href="{{ route('confirmed-orders') }}">
										<i class="fa fa-check text-primary"></i> Confimed Order Status
									</a>
								</li>
								<li>
									<a href="{{ route('processing-orders') }}">
										<i class="fa fa-spinner text-warning"></i> Processing Order Status
									</a>
								</li>
								<li>
									<a href="{{ route('picked-orders') }}">
										<i class="fa fa-get-pocket" style="color: #808000;"></i> Picked Order Status
									</a>
								</li>
								<li>
									<a href="{{ route('shipped-orders') }}">
										<i class="fa fa-truck" style="color: #808080;"></i> Shipped Order Status
									</a>
								</li>
								<li>
									<a href="{{ route('delivered-orders') }}">
										<i class="fa fa-check-circle text-success"></i> Delivered Order Status
									</a>
								</li>
								<li>
									<a href="{{ route('return.request') }}">
										<i class="fa fa-exchange text-warning"></i> Return Order Status
									</a>
								</li>
								<li>
									<a href="{{ route('cancel-orders') }}">
										<i class="fa fa-times text-danger"></i> Cancel Order List
									</a>
								</li>
							</ul>
						</li>
						{{-- <li class="footer">
							<a href="#">View all</a>
						</li> --}}
						</ul>
					</li>	
					<!-- Notifications  End-->



					@php				
						$id = Auth::guard('admin')->id();
						$adminData = \App\Models\Admin::where('id', $id)->first();
					@endphp

					{{-- @php
						$adminData = DB::table('admins')->first(); 
					@endphp --}}

					<p class="head-text mt-3">{{ $adminData == null ? '' : $adminData->name }}</p>
					<!-- User Account-->
					<li class="dropdown user user-menu">
						<a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0" data-toggle="dropdown" title="User">
							{{-- <img src="{{ (!empty($adminData->profile_photo_path)) ? url('upload/admin_images/'.$adminData->profile_photo_path) : url('upload/no_image.jpg') }}" alt=""> --}}
							<img loading="lazy" src="{{ (!empty($adminData->profile_photo_path))?
								URL::to('storage/admin_images', $adminData->profile_photo_path) : url('upload/no_image.jpg') }}" alt="Admin Image">
						</a>
						<ul class="dropdown-menu animated flipInX">
						<li class="user-body" style="background-color: #1B9C85">
							<a class="dropdown-item" href="{{ route('admin.profile') }}" style="color: white"><i class="ti-user text-muted mr-2" ></i> Profile</a>
							<a class="dropdown-item" href="{{ route('admin.change.password') }}" style="color: white"><i class="ti-wallet text-muted mr-2" ></i>Change Password</a>
							{{-- <a class="dropdown-item" href="#" style="color: black"><i class="ti-settings text-muted mr-2" ></i> Settings</a> --}}
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{ route('admin.logout') }}" style="color: black"><i class="ti-lock text-muted mr-2"></i> Logout</a>
						</li>
						</ul>
					</li>	
					{{-- <li>
						<a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light">
							<i class="ti-settings"></i>
						</a>
					</li> --}}
						
				</ul>
		</div>
    </nav>
  </header>


  @push('js')
	
  		{{-- Dashboard Orders Pending Search Start Js   --}}
		<script>
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$(document).ready(function () {
				$('#search').on('keyup', function () {
					var value = $(this).val();
					// console.log('value: '+value);
					$.ajax({
						url: "/pending/search",
						type: "get",
						data: {'search':value},
						success: function(data){
							$('#pending_order_search').html(data);
						}
					});

				});
			});

			
			function PendingInvoice(){
				var input = document.getElementById('search').value;
				if (input != '') {
					window.location.href = '/pending/search_value/'+input;
				}
			}
		</script> 
  		{{-- Dashboard Orders Pending Search End Js   --}}

	@endpush