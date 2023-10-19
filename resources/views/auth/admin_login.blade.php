<!DOCTYPE html>
<html lang="en">
	@php
        $site_setting = DB::table('site_settings')->first();
    @endphp
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <link rel="icon" href="{{ asset('upload/icon_tab_image/icon_tab.jpeg') }}"> --}}
    @if (@$site_setting->icon == '' || @$site_setting->icon == null)
        <link rel="icon" href="{{ asset('upload/no_image.jpg') }}">
    @else
        <link rel="icon" href="{{ URL::to('storage/icon', @$site_setting->icon) }}">
    @endif
    <title>{{ $site_setting->company_name }}</title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">	

</head>
<body class="hold-transition theme-primary bg-gradient-danger">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-4 col-md-5 col-12">
						<div class="content-top mt-5">
							<h2 class="text-white"><center>Welcome to {{ $site_setting->company_name }}</center></h2>
							<h2 class="text-white"><center>Admin Login</center></h2>
							<p class="text-white-50"><center>Sign in to start your session</center></p>	
						</div>
						{{-- <div class="p-30 rounded30 box-shadowed b-2 b-dashed"> --}}
							<form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
                                @csrf
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
										</div>
										<input type="email" id="email" name="email" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Email">
										{{-- @error('email')
											<label for="" class="text-danger">{{ $message }}</label>
										@enderror --}}
									</div>
								</div>

								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text  bg-transparent text-white"><i class="ti-lock"></i></span>
										</div>
										<input type="password" id="password" name="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Password">
										{{-- @error('password')
											<label for="" class="text-danger">{{ $message }}</label>
										@enderror --}}
									</div>
								</div>

								<div class="form-group">
									<div class="captcha">
										<span>{!! captcha_img('math') !!}</span>
										<button type="button" class="btn btn-danger reload" id="reload">
											&#x21bb;
										</button>
									</div>

									<div class="input-group mb-3">
										<input type="text" name="captcha" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Enter a captcha">
									</div>
									@error('captcha')
										<label for="" class="text-danger">{{ $message }}</label>
									@enderror
								</div>
								

								  <div class="row">
									<div class="col-6">
									  <div class="checkbox text-white">
										<input type="checkbox" id="basic_checkbox_1" >
										<label for="basic_checkbox_1">Remember Me</label>
									  </div>
									</div>
									<!-- /.col -->
									<div class="col-6">
									 <div class="fog-pwd text-right">
										<a href="{{ route('admin.password.request') }}" class="text-white hover-info"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
									  </div>
									</div>
									<!-- /.col -->
									<div class="col-12 text-center">
									  <button type="submit" class="btn btn-info btn-rounded mt-10 float-right">Please login</button>
									</div>
									<!-- /.col -->
								  </div>
							</form>														

							{{-- <div class="text-center text-white">
							  <p class="mt-20"></p>
							  <p class="gap-items-2 mb-20">
								  <a class="btn btn-social-icon btn-round btn-outline btn-white" href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
								  <a class="btn btn-social-icon btn-round btn-outline btn-white" href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>
								  <a class="btn btn-social-icon btn-round btn-outline btn-white" href="https://www.google.com"><i class="fa fa-google-plus"></i></a>
								  <a class="btn btn-social-icon btn-round btn-outline btn-white" href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>
								</p>	
							</div>
							
							<div class="text-center">
								<p class="mt-15 mb-0 text-white">Don't have an account? <a href="auth_register.html" class="text-info ml-5">Sign Up</a></p>
							</div> --}}
						{{-- </div> --}}
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js') }}"></script>	

	<script>
		$('#reload').click(function(){
			console.log('hi');
			$.ajax({
				type:'GET',
				// url:'/login/reload-captcha',
				url:"{{ route('reload.captcha') }}",
				success:function(data){
					$(".captcha span").html(data.captcha)
				}
			});
		});
	</script>

</body>
</html>
