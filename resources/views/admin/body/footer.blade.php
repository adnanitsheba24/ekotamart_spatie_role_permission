
@php
	$site_setting = DB::table('site_settings')->first();	
@endphp


<footer class="main-footer" style="background-color: aliceblue; color: black;">
    <div class="pull-right d-none d-sm-inline-block">
        <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
		  <li class="nav-item">
			<a class="nav-link" href="javascript:void(0)" style="color: black">FAQ</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="{{ url('/') }}" style="color: black">www.ekotamart.com</a>
		  </li>
		</ul>
    </div>
	  &copy; 2023 <a href="#" style="color: black">{{ @$site_setting->company_name == null ? " " : @$site_setting->company_name }}</a>. All Rights Reserved.
</footer>